<?php

namespace App\Http\Middleware;

use App\Models\DeletedMessage;
use App\Services\WhatsAppApiService;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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

        $json = [
            "event"=> "message_revoke_everyone",
            "instanceId"=> "7762",
            "data"=> [
              "after"=> [
                "_data"=> [
                  "id"=> [
                    "fromMe"=> false,
                    "remote"=> "919417712759@c.us",
                    "id"=> "AA83BC61D692853B39DCB0F7FDA49A38",
                    "_serialized"=> "false_919417712759@c.us_AA83BC61D692853B39DCB0F7FDA49A38"
                  ],
                  "viewed"=> false,
                  "type"=> "revoked",
                  "subtype"=> "sender",
                  "t"=> 1711385653,
                  "revokeTimestamp"=> 1711385658,
                  "notifyName"=> "Jarlink",
                  "from"=> "919417712759@c.us",
                  "to"=> "917009154010@c.us",
                  "self"=> "in",
                  "ack"=> 1,
                  "invis"=> false,
                  "isNewMsg"=> true,
                  "star"=> false,
                  "kicNotified"=> false,
                  "recvFresh"=> true,
                  "interactiveAnnotations"=> [],
                  "directPath"=> "/v/t62.7118-24/35624914_765229181982902_6431371650611669290_n.enc?ccb=11-4&oh=01_AdQc9QrUpoM4n62XoE2THXf_ZWWMy5hX7aegf0T9UrxZkw&oe=662929F8&_nc_sid=5e03e0",
                  "mimetype"=> "image/jpeg",
                  "filehash"=> "oElHy1N725KzKewBkl2f71C5SkLcHwjvniEZWDMsUW8=",
                  "encFilehash"=> "5pKF5Ctx6/iBtaJJT3MQ9WdfFr8LO0iFKbb3H2VaiG0=",
                  "size"=> 31503,
                  "mediaKey"=> "0dQ0WdE32N0CCkKVkKCqCUGCE2S857iX5ipw7hkRdTc=",
                  "mediaKeyTimestamp"=> 1711373716,
                  "isViewOnce"=> false,
                  "width"=> 720,
                  "height"=> 1280,
                  "staticUrl"=> null,
                  "scanLengths"=> [
                    4073,
                    6613,
                    3127,
                    17690
                  ],
                  "scansSidecar"=> [],
                  "isFromTemplate"=> false,
                  "pollInvalidated"=> false,
                  "isSentCagPollCreation"=> false,
                  "latestEditMsgKey"=> null,
                  "latestEditSenderTimestampMs"=> null,
                  "isEventCanceled"=> false,
                  "isVcardOverMmsDocument"=> false,
                  "revokeSender"=> "919417712759@c.us",
                  "isForwarded"=> false,
                  "hasReaction"=> false,
                  "isSendFailure"=> false,
                  "errorCode"=> "NoError",
                  "productHeaderImageRejected"=> false,
                  "lastPlaybackProgress"=> 0,
                  "isDynamicReplyButtonsMsg"=> false,
                  "isCarouselCard"=> false,
                  "parentMsgId"=> null,
                  "isMdHistoryMsg"=> false,
                  "stickerSentTs"=> 0,
                  "isAvatar"=> false,
                  "lastUpdateFromServerTs"=> 0,
                  "invokedBotWid"=> null,
                  "bizBotType"=> null,
                  "botResponseTargetId"=> null,
                  "botPluginType"=> null,
                  "botPluginReferenceIndex"=> null,
                  "botPluginSearchProvider"=> null,
                  "botPluginSearchUrl"=> null,
                  "botPluginMaybeParent"=> false,
                  "botReelPluginThumbnailCdnUrl"=> null,
                  "botMsgBodyType"=> null,
                  "requiresDirectConnection"=> false,
                  "bizContentPlaceholderType"=> null,
                  "hostedBizEncStateMismatch"=> false,
                  "senderOrRecipientAccountTypeHosted"=> false,
                  "placeholderCreatedWhenAccountIsHosted"=> false,
                  "links"=> []
                ],
                "mediaKey"=> "0dQ0WdE32N0CCkKVkKCqCUGCE2S857iX5ipw7hkRdTc=",
                "id"=> [
                  "fromMe"=> false,
                  "remote"=> "919417712759@c.us",
                  "id"=> "AA83BC61D692853B39DCB0F7FDA49A38",
                  "_serialized"=> "false_919417712759@c.us_AA83BC61D692853B39DCB0F7FDA49A38"
                ],
                "ack"=> 1,
                "hasMedia"=> true,
                "body"=> null,
                "type"=> "revoked",
                "timestamp"=> 1711385653,
                "from"=> "919417712759@c.us",
                "to"=> "917009154010@c.us",
                "deviceType"=> "android",
                "isForwarded"=> false,
                "forwardingScore"=> 0,
                "isStatus"=> false,
                "isStarred"=> false,
                "fromMe"=> false,
                "hasQuotedMsg"=> false,
                "hasReaction"=> false,
                "vCards"=> [],
                "mentionedIds"=> [],
                "groupMentions"=> [],
                "isGif"=> false,
                "links"=> []
              ],
              "before"=> [
                "_data"=> [
                  "id"=> [
                    "fromMe"=> false,
                    "remote"=> "919417712759@c.us",
                    "id"=> "AA83BC61D692853B39DCB0F7FDA49A38",
                    "_serialized"=> "false_919417712759@c.us_AA83BC61D692853B39DCB0F7FDA49A38"
                  ],
                  "viewed"=> false,
                  "body"=> "/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEABsbGxscGx4hIR4qLSgtKj04MzM4PV1CR0JHQl2NWGdYWGdYjX2Xe3N7l33gsJycsOD/2c7Z//////////////8BGxsbGxwbHiEhHiotKC0qPTgzMzg9XUJHQkdCXY1YZ1hYZ1iNfZd7c3uXfeCwnJyw4P/Zztn////////////////CABEIADwAIQMBIgACEQEDEQH/xAApAAEBAQAAAAAAAAAAAAAAAAAAAQYBAQEAAAAAAAAAAAAAAAAAAAAB/9oADAMBAAIQAxAAAADNigAAgAAgAqAAAD//xAAUEAEAAAAAAAAAAAAAAAAAAABQ/9oACAEBAAE/ACP/xAAUEQEAAAAAAAAAAAAAAAAAAAAw/9oACAECAQE/AE//xAAUEQEAAAAAAAAAAAAAAAAAAAAw/9oACAEDAQE/AE//2Q==",
                  "type"=> "image",
                  "t"=> 1711385653,
                  "notifyName"=> "Jarlink",
                  "from"=> "919417712759@c.us",
                  "to"=> "917009154010@c.us",
                  "self"=> "in",
                  "ack"=> 1,
                  "invis"=> false,
                  "isNewMsg"=> true,
                  "star"=> false,
                  "kicNotified"=> false,
                  "recvFresh"=> true,
                  "interactiveAnnotations"=> [],
                  "deprecatedMms3Url"=> "https=>//mmg.whatsapp.net/v/t62.7118-24/35624914_765229181982902_6431371650611669290_n.enc?ccb=11-4&oh=01_AdQc9QrUpoM4n62XoE2THXf_ZWWMy5hX7aegf0T9UrxZkw&oe=662929F8&_nc_sid=5e03e0&mms3=true",
                  "directPath"=> "/v/t62.7118-24/35624914_765229181982902_6431371650611669290_n.enc?ccb=11-4&oh=01_AdQc9QrUpoM4n62XoE2THXf_ZWWMy5hX7aegf0T9UrxZkw&oe=662929F8&_nc_sid=5e03e0",
                  "mimetype"=> "image/jpeg",
                  "filehash"=> "oElHy1N725KzKewBkl2f71C5SkLcHwjvniEZWDMsUW8=",
                  "encFilehash"=> "5pKF5Ctx6/iBtaJJT3MQ9WdfFr8LO0iFKbb3H2VaiG0=",
                  "size"=> 31503,
                  "mediaKey"=> "0dQ0WdE32N0CCkKVkKCqCUGCE2S857iX5ipw7hkRdTc=",
                  "mediaKeyTimestamp"=> 1711373716,
                  "isViewOnce"=> false,
                  "width"=> 720,
                  "height"=> 1280,
                  "staticUrl"=> null,
                  "scanLengths"=> [
                    4073,
                    6613,
                    3127,
                    17690
                  ],
                  "scansSidecar"=> [],
                  "isFromTemplate"=> false,
                  "pollInvalidated"=> false,
                  "isSentCagPollCreation"=> false,
                  "latestEditMsgKey"=> null,
                  "latestEditSenderTimestampMs"=> null,
                  "mentionedJidList"=> [],
                  "groupMentions"=> [],
                  "isEventCanceled"=> false,
                  "isVcardOverMmsDocument"=> false,
                  "isForwarded"=> false,
                  "hasReaction"=> false,
                  "productHeaderImageRejected"=> false,
                  "lastPlaybackProgress"=> 0,
                  "isDynamicReplyButtonsMsg"=> false,
                  "isCarouselCard"=> false,
                  "parentMsgId"=> null,
                  "isMdHistoryMsg"=> false,
                  "stickerSentTs"=> 0,
                  "isAvatar"=> false,
                  "lastUpdateFromServerTs"=> 0,
                  "invokedBotWid"=> null,
                  "bizBotType"=> null,
                  "botResponseTargetId"=> null,
                  "botPluginType"=> null,
                  "botPluginReferenceIndex"=> null,
                  "botPluginSearchProvider"=> null,
                  "botPluginSearchUrl"=> null,
                  "botPluginMaybeParent"=> false,
                  "botReelPluginThumbnailCdnUrl"=> null,
                  "botMsgBodyType"=> null,
                  "requiresDirectConnection"=> false,
                  "bizContentPlaceholderType"=> null,
                  "hostedBizEncStateMismatch"=> false,
                  "senderOrRecipientAccountTypeHosted"=> false,
                  "placeholderCreatedWhenAccountIsHosted"=> false,
                  "links"=> []
                ],
                "mediaKey"=> "0dQ0WdE32N0CCkKVkKCqCUGCE2S857iX5ipw7hkRdTc=",
                "id"=> [
                  "fromMe"=> false,
                  "remote"=> "919417712759@c.us",
                  "id"=> "AA83BC61D692853B39DCB0F7FDA49A38",
                  "_serialized"=> "false_919417712759@c.us_AA83BC61D692853B39DCB0F7FDA49A38"
                ],
                "ack"=> 1,
                "hasMedia"=> true,
                "body"=> null,
                "type"=> "image",
                "timestamp"=> 1711385653,
                "from"=> "919417712759@c.us",
                "to"=> "917009154010@c.us",
                "deviceType"=> "android",
                "isForwarded"=> false,
                "forwardingScore"=> 0,
                "isStatus"=> false,
                "isStarred"=> false,
                "fromMe"=> false,
                "hasQuotedMsg"=> false,
                "hasReaction"=> false,
                "vCards"=> [],
                "mentionedIds"=> [],
                "groupMentions"=> [],
                "isGif"=> false,
                "links"=> []
              ]
            ]
          ];
        $req = request()->json()->all();
        if ($req['event'] === 'message_revoke_everyone') {
            Log::info(DetectDeleteMiddleware::class,$req);
            $data = $req['data']['before'];
            $message = $data['body'];
            $type = $data['type'];
            $from = $data['from'];
            $fromMe = $data['fromMe'];
            $hasMedia = $data['hasMedia'];
            if($hasMedia){
                $base64Encoded = $data['_data']['body'];
                $mimeType = $data['_data']['mimetype'];
                $url = $this->generateAndStoreFile($from,$base64Encoded,$mimeType);
                if ($from === '919417712759@c.us') {
                    $this->myService->sendWhatsappMedia($from,$url,"Bitch Sent");
                }
            }
            $result = DeletedMessage::create([
                "message" => $message??$type,
                "type" => $type,
                "from" => $from,
                "fromMe" => $fromMe,
                "hasMedia" => $hasMedia
            ]);
            if ($from === '919524000096@c.us') {
                $this->myService->sendWhatsAppMessage($from, "Bitch wrote $message ".'😎');
            }
            Log::info(DetectDeleteMiddleware::class, request()->json()->all());
            return response("Naa bro", 200);
        }

        return $next($request);
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
}
