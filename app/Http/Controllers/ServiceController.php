<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return response()->json($services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service = new Service;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();
        $data = [
            'message' => 'Service created successfully',
            'service' => $service
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();
        $data = [
            'message' => 'Service updated successfully',
            'service' => $service
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        $data = [
            'message' => 'Service deleted successfully',
            'service' => $service
        ];
        return response()->json($data);
    }

    public function clients(Request $request)
    {
        $service = Service::find($request->service_id);
        $clients = $service->clients;
        $data = [
            'message' => 'Clients fetched successfully',
            'clients' => $clients
        ];
        return  response()->json($data);
    }
}
