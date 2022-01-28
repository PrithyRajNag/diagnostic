<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientBillingInvoiceRequest;
use App\Models\BedList;
use App\Models\Patient;
use App\Models\PatientBillingInvoice;
use App\Models\Payment;
use App\Models\Service;
use App\Repository\PatientBillingInvoiceRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use Yajra\DataTables\Facades\DataTables;

class PatientBillingInvoiceController extends Controller
{
    private $repository;

    public function __construct(PatientBillingInvoiceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function index(PatientBillingInvoiceRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = PatientBillingInvoice::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function ($row) {
                        return $row->first_name . ' ' . $row->last_name ?? 'N/A';
                    })
                    ->addColumn('action', function ($row) {
                        $patient = Patient::where('pid',$row->pid)->first();
                        $btn = '<a href="' . route('patient-billing-invoice.pdf', $row->invoice_number) . '" class="btn btn-sm btn-info icon icon-left"><i data-feather="file"></i></a>
                                <a href="' . route('patient-billing-invoice.edit', $patient->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('patient-billing-invoice.destroy', $row->uuid) . '" name="delBtn"
                                                                class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('accountManager.invoice.patient-billing-invoice.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function edit($uuid)
    {
        $patient = Patient::where('uuid', $uuid)->with('package')->first();
        $beds = BedList::all();
        $bed_assigned = DB::table('patient_histories')->where('patient_id', $patient->id)->where('category', 'BED')->where('type', 'Assigned')->whereBetween('time', [$patient->admit_date, Carbon::now()])->get();
        $bed_unassigned = DB::table('patient_histories')->where('patient_id', $patient->id)->where('category', 'BED')->where('type', 'Unassigned')->whereBetween('time', [$patient->admit_date, Carbon::now()])->get();
        $invoice = PatientBillingInvoice::where('patient_id', $patient->id)->whereBetween('created_at', [$patient->admit_date, Carbon::now()])->first();
        if ($invoice != null){
            $payment = Payment::where('reference_number', 'billing-' . $invoice->invoice_number)->first();
        }else{
            $payment = null;
        }
        $patient_services = DB::table('patient_services')->where('patient_id', $patient->id)->whereBetween('service_date', [$patient->admit_date, Carbon::now()])->get();
        $services = Service::all();
        return view('accountManager.invoice.patient-billing-invoice.edit', ['patient' => $patient, 'bed_assigned' => $bed_assigned, 'bed_unassigned' => $bed_unassigned, 'beds' => $beds, 'services' => $services,'invoice'=>$invoice,'payment'=>$payment,'patient_services'=>$patient_services]);
    }

    public function store(PatientBillingInvoiceRequest $request)
    {
        $service_name = [];
        $service_id = [];
        if ($request->service_id[0] != null) {
            foreach ($request->service_id as $service) {
                if ($service != null) {
                    $item = explode('-', $service);
                    array_push($service_id, $item[0]);
                    array_push($service_name, $item[1]);
                }
            }
        }
        $details = [];
        if ($request->package_name != null) {
            foreach ($request->package_name as $key => $title) {
                array_push($details, [
                    'title' => $title,
                    'price' => $request->package_price[$key]
                ]);
            }
        }
        if ($request->bed_name != null) {
            foreach ($request->bed_name as $key => $title) {
                array_push($details, [
                    'title' => $title,
                    'price' => $request->bed_price[$key]
                ]);
            }
        }
        if ($service_name != null) {
            foreach ($service_name as $key => $title) {
                array_push($details, [
                    'title' => $title,
                    'price' => $request->service_price[$key]
                ]);
            }
        }
        try {
            if (auth()->user()->profile != null) {
                $data = $request->all();
                $this->repository->createInvoice($request, $details, $service_id);
                return redirect()->route('patient.index')->with('success', 'Invoice Created Successfully');
            } else {
                throw new Exception('User does not have a name in system');
            }
        } catch (Exception $exception) {
            return redirect()->route('patient-billing-invoice.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function update(PatientBillingInvoiceRequest $request, $uuid)
    {
        $service_name = [];
        $service_id = [];
        if ($request->service_id[0] != null) {
            foreach ($request->service_id as $service) {
                if ($service != null) {
                    $item = explode('-', $service);
                    array_push($service_id, $item[0]);
                    array_push($service_name, $item[1]);
                }
            }
        }
        $details = [];
        if ($request->package_name != null) {
            foreach ($request->package_name as $key => $title) {
                array_push($details, [
                    'title' => $title,
                    'price' => $request->package_price[$key]
                ]);
            }
        }
        if ($request->bed_name != null) {
            foreach ($request->bed_name as $key => $title) {
                array_push($details, [
                    'title' => $title,
                    'price' => $request->bed_price[$key]
                ]);
            }
        }
        if ($service_name != null) {
            foreach ($service_name as $key => $title) {
                array_push($details, [
                    'title' => $title,
                    'price' => $request->service_price[$key]
                ]);
            }
        }
        try {
            if (auth()->user()->profile != null) {
                $data = $request->all();
                $this->repository->updateInvoice($uuid, $data, $details, $service_id);
                return redirect()->route('patient-billing-invoice.index')->with('success', 'Billing Invoice Updated Successfully');
            } else {
                throw new Exception('User does not have a name in system');
            }

        } catch (Exception $exception) {
            return $exception->getMessage();

        }
    }
    public function destroy($uuid)
    {
        try {
            $this->repository->deleteBillingInvoice($uuid);
            return redirect()->route('patient-billing-invoice.index')->with('success', 'Test Invoice Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('patient-billing-invoice.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
    public function pdf($invoiceNumber)
    {
        $referenceNumber = 'billing-' . $invoiceNumber;
        $fileName = 'Patient-Billing.pdf';
        $info = PatientBillingInvoice::where('invoice_number', $invoiceNumber)->get();
        $getPatient = PatientBillingInvoice::where('invoice_number', $invoiceNumber)->first();
        $patient = Patient::where('pid', $getPatient['pid'])->get();
        $payment = Payment::where('reference_number', $referenceNumber)->first();
        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_top' => 30,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_bottom' => 10,
        ]);

        $html = \view('accountManager.invoice.patient-billing-invoice.patientBillingInvoicePdf', compact('info', 'patient', 'payment'));
        $html = $html->render();
        $stylesheet1 = file_get_contents(public_path('assets/css/testInvoicePdf.css'));
        $mpdf->SetTitle('Test-Invoice');
        $mpdf->WriteHTML($stylesheet1, 1);
        $mpdf->WriteHTML($html, 0);
        $mpdf->Output($fileName, 'I');
    }
}
