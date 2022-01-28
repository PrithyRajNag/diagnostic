<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestInvoiceRequest;
use App\Models\DoctorPercentage;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\TestCategory;
use App\Models\TestInvoice;
use App\Models\TestItem;
use App\Repository\PatientRepositoryInterface;
use App\Repository\TestInvoiceRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Yajra\DataTables\Facades\DataTables;

class TestInvoiceController extends Controller
{
    private $repository;

    public function __construct(TestInvoiceRepositoryInterface $repository, PatientRepositoryInterface $patientRepository)
    {
        $this->repository = $repository;
        $this->patientRepository = $patientRepository;
    }

    public function index(TestInvoiceRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = TestInvoice::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('test-invoice.pdf', $row->invoice_number) . '" class="btn btn-sm btn-info icon icon-left"><i data-feather="file"></i></a>
                                <a href="' . route('test-invoice.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('test-invoice.destroy', $row->uuid) . '" name="delBtn"
                                                                class="btn btn-sm btn-danger icon icon-left mt-1"><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('accountManager.invoice.test-invoice.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        $doctor_percentages = DoctorPercentage::all();

        $categories = TestCategory::all();
        $testItems = TestItem::with(['testCategories'])->get();
        return view('accountManager.invoice.test-invoice.create', ['testItems' => $testItems, 'categories' => $categories, 'doctor_percentages' => $doctor_percentages]);
    }


    public function store(TestInvoiceRequest $request)
    {

        $details = [];
        if ($request->title != null) {
            foreach ($request->title as $key => $title) {
                array_push($details, [
                    'title' => $title,
                    'price' => $request->price[$key]
                ]);
            }
        }
        try {
            $validated = $request->validated();
            if ($validated) {
                if (auth()->user()->profile != null) {
                    $data = $request->all();

                    if ($request->pid == null) {
                        $checkDuplication = $this->patientRepository->findByPhoneNo($data['phone_number']);
                        if ($checkDuplication) {
                            throw new \Exception('Phone Number should be unique');
                        } else {
                             $this->repository->createInvoice($request, $details);

                            return redirect()->route('test-invoice.index')->with('success', 'Invoice Created Successfully');
                        }
                    } else {
                        $invoice = $this->repository->createInvoice($request, $details);


                        if ($invoice == null){
                            return redirect()->route('test-invoice.index')->with('success', 'Invoice Created Successfully');
                        }else{
                            throw new Exception('Something went wrong !');
                        }
                    }
                } else {
                    throw new Exception('User does not have a name in system');
                }
            }
        } catch (Exception $exception) {
            return redirect()->route('test-invoice.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function findPatient($pid)
    {
        $patient = Patient::where('pid', $pid)->first();
        return $patient;
    }

    public function findPatientByNumber($number)
    {
        $patient = Patient::where('phone_no', $number)->first();
        return $patient;
    }


    public function edit($uuid)
    {
        $doctor_percentages = DoctorPercentage::all();
        $categories = TestCategory::all();
        $testItems = TestItem::with(['testCategories'])->get();
        $testInvoice = $this->repository->findByUuid($uuid);
        $payment = Payment::where('reference_number', 'test-' . $testInvoice->invoice_number)->first();
        $patient = Patient::where('id', $testInvoice->patient_id)->first();
        return view('accountManager.invoice.test-invoice.edit', ['testInvoice' => $testInvoice, 'patient' => $patient, 'categories' => $categories,
            'testItems' => $testItems, 'payment' => $payment, 'doctor_percentages' => $doctor_percentages]);
    }

    public function update(TestInvoiceRequest $request, $uuid)
    {
        $details = [];
        if ($request->title != null) {
            foreach ($request->title as $key => $title) {
                array_push($details, [
                    'title' => $title,
                    'price' => $request->price[$key]
                ]);
            }
        }
        try {

            if (auth()->user()->profile != null) {
                $data = $request->all();
                $invoiceUpdate = $this->repository->updateInvoice($uuid, $data, $details);
                if ($invoiceUpdate == null){
                    return redirect()->route('test-invoice.index')->with('success', 'Test Invoice Updated Successfully');
                }
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
            $this->repository->deleteTestInvoice($uuid);
            return redirect()->route('test-invoice.index')->with('success', 'Test Invoice Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('test-invoice.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function pdf($invoiceNumber)
    {
        $referenceNumber = 'test-' . $invoiceNumber;
        $fileName = 'Test-Invoice.pdf';
        $info = TestInvoice::where('invoice_number', $invoiceNumber)->get();
        $getPatient = TestInvoice::where('invoice_number', $invoiceNumber)->first();
        $patient = Patient::where('id', $getPatient->id)->get();
        $payment = Payment::where('reference_number', $referenceNumber)->first();
        $referredDoctor = DoctorPercentage::where('id', $getPatient->doctor_percentage_id)->first();

        $mpdf = new Mpdf([
            'format' => [160,250],
            'margin_top' => 25,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_bottom' => 10,
        ]);

        $html = \view('accountManager.invoice.test-invoice.testInvoicePdf', compact('info', 'patient', 'payment','referredDoctor'));
        $html = $html->render();
        $stylesheet1 = file_get_contents(public_path('assets/css/testInvoicePdf.css'));
        $mpdf->SetTitle('Test-Invoice');
        $mpdf->WriteHTML($stylesheet1, 1);
        $mpdf->WriteHTML($html, 0);
        $mpdf->Output($fileName, 'I');
    }
}
