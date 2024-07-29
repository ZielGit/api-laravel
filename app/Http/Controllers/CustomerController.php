<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\AttachRequest;
use App\Http\Requests\Customer\DetachRequest;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Http\Resources\Customer\CustomerCollection;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return new CustomerCollection($customers);
    }

    public function store(StoreRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer->loadMissing('invoices'));
    }

    public function update(UpdateRequest $request, Customer $customer)
    {
        $customer->update($request->all());
        return response()->json($customer);
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

    public function attach(AttachRequest $request)
    {
        $customer = Customer::find($request->customer_id);
        $customer->services()->attach($request->service_id);
        $data = [
            'message' => 'Service attached successfully',
            'customer' => $customer
        ];
        return response()->json($data);
    }

    public function detach(DetachRequest $request)
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
