<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\Vehicle;
use App\Models\Party;
use App\Models\CaseModel;
use App\Models\Inspection;
use App\Models\User;
use App\Models\Document;

class ImportController extends Controller
{
    private string $url = 'https://deskplan.lv/muita/app.json';
    private string $defaultPassword = 'Login_user@123';

    public function fetchAndGenerateUsers()
    {
        $response = Http::timeout(60)->get($this->url);

        if (!$response->successful()) {
            return ' Failed to fetch JSON';
        }

        $data = $response->json();

        if (empty($data['users']) || !is_array($data['users'])) {
            return ' No users found in JSON';
        }

        foreach ($data['users'] as $u) {

            $email = $u['email']
                ?? Str::slug(explode(' ', $u['full_name'] ?? 'user')[0])
                . $u['id'] . '@gmail.com';

            User::updateOrCreate(
                ['external_id' => $u['id']],
                [
                    'email'     => $email,
                    'full_name' => $u['full_name'] ?? null,
                    'role'      => $u['role'] ?? 'broker',
                    'active'    => $u['active'] ?? true,
                    'password'  => Hash::make($this->defaultPassword),
                ]
            );
        }

        return ' Users imported successfully';
    }

    public function fetchAll()
    {
        $response = Http::timeout(60)->get($this->url);

        if (!$response->successful()) {
            return ' Failed to fetch JSON';
        }

        $data = $response->json();

        if (!empty($data['vehicles'])) {
            foreach ($data['vehicles'] as $v) {
                Vehicle::updateOrCreate(
                    ['vehicle_id' => $v['id']],
                    [
                        'plate_no' => $v['plate_no'] ?? null,
                        'country'  => $v['country'] ?? null,
                        'make'     => $v['make'] ?? null,
                        'model'    => $v['model'] ?? null,
                        'vin'      => $v['vin'] ?? null,
                    ]
                );
            }
        }

        if (!empty($data['parties'])) {
            foreach ($data['parties'] as $p) {
                Party::updateOrCreate(
                    ['party_id' => $p['id']],
                    [
                        'type'     => $p['type'] ?? null,
                        'name'     => $p['name'] ?? null,
                        'reg_code' => $p['reg_code'] ?? null,
                        'vat'      => $p['vat'] ?? null,
                        'country'  => $p['country'] ?? null,
                        'email'    => $p['email'] ?? null,
                        'phone'    => $p['phone'] ?? null,
                    ]
                );
            }
        }


       if (!empty($data['cases'])) {
    CaseModel::withoutEvents(function () use ($data) {
        foreach ($data['cases'] as $c) {
            CaseModel::updateOrCreate(
                ['case_id' => $c['id']],
                [
                    'external_ref' => $c['external_ref'] ?? null,
                    'status' => $c['status'] ?? null,
                    'priority' => $c['priority'] ?? null,
                    'arrival_ts' => $c['arrival_ts'] ?? null,
                    'checkpoint_id' => $c['checkpoint_id'] ?? null,
                    'origin_country' => $c['origin_country'] ?? null,
                    'destination_country'=> $c['destination_country'] ?? null,
                    'risk_flags' => $c['risk_flags'] ?? [],
                    'declarant_id' => $c['declarant_id'] ?? null,
                    'consignee_id' => $c['consignee_id'] ?? null,
                    'vehicle_id' => $c['vehicle_id'] ?? null,
                ]
            );
        }
    });
}

          if (!empty($data['inspections'])) {
          foreach ($data['inspections'] as $i) {
          Inspection::updateOrCreate(
            ['inspection_id' => $i['id']],
            [
                'case_id'      => $i['case_id'] ?? null,
                'type'         => $i['type'] ?? null,
                'requested_by' => $i['requested_by'] ?? null,
                'start_ts'     => $i['start_ts'] ?? null,
                'location'     => $i['location'] ?? null,
                'checks'       => $i['checks'] ?? [],
                'assigned_to' => $i['assigned_to'],
            ]
        );
    }
}

        if (!empty($data['users'])) {
            foreach ($data['users'] as $u) {

                $email = $u['email']
                    ?? Str::slug(explode(' ', $u['full_name'] ?? 'user')[0])
                    . $u['id'] . '@gmail.com';

                User::updateOrCreate(
                ['external_id' => $u['id']],
     [
                 'full_name' => $u['full_name'],
                 'email'     => $email,
                 'role'      => $u['role'],
                 'active'    => $u['active'],
                'password'  => Hash::make('Login_user@123'),
    ]
);

            }
        }

        if (!empty($data['documents'])) {
            foreach ($data['documents'] as $d) {
                Document::updateOrCreate(
                    ['document_id' => $d['id']],
                    [
                        'case_id'   => $d['case_id'] ?? null,
                        'type'      => $d['type'] ?? null,
                        'title'     => $d['title'] ?? null,
                        'issued_at' => $d['issued_at'] ?? null,
                    ]
                );
            }
        }

        return ' All data imported successfully!!';
    }
}
