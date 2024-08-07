<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'amount' => $this->amount,
            'status' => $this->status,
            'billed_dated' => $this->billed_dated,
            'paid_dated' => $this->paid_dated,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
