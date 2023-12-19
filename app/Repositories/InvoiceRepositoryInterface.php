<?php

namespace App\Repositories;

use App\Models\Invoice;

interface InvoiceRepositoryInterface
{
    public function getUserInvoices(string $userId);

    public function createInvoice(Invoice $invoice);

    public function findInvoiceById(string $invoiceId);

    public function updateInvoice(Invoice $invoice);

    public function deleteInvoice(Invoice $invoice);

    public function getUserInvoicesPaginated($userId, $perPage);

}
