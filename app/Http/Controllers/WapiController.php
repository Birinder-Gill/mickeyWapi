<?php

namespace App\Http\Controllers;

use App\Models\WapiMessage;
use App\Services\WhatsAppApiService;
use Carbon\Carbon;
use Illuminate\Http\Request;

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


        $messageNumber = WapiMessage::where('from',$from)->count();
        $logArray = [
            'from' => $from,
            'displayName' => $personName,
            'to' => $data['to'],
            'counter' => $messageNumber + 1,
            "type" =>  $data['type'],
            'messageText' => $message,
            'messageId' => $data['id']['id'],
            'messageHash' => $hash,
        ];
        WapiMessage::create($logArray);

    }

    function sendMessage(Request $request) {
        $message = $request->message??"Nope";
        $this->apiService->sendWhatsAppMessage('919524000096@c.us', $message);
    }
    function test(Request $request) {
        dd($request);
    }
}
