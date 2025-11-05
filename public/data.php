<?php 
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

Route::get('/fetch-json', function () {
    $url = 'https://deskplan.lv/muita/app.json';

    try {
        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json(); // ši rindiņa automātiski decode JSON!
            return response()->json($data);
        } else {
            return response()->json([
                'error' => 'Failed to fetch JSON',
                'status' => $response->status()
            ], $response->status());
        }
    } catch (\Exception $e) {
        Log::error('Error fetching JSON: ' . $e->getMessage());
        return response()->json(['error' => 'Unable to connect to remote JSON'], 500);
    }
});
