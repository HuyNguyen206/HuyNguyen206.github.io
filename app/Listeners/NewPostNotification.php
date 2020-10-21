<?php

namespace App\Listeners;

use App\Events\NewPostAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\URL;
use NNV\OneSignal\OneSignal;
use NNV\OneSignal\API\Notification;
use Log;

class NewPostNotification
{
    private $oneSignal;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->oneSignal = new OneSignal(
            env("ONESIGNAL_AUTH_KEY"), env("ONESIGNAL_APP_ID"), env("ONESIGNAL_APP_REST_KEY")
        );
    }

    /**
     * Handle the event.
     *
     * @param  NewPostAdded  $event
     * @return void
     */
    public function handle(NewPostAdded $event)
    {
        //
        $oneSingalNotification = new Notification($this->oneSignal);
        $post = $event->post;
        $notificationData = [
            "included_segments" => ["All"],
            "contents" => [
                "en" => $post->name,
            ],
            "headings" => [
                "en" => $post->name,
            ],
            "web_buttons" => [
                [
                    "id" => "readmore-button",
                    "text" => "Read more",
                    "url" => URL::to('/').'/'.$post->category->slug.'/'.$post->id.'/'.to_slug($post->name),
                    "icon" => $post->feature_image_path,
                ]
            ],
            "isChromeWeb" => true,
        ];

        $notification = $oneSingalNotification->create($notificationData);

//        Log::useDailyFiles(storage_path() . "/logs/onesignal.log");
//        Log::info($notification);
    }
}
