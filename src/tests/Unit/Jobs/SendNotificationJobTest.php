<?php

namespace Tests\Unit\Jobs;

use Tests\TestCase;
use App\Models\User;
use App\Models\Notification;
use App\Jobs\SendNotificationJob;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendNotificationJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_creates_notification()
    {
        $user = User::factory()->create();

        $job = new SendNotificationJob(
            $user->id,
            'Test Title',
            'Test Message',
            'info'
        );

        $job->handle();

        $this->assertDatabaseHas('notifications', [
            'user_id' => $user->id,
            'title' => 'Test Title',
            'message' => 'Test Message',
            'type' => 'info'
        ]);
    }
}