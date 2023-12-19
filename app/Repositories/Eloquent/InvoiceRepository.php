<?php

namespace App\Repositories\Eloquent;

use App\Models\Invoice;
use App\Repositories\InvoiceRepositoryInterface;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function getUserInvoices(string $userId)
    {
        return Invoice::where('user_id', $userId)->get();
    }

    public function createInvoice(Invoice $invoice)
    {
        $invoice->save();
        return $invoice;
    }

    public function findInvoiceById(string $invoiceId)
    {
        return Invoice::findOrFail($invoiceId);
    }

    public function updateInvoice(Invoice $invoice)
    {
        $invoice->save();
        return $invoice;
    }

    public function deleteInvoice(Invoice $invoice)
    {
        $invoice->delete();
        return $invoice;
    }
    public function getUserInvoicesPaginated($userId, $perPage)
    {
        return Invoice::where('user_id', $userId)->paginate($perPage);
    }
}
