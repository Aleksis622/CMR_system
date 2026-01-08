<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class WebhookController extends Controller
{
    protected $secret;
    public function __construct()
    {
        $this->secret = config('services.webhook.secret'); 
    }

    public function send(array $data, string $url)
    {
        $payload = json_encode($data);
        $hash = hash_hmac('sha256', $payload, $this->secret);

        $response = Http::withHeaders([
            'signature' => "v1={$hash}"
        ])->post($url, $data);

        Log::info("Webhook sent to {$url}", [
            'data' => $data,
            'status' => $response->status()
        ]);

        return $response;
    }

    public function receive(Request $request)
    {
        $signature = $request->header('signature');

        if (!$signature || !str_contains($signature, '=')) {
            abort(401, "Invalid signature format");
        }

        [$v, $hash] = explode('=', $signature);
        $calculated = hash_hmac('sha256', $request->getContent(), $this->secret);

        if (!hash_equals($hash, $calculated)) {
            abort(401, "Invalid signature");
        }

        $payload = $request->json()->all();

        Log::info("Webhook received:", $payload);


        AuditLog::create([
            'user_id'       => Auth::id() ?? null,
            'auditable_type'=> 'Webhook',
            'auditable_id'  => null,
            'action'        => 'webhook_received',
            'old_values'    => null,
            'new_values'    => $payload,
            'ip'            => $request->ip(),
            'user_agent'    => $request->userAgent(),
        ]);


        return response()->json(['status' => 'ok']);
    }
}