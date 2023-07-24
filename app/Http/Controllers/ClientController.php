<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        $data = [];
        foreach ($clients as $client) {
            $data[] = [
                'id' => $client->id,
                'name' => $client->name,
                'email' => $client->email,
                'phone' => $client->phone,
                'services' => $client->services
            ];
        }
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new Client;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();
        $data = [
            'message' => 'Client created successfully',
            'client' => $client
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $data = [
            'client' => $client,
            'services' => $client->services
        ];
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();
        $data = [
            'message' => 'Client updated successfully',
            'client' => $client
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        $data = [
            'message' => 'Client deleted successfully',
            'client' => $client
        ];
        return response()->json($data);
    }

    public function attach(Request $request)
    {
        $client = Client::find($request->client_id);
        $client->services()->attach($request->service_id);
        $data = [
            'message' => 'Service attached successfully',
            'client' => $client
        ];
        return response()->json($data);
    }

    public function detach(Request $request)
    {
        $client = Client::find($request->client_id);
        $client->services()->detach($request->service_id);
        $data = [
           'message' => 'Service detached successfully',
            'client' => $client
        ];
        return response()->json($data);
    }
}
