<?php

namespace App\Jobs;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $title;
    protected $message;
    protected $type;

    public function __construct($userId, $title, $message, $type = null)
    {
        $this->userId = $userId;
        $this->title = $title;
        $this->message = $message;
        $this->type = $type;
    }

    public function handle(): void
    {
        Notification::create([
            'user_id' => $this->userId,
            'title' => $this->title,
            'message' => $this->message,
            'type' => $this->type
        ]);
    }
}