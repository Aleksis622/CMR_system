<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Models\Vehicle;

Route::get('/import-vehicles', function () {
    $url = 'https://deskplan.lv/muita/app.json';
    $response = Http::get($url);

    if (!$response->successful()) {
        return "Failed to fetch JSON: " . $response->status();
    }

    $data = $response->json();

    foreach ($data['vehicles'] as $item) {
        Vehicle::updateOrCreate(
            ['vehicle_id' => $item['id']],
            [
                'plate_no' => $item['plate_no'],
                'country' => $item['country'],
                'make' => $item['make'],
                'model' => $item['model'],
                'vin' => $item['vin'],
            ]
        );
    }

    return 'Vehicles imported successfully!';
});
