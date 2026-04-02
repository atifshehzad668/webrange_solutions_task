<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuoteController extends Controller
{
    private function scrapePage(string $url): array    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $html = curl_exec($ch);
        curl_close($ch);

        if (!$html) {
            return [];
        }

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);
        $quotes = [];

        foreach ($xpath->query('//div[@class="quote"]') as $node) {
            $textNode = $xpath->query('.//span[@class="text"]', $node)->item(0);
            $authorNode = $xpath->query('.//small[@class="author"]', $node)->item(0);

            if ($textNode && $authorNode) {
                $quotes[] = [
                    'quote' => mb_convert_encoding(trim($textNode->textContent, "“” "), 'UTF-8', 'UTF-8'),
                    'author' => mb_convert_encoding(trim($authorNode->textContent), 'UTF-8', 'UTF-8'),
                ];
            }
        }

        return $quotes;    }

    private function hasNextPage(string $html): bool
    {
        return str_contains($html, 'Next');
    }

    public function index(Request $request)
    {
        $maxPages = (int)$request->input('pages', 1);
        $maxPages = max(1, min($maxPages, 10));

        $allQuotes = [];
        $base = 'http://quotes.toscrape.com';

        for ($page = 1; $page <= $maxPages; $page++) {
            $url = $base . '/page/' . $page . '/';
            $pageData = $this->scrapePage($url);

            if (empty($pageData)) {
                break;
            }

            $allQuotes = array_merge($allQuotes, $pageData);
        }

        return response()->json([
            'success' => true,
            'message' => count($allQuotes) . ' quotes scraped from ' . $maxPages . ' page(s).',
            'total' => count($allQuotes),
            'data' => $allQuotes,
        ], 200);
    }

    public function show(Request $request)
    {
        $maxPages = (int)$request->input('pages', 1);
        $maxPages = max(1, min($maxPages, 10));

        $allQuotes = [];
        $base = 'http://quotes.toscrape.com';

        for ($page = 1; $page <= $maxPages; $page++) {
            $url = $base . '/page/' . $page . '/';
            $pageData = $this->scrapePage($url);

            if (empty($pageData)) {
                break;
            }

            $allQuotes = array_merge($allQuotes, $pageData);
        }

        return view('quotes', [
            'quotes' => $allQuotes,
            'pages' => $maxPages,
            'total' => count($allQuotes),
        ]);
    }
}
