<?php

namespace App\Http\Controllers;

use App\Models\WapiMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WapiController extends Controller
{
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
            "type" => $message->message->type,
            'messageText' => $message,
            'messageId' => $data['id']['id'],
            'messageHash' => $hash,
        ];
        WapiMessage::create($logArray);

    }
    function test(Request $request) {
        dd($request);
    }
}
