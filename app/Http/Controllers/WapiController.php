<?php

namespace App\Http\Controllers;

use App\Models\WapiMessage;
use App\Services\WhatsAppApiService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WapiController extends Controller
{

    protected WhatsAppApiService $apiService;


    public function __construct(WhatsAppApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    function onMessageCreate(Request $request)
    {

        $data = request()->json()->all()['data']['message']['_data'];
        $message = $data['body'];
        $personName = $data['notifyName'];
        $from = $data['from'];
        $hash = $data['id']['_serialized'];
        $media = request()->json()->all()['data']["media"];

        $messageNumber = WapiMessage::where('from', $from)->count();
        $logArray = [
            'from' => $from,
            'displayName' => $personName,
            'to' => $data['to'],
            'counter' => $messageNumber + 1,
            "type" =>  $data['type'],
            'messageText' => $data['type'] === 'media'
                             ? $this->generateAndStoreFile($from, $media['data'], $media['mimetype'])
                              : $message,
            'messageId' => $data['id']['id'],
            'messageHash' => $hash,
        ];
        WapiMessage::create($logArray);
    }

    function generateAndStoreFile($from, $media, $mimetype)
    {
        $now = Carbon::now("Asia/Kolkata")->timestamp;
        $data = substr($media, strpos($media, ',') + 1);
        $file = base64_decode($data);
        // Use loadHtml for flexibility
        $filename = $from . "_$now." . mime_content_type($media);
        $filePath = $mimetype . '/' . $filename;
        Storage::disk('public')->put($filePath, $file);
        return Storage::disk('public')->url($filePath);
    }

    function sendMessage(Request $request)
    {
        $message = $request->message ?? "Nope";
        $this->apiService->sendWhatsAppMessage('919524000096@c.us', $message);
    }
    function test(Request $request)
    {
        dd($request);
    }
}
