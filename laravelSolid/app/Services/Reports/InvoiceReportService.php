<?php

namespace App\Services\Reports;

use App\Models\Invoice;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class InvoiceReportService {

    public function getReportByMonth()
    {
        return Invoice::withSum('products', DB::raw('invoice_product.price * invoice_product.quantity'))
            ->orderBy('invoice_date', 'desc')
            ->get()
            ->groupBy(function($invoice) {
                return $invoice->invoice_date->format('Y-m');
            });
    }

    public function getReportByProduct()
    {
        return DB::table('invoice_product')
            ->select('products.name', DB::raw('sum(invoice_product.price * invoice_product.quantity) as total_revenue'))
            ->join('products', 'invoice_product.product_id', '=', 'products.id')
            ->groupBy('products.name')
            ->orderBy('total_revenue', 'desc')
            ->get();
    }

    public function downloadAsPdf($report)
    {
        // to be implemented - download as PDF
    }

    public function downloadAsCSV($report)
    {
        // to be implemented - download as CSV
    }

    public function downloadAsXLS($report)
    {
        // to be implemented - download as XLS
    }
}
