<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteController extends Controller
{
    public function handleRequest(Request $request)
    {
        $data = $request->all();

        $device = $data['device'] ?? null;
        $sender = $data['sender'] ?? null;
        $message = $data['message'] ?? null;
        $member = $data['member'] ?? null; // group member who sent the message
        $name = $data['name'] ?? null;
        $location = $data['location'] ?? null;

        $token = "@Mx6RkRVz60S#j8YGi6T";

        // Data below will only be received by device with all feature packages
        $url = $data['url'] ?? null;
        $filename = $data['filename'] ?? null;
        $extension = $data['extension'] ?? null;

        $reply = [];

        switch (strtolower($message)) {
            case 'test':
                $reply = ["message" => "working great!"];
                break;
            case 'image':
                $reply = [
                    "message" => "image message",
                    "url" => "https://filesamples.com/samples/image/jpg/sample_640%C3%97426.jpg",
                ];
                break;
            case 'audio':
                $reply = [
                    "message" => "audio message",
                    "url" => "https://filesamples.com/samples/audio/mp3/sample3.mp3",
                    "filename" => "music",
                ];
                break;
            case 'video':
                $reply = [
                    "message" => "video message",
                    "url" => "https://filesamples.com/samples/video/mp4/sample_640x360.mp4",
                ];
                break;
            case 'file':
                $reply = [
                    "message" => "file message",
                    "url" => "https://filesamples.com/samples/document/docx/sample3.docx",
                    "filename" => "document",
                ];
                break;
            default:
                $reply = [
                    "message" => "Maaf, saya tidak mengerti. Silakan gunakan salah satu kata kunci berikut:\n\nHello\nAudio\nVideo\nImage\nFile",
                ];
        }

        $response = $this->sendFonnte($sender, $reply, $token);
        return response()->json($response);
    }

    private function sendFonnte($target, $data, $token)
    {
        $response = Http::withHeaders([
            'Authorization' => $token
        ])->post('https://api.fonnte.com/send', array_filter([
            'target' => $target,
            'message' => $data['message'] ?? '',
            'url' => $data['url'] ?? '',
            'filename' => $data['filename'] ?? '',
        ]));

        if ($response->failed()) {
            Log::error("Fonnte API error: " . $response->body());
        }

        return $response->json();
    }
}
