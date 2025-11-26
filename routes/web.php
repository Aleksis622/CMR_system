<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\Vehicle;
use App\Models\Party;
use App\Models\CaseRecord;
use App\Models\Inspection;
use App\Models\UserRecord;
use App\Models\Document;

Route::get('/generate-users-data', function () {
    $defaultPassword = 'Login123'; 
    $users = UserRecord::all();

    foreach ($users as $user) {

        if (!$user->email) {
            $firstName = 'user';
            if (!empty($user->full_name)) {
                $firstName = explode(' ', $user->full_name)[0];
            }
            $emailBase = Str::slug($firstName);
            $user->email = strtolower($emailBase) . $user->id . '@example.com';
        }

        $user->password = $defaultPassword;

        $user->save();
    }

    return 'Emails and default passwords generated for all users.';
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/fetch-all', function () {
    $url = 'https://deskplan.lv/muita/app.json';
    $response = Http::timeout(60)->get($url);

    if (!$response->successful()) {
        return "Failed to fetch JSON: " . $response->status();
    }

    $data = $response->json();

    // --- Vehicles ---
    if (isset($data['vehicles'])) {
        foreach ($data['vehicles'] as $v) {
            Vehicle::updateOrCreate(
                ['vehicle_id' => $v['id']],
                [
                    'plate_no' => $v['plate_no'] ?? null,
                    'country' => $v['country'] ?? null,
                    'make' => $v['make'] ?? null,
                    'model' => $v['model'] ?? null,
                    'vin' => $v['vin'] ?? null,
                ]
            );
        }
    }

    // --- Parties ---
    if (isset($data['parties'])) {
        foreach ($data['parties'] as $p) {
            Party::updateOrCreate(
                ['party_id' => $p['id']],
                [
                    'type' => $p['type'] ?? null,
                    'name' => $p['name'] ?? null,
                    'reg_code' => $p['reg_code'] ?? null,
                    'vat' => $p['vat'] ?? null,
                    'country' => $p['country'] ?? null,
                    'email' => $p['email'] ?? null,
                    'phone' => $p['phone'] ?? null,
                ]
            );
        }
    }

    // --- Cases ---
    if (isset($data['cases'])) {
        foreach ($data['cases'] as $c) {
            CaseRecord::updateOrCreate(
                ['case_id' => $c['id']],
                [
                    'external_ref' => $c['external_ref'] ?? null,
                    'status' => $c['status'] ?? null,
                    'priority' => $c['priority'] ?? null,
                    'arrival_ts' => $c['arrival_ts'] ?? null,
                    'checkpoint_id' => $c['checkpoint_id'] ?? null,
                    'origin_country' => $c['origin_country'] ?? null,
                    'destination_country' => $c['destination_country'] ?? null,
                    'risk_flags' => $c['risk_flags'] ?? [],
                    'declarant_id' => $c['declarant_id'] ?? null,
                    'consignee_id' => $c['consignee_id'] ?? null,
                    'vehicle_id' => $c['vehicle_id'] ?? null,
                ]
            );
        }
    }

    // --- Inspections ---
    if (isset($data['inspections'])) {
        foreach ($data['inspections'] as $i) {
            Inspection::updateOrCreate(
                ['inspection_id' => $i['id']],
                [
                    'case_id' => $i['case_id'] ?? null,
                    'type' => $i['type'] ?? null,
                    'requested_by' => $i['requested_by'] ?? null,
                    'start_ts' => $i['start_ts'] ?? null,
                    'location' => $i['location'] ?? null,
                    'checks' => $i['checks'] ?? [],
                    'assigned_to' => $i['assigned_to'] ?? null,
                ]
            );
        }
    }

    // --- Users ---
    if (isset($data['users'])) {
        foreach ($data['users'] as $u) {
            UserRecord::updateOrCreate(
                ['user_id' => $u['id']],
                [
                     'name' => $u['name'] ?? null,
                    'full_name' => $u['full_name'] ?? null,
                    'role' => $u['role'] ?? null,
                    'password' => 'Login123',        
                ]
            );
        }
    }

    // --- Documents ---
    if (isset($data['documents'])) {
        foreach ($data['documents'] as $d) {
            Document::updateOrCreate(
                ['document_id' => $d['id']],
                [
                    'case_id' => $d['case_id'] ?? null,
                    'type' => $d['type'] ?? null,
                    'title' => $d['title'] ?? null,
                    'issued_at' => $d['issued_at'] ?? null,
                ]
            );
        }
    }

    return ' All data imported successfully!';
});
