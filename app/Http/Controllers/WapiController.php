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
            'messageText' => $data['type'] === 'image'
                             ? $this->generateAndStoreFile($from, $media['data'], $media['mimetype'])
                              : $message,
            'messageId' => $data['id']['id'],
            'messageHash' => $hash,
        ];
        WapiMessage::create($logArray);
    }


    public function generateAndStoreFile($from, $base64Media, $mimeType)
    {
        $now = Carbon::now("Asia/Kolkata")->timestamp;
        $extension = explode('/', explode(';', $mimeType)[0])[1]; // Extract extension from MIME type

        $filename = $from . "_$now." .$extension;

        // Decode the base64 media file
        $fileData = base64_decode($base64Media);

        // Define the storage path, using the 'public' disk
        $filePath = "wapi/media/{$filename}";

        // Store the file in the storage
        Storage::disk('public')->put($filePath, $fileData);

        // Generate a URL to access the stored media
        $url = Storage::disk('public')->url($filePath);

        // Return the URL as a response
        return $url;
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
