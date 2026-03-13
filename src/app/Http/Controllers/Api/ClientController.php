<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendNotificationJob;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json(Client::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients',
            'phone' => 'nullable|string|max:20',
            'work_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $client = Client::create($validated);

        SendNotificationJob::dispatch(
            $request->user()->id,
            'Client created',
            "Client {$client->name} (ID: {$client->id}) was created.",
            'client'
        );

        return response()->json($client, 201);
    }

    public function show(Client $client)
    {
        return response()->json($client);
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'work_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $client->update($validated);

        SendNotificationJob::dispatch(
            $request->user()->id,
            'Client updated',
            "Client {$client->name} was updated.",
            'client'
        );

        return response()->json($client);
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json(null, 204);
    }
}
