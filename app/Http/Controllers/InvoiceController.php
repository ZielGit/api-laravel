<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoice\BulkStoreRequest;
use App\Http\Resources\Invoice\InvoiceCollection;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return new InvoiceCollection(Invoice::paginate());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function bulkStore(BulkStoreRequest $request)
    {
        $bulk = collect($request->all())->map(function ($arr, $key) {
            return [
                'customer_id' => $arr['customer_id'],
                'amount' => $arr['amount'],
                'status' => $arr['status'],
                'billed_dated' => $arr['billed_dated'],
                'paid_dated' => $arr['paid_dated'],
                'created_at' => now(), // Añadir timestamp
                'updated_at' => now(), // Añadir timestamp
            ];
        });

        // Crear cada registro individualmente sin mandar created_at y updated_at
        // $bulk->each(function ($item) {
        //     Invoice::create($item);
        // });

        Invoice::insert($bulk->toArray());
    }

    public function show(Invoice $invoice)
    {
        //
    }

    public function edit(Invoice $invoice)
    {
        //
    }

    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    public function destroy(Invoice $invoice)
    {
        //
    }
}
