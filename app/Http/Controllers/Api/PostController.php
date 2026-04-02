<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends \App\Http\Controllers\Controller
{
    // public function index(Request $request)
    // {
    //     $response = Http::withOptions([
    //         'verify' => false        ])->get('https://jsonplaceholder.typicode.com/posts');

    //     $posts = collect($response->json())
    //         ->map(fn($post) => [
    //     'title' => $post['title'],
    //     'body' => $post['body'],
    //     ]);

    //     if ($request->filled('search')) {
    //         $search = strtolower($request->input('search'));
    //         $posts = $posts->filter(
    //         fn($post) => str_contains(strtolower($post['title']), $search)
    //         )->values();
    //     }

    //     return response()->json($posts->take(10)->values(), 200);
    // }

    public function index(Request $request)    {
        $response = Http::withHeaders([
            'User-Agent' => 'LaravelClient/1.0',
            'Accept' => 'application/json',
        ])
            ->withOptions([
            'verify' => false
        ])
            ->get('https://jsonplaceholder.typicode.com/posts');

        // Get status code
        $statusCode = $response->status();

        $posts = collect($response->json())
            ->map(function ($post) {
            return [
            'title' => $post['title'],
            'body' => $post['body'],
            ];
        });

        if ($request->filled('search')) {
            $search = strtolower($request->input('search'));

            $posts = $posts->filter(function ($post) use ($search) {
                return str_contains(strtolower($post['title']), $search);
            })->values();
        }

        return response()->json([
            'status' => $statusCode,
            'data' => $posts->take(10)->values()
        ], 200);    }
}
