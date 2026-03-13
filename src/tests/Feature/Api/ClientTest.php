<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendNotificationJob;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_clients_endpoint_requires_authentication()
    {
        $response = $this->getJson('/api/clients');

        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_list_clients()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        Client::factory()->count(3)->create();

        $response = $this->getJson('/api/clients');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_client_creation_dispatches_notification_job()
    {
        Queue::fake();

        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $data = [
            'name' => 'Client Test',
            'email' => 'client@test.com'
        ];

        $this->postJson('/api/clients', $data);

        Queue::assertPushed(SendNotificationJob::class);
    }

    public function test_authenticated_user_can_create_client()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $data = [
            'name' => 'Client Test',
            'email' => 'client@test.com',
            'phone' => '12345678',
            'work_phone' => '87654321',
            'address' => 'Test Street'
        ];

        $response = $this->postJson('/api/clients', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'email' => 'client@test.com'
                 ]);

        $this->assertDatabaseHas('clients', [
            'email' => 'client@test.com'
        ]);
    }

    public function test_authenticated_user_can_update_client()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $client = Client::factory()->create();

        $response = $this->putJson("/api/clients/{$client->id}", [
            'name' => 'Updated Client'
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'name' => 'Updated Client'
                 ]);
    }

    public function test_authenticated_user_can_delete_client()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $client = Client::factory()->create();

        $response = $this->deleteJson("/api/clients/{$client->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('clients', [
            'id' => $client->id
        ]);
    }
}