<?php

namespace App\Http\Middleware;

use App\Models\DeletedMessage;
use App\Services\WhatsAppApiService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class DetectDeleteMiddleware
{

    protected $myService;

    public function __construct(WhatsAppApiService $myService)
    {
        $this->myService = $myService;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $req = request()->json()->all();
        if ($req['event'] === 'message_revoke_everyone') {
            $data = $req['data']['before'];
            $message = $data['body'];
            $type = $data['type'];
            $from = $data['from'];
            $fromMe = $data['fromMe'];
            $hasMedia = $data['hasMedia'];
            $result = DeletedMessage::create([
                "message" => $message,
                "type" => $type,
                "from" => $from,
                "fromMe" => $fromMe,
                "hasMedia" => $hasMedia
            ]);
            if ($from === '919417712759@c.us') {
                $this->myService->sendWhatsAppMessage($from, "Bitch wrote $message");
            }
            Log::info(DetectDeleteMiddleware::class, request()->json()->all());
            return response("Naa bro", 200);
        }

        return $next($request);
    }
}
