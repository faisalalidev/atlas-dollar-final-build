<?php

namespace App\Http\Controllers\Admin;

use App\Exports\InvoiceProductsExport;
use App\Jobs\InvoiceChangesCronJob;
use App\Models\CronSyncQueue;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends CRUDController
{
    public function __construct()
    {
        parent::__construct();
        $this->primary_model = new Invoice();
        $this->module_name = 'invoices';
        $this->actions = ['delete', 'view','invoice_pdf','invoice_excel'];
        $this->raw_columns = ['actions','invoice_title','invoice_type'];
        $this->invoice_title_view = $this->module_name . '.invoice_title';
        $this->invoice_type_view = $this->module_name . '.invoice_type';
        $this->data_assign['page_title'] = ucwords(str_replace('_', ' ', Str::singular($this->module_name)));
        $this->data_assign['module_name'] = $this->module_name;
        $this->data_assign['module_add_title'] = ucfirst(explode('_', Str::singular($this->module_name))[0]);
    }

    public function show()
    {
        $this->data_assign['module_ajax_listing_url'] = config('constants.ADMIN_PREFIX') . $this->module_name . '_dtListing';

        $this->data_assign['primary_dt_columns'] = $this->primary_model->getDataTableColumns();

        return parent::show();
    }

    public function syncChangesNow()
    {
        dispatch(new InvoiceChangesCronJob());

        return back();
    }

    public function delete(Request $request, $id)
    {
        $data = $this->primary_model->find($id);

        $data->delete();

        $request->session()->flash('success', $this->data_assign['module_add_title'] . ' Deleted');

        return back();
    }

    public function invoiceIframe($id)
    {
        $this->data_assign['data'] = $this->primary_model->findOrFail($id);

        return view($this->module_directory . '.' . $this->module_name . '.view_iframe', $this->data_assign);
    }

    public function downloadPDF($id)
    {
        $data = $this->primary_model->findOrFail($id);

        $pdf = Pdf::loadView('admin_panel.invoices.view_iframe', compact('data'));

        $file_path = public_path('pdf/'. 'Invoice#'. $data->invoice_number .'.pdf');

        $pdf->save($file_path);

        return response()->download($file_path,'Invoice#'. $data->invoice_number .'.pdf');
    }

    public function exportExcel($id)
    {
        $invoice = $this->primary_model->findOrFail($id);

        $file_path = 'excel/Invoice#'.$invoice->invoice_number.'.xlsx';

        $excel = Excel::store(new InvoiceProductsExport($invoice),$file_path);

        return response()->download(storage_path('app/'.$file_path),'Invoice#'. $invoice->invoice_number .'.xlsx');
    }
}
