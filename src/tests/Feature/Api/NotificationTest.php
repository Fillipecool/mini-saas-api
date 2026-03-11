<?php

namespace Tests\Feature\Api;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_list_notifications()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        Notification::factory()->count(3)->create([
            'user_id' => $user->id
        ]);

        $response = $this->getJson('/api/notifications');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_authenticated_user_can_create_notification()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $data = [
            'title' => 'Test Notification',
            'message' => 'This is a test notification.',
            'type' => 'info'
        ];

        $response = $this->postJson('/api/notifications', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'title' => 'Test Notification',
                     'message' => 'This is a test notification.',
                     'type' => 'info'
                 ]);

        $this->assertDatabaseHas('notifications', [
            'title' => 'Test Notification',
            'message' => 'This is a test notification.',
            'type' => 'info',
            'user_id' => $user->id
        ]);
    }
    
    public function test_notifications_endpoint_requires_authentication()
    {
        $response = $this->getJson('/api/notifications');

        $response->assertStatus(401);
    }

}