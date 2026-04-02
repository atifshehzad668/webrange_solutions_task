<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HttpRequestController extends Controller
{
    private string $apiUrl = 'https://catfact.ninja/fact';

    private array $customHeaders = [
        'User-Agent' => 'LaravelHttpClient/1.0 (Task4-Demo)',
        'Accept' => 'application/json',
    ];

    private function fetchWithRetry(int $maxRetries = 3, int $sleepMs = 500): array
    {
        $attempt = 0;
        $maxAttempts = $maxRetries; // Explicitly capping total attempts to exactly what is passed
        $lastError = '';
        $statusCode = null;

        while ($attempt < $maxAttempts) {
            $attempt++;

            try {
                $response = Http::withHeaders($this->customHeaders)
                    // ->withOptions(['verify' => 'C:\wamp64\bin\php\php8.2.0\cacert.pem'])
                    ->withOptions(['verify' => ini_get('curl.cainfo') ?: true])
                    ->timeout(8)
                    ->get($this->apiUrl);

                $statusCode = $response->status();

                if ($response->successful()) {
                    return [
                        'success' => true,
                        'status' => $statusCode,
                        'data' => $response->json(),
                        'headers' => $this->customHeaders,
                        'attempts' => $attempt,
                        'url' => $this->apiUrl,
                    ];
                }

                $lastError = 'HTTP ' . $statusCode . ' received.';
            }
            catch (\Exception $e) {
                $lastError = $e->getMessage();
                $statusCode = null;
            }

            if ($attempt < $maxAttempts) {
                usleep($sleepMs * 1000);
            }
        }

        return [
            'success' => false,
            'status' => $statusCode,
            'error' => $lastError . ' (Max attempts reached)',
            'headers' => $this->customHeaders,
            'attempts' => $attempt,
            'url' => $this->apiUrl,
        ];
    }

    public function index(Request $request)
    {
        $ip = $request->ip();
        $cacheKey = 'header_attempts_' . $ip;
        $attempts = \Illuminate\Support\Facades\Cache::get($cacheKey, 0);

        if ($attempts >= 3) {
            return response()->json([
                'success' => false,
                'message' => 'Limit reached. You have attempted with mismatched headers 3 times. Please wait 1 minute.'
            ], 429);
        }

        $expectedUa = 'LaravelHttpClient/1.0 (Task4-Demo)';
        $expectedAccept = 'application/json';

        if ($request->header('User-Agent') !== $expectedUa || $request->header('Accept') !== $expectedAccept) {
            \Illuminate\Support\Facades\Cache::put($cacheKey, $attempts + 1, now()->addMinutes(1));
            return response()->json([
                'success' => false,
                'message' => 'Mismatch header name or value. Attempt ' . ($attempts + 1) . ' of 3.',
            ], 400);
        }

        // Reset if correct
        \Illuminate\Support\Facades\Cache::forget($cacheKey);

        $retries = (int)$request->input('retries', 3);
        $retries = max(1, min($retries, 5));

        // Let it hit the real API if they got the headers right
        $this->apiUrl = 'https://catfact.ninja/fact';

        $result = $this->fetchWithRetry($retries);

        return response()->json([
            'success' => $result['success'],
            'message' => $result['success']
            ? 'Request succeeded on attempt ' . $result['attempts'] . '.'
            : 'Request failed after ' . $result['attempts'] . ' attempt(s): ' . ($result['error'] ?? ''),
            'status_code' => $result['status'],
            'custom_headers' => $result['headers'],
            'url' => $result['url'],
            'data' => $result['data'] ?? null,
        ], $result['success'] ? 200 : 502);
    }

}
