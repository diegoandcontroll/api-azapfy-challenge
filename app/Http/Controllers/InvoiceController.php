<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Services\InvoiceService;
use App\Trait\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InvoiceController extends Controller
{
    use HttpResponses;
    private $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index()
    {
        $userId = Auth::id();
        $perPage = 10;
        $invoices = $this->invoiceService->getUserInvoicesPaginated($userId, $perPage);

        return $this->paginatedResponse(
            $invoices->items(),
            $invoices->currentPage(),
            $invoices->perPage(),
            $invoices->total()
        );

    }

    public function store(InvoiceRequest $request)
    {
        $validatedData = $request->validated();
        $invoice = $this->invoiceService->createInvoice($validatedData);

        if ($invoice) {
            return $this->createResponse($invoice);
        }

        return $this->errorResponse('Erro ao criar fatura', 500);
    }

    public function update(Invoice $invoice, InvoiceRequest $request)
    {
        if (Gate::denies('update-invoice', $invoice)) {
            return $this->notFound();
        }

        $validatedData = $request->validated();
        $updatedInvoice = $this->invoiceService->updateInvoice($invoice, $validatedData);

        return $this->successResponse($updatedInvoice);
    }


    public function show(Invoice $invoice)
    {
        if (Gate::denies('view-invoice', $invoice)) {
            return $this->unauthorizedReseponse();
        }

        $retrievedInvoice = $this->invoiceService->getInvoiceById($invoice->id);

        if ($retrievedInvoice) {
            return $this->successResponse($retrievedInvoice);
        }

        return $this->notFound();
    }

    public function destroy(Invoice $invoice)
    {
        if (Gate::denies('delete-invoice', $invoice)) {
            return $this->unauthorizedReseponse();
        }

        $deletedInvoice = $this->invoiceService->deleteInvoice($invoice);

        if ($deletedInvoice) {
            return $this->successResponse(null);
        }

        return $this->errorResponse('Erro ao excluir fatura', 500);
    }
}
