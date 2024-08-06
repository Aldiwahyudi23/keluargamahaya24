<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    protected $token;

    public function __construct()
    {
        $this->token = env('FONNTE_API_TOKEN'); // Simpan token Anda di file .env
    }

    public function sendMessage($target, $message, $url = null, $filename = null)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->token
        ])->post('https://api.fonnte.com/send', array_filter([
            'target' => $target,
            'message' => $message,
            'url' => $url,
            'filename' => $filename,
        ]));

        if ($response->failed()) {
            Log::error("Fonnte API error: " . $response->body());
            return false;
        }

        return $response->json();
    }
}
