<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $data = [];
        foreach ($customers as $customer) {
            $data[] = [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'phone' => $customer->phone,
                'services' => $customer->services
            ];
        }
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
        $data = [
            'message' => 'Customer created successfully',
            'customer' => $customer
        ];
        return response()->json($data);
    }

    public function show(Customer $customer)
    {
        $data = [
            'customer' => $customer,
            'services' => $customer->services
        ];
        return response()->json($data);
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
        $data = [
            'message' => 'Customer updated successfully',
            'customer' => $customer
        ];
        return response()->json($data);
    }

    public function destroy(Customer $customer)
    {
        $customer->services()->detach();
        $customer->delete();
        $data = [
            'message' => 'Customer and services deleted successfully',
            'customer' => $customer
        ];
        return response()->json($data);
    }

    public function attach(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        $customer->services()->attach($request->service_id);
        $data = [
            'message' => 'Service attached successfully',
            'customer' => $customer
        ];
        return response()->json($data);
    }

    public function detach(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        $customer->services()->detach($request->service_id);
        $data = [
           'message' => 'Service detached successfully',
            'customer' => $customer
        ];
        return response()->json($data);
    }
}
