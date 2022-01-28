<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalaryInvoiceRequest;
use App\Models\Account;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\SalaryInvoice;
use App\Repository\SalaryInvoiceRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Yajra\DataTables\Facades\DataTables;

class SalaryInvoiceController extends Controller
{
    private $repository;

    public function __construct(SalaryInvoiceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(SalaryInvoiceRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = SalaryInvoice::with(['profiles'])->get();
                return DataTables::of($data)
                    ->addColumn('profile_id', function (SalaryInvoice $salaryInvoice) {
                        return $salaryInvoice->profiles->full_name ?? 'N/A';
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('salary-invoice.pdf', $row->invoice_number) . '" class="btn btn-sm btn-info icon icon-left"><i data-feather="file"></i></a>
                                <a href="' . route('salary-invoice.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('salary-invoice.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('salary-invoice.destroy', $row->uuid) . '" name="delBtn"
                                                                class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('accountManager.invoice.salary-invoice.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }


    public function create()
    {
        $profiles = Profile::all();
        return view('accountManager.invoice.salary-invoice.create', ['profiles' => $profiles]);
    }


    public function store(SalaryInvoiceRequest $request)
    {
        $description = [];
        array_push($description, [
            'overtime' => $request->overtime,
            'bonus' => $request->bonus,
            'tax' => $request->tax,
            'paid_amount' => $request->paid_amount,
            'due' => $request->due,
        ]);

        try {

            $validate = $request->validated();
            if ($validate) {
                if (auth()->user()->profile != null) {
                    $this->repository->createSalaryInvoice($request, $description);
                    return redirect()->route('salary-invoice.index')->with('success', 'Salary Invoice Created Successfully');
                } else {
                    throw new Exception('User does not have a name in system');
                }
            }

        } catch (\Exception $exception) {
            return redirect()->route('salary-invoice.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {

        $salaryInvoice = $this->repository->findByUuid($uuid);
        $payment = Payment::where('reference_number', 'salary-' . $salaryInvoice->invoice_number)->first();
        return view('accountManager.invoice.salary-invoice.info', ['salaryInvoice' => $salaryInvoice, 'payment' => $payment]);
    }


    public function edit($uuid)
    {
        $salaryInvoice = $this->repository->findByUuid($uuid);
        $payment = Payment::where('reference_number', 'salary-' . $salaryInvoice->invoice_number)->first();
        $profile = Profile::where('id', $salaryInvoice->profile_id)->first();
        return view('accountManager.invoice.salary-invoice.edit', ['salaryInvoice' => $salaryInvoice, 'profile' => $profile, 'payment' => $payment]);
    }


    public function update(SalaryInvoiceRequest $request, $uuid)
    {
        $description = [];
        array_push($description, [
            'overtime' => $request->overtime,
            'bonus' => $request->bonus,
            'tax' => $request->tax,
            'paid_amount' => $request->paid_amount,
            'due' => $request->due,
        ]);

        try {
            if (auth()->user()->profile != null) {
                $data = $request->all();
                $this->repository->updateSalaryInvoice($uuid, $data, $description);
                return redirect()->route('salary-invoice.index')->with('success', 'Salary Invoice Updated Successfully');
            } else {
                throw new Exception('User does not have a name in system');
            }
        } catch (Exception $exception) {
            return redirect()->route('salary-invoice.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteSalaryInvoice($uuid);
            return redirect()->route('salary-invoice.index')->with('success', 'Salary Invoice Deleted Successfully');

        } catch (Exception $exception) {
            return redirect()->route('salary-invoice.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function findStaffByNumber($number)
    {
        $profile = Profile::where('phone_number', $number)->first();
        return $profile;
    }
    public function invoicePdf($invoiceNumber)
    {
        $referenceNumber = 'salary-' . $invoiceNumber;
        $fileName = 'Salary-Invoice.pdf';
        $info = SalaryInvoice::where('invoice_number', $invoiceNumber)->first();
        $profile = Profile::where('id', $info->profile_id)->first();
        $payment = Payment::where('reference_number', $referenceNumber)->first();
        $mpdf = new Mpdf([
            'format' => [105,170],
            'margin_top' => 20,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_bottom' => 10,
        ]);

        $html = \view('accountManager.invoice.salary-invoice.salaryInvoicePdf', compact('info', 'profile', 'payment'));
        $html = $html->render();
        $stylesheet1 = file_get_contents(public_path('assets/css/testInvoicePdf.css'));
        $mpdf->SetTitle('Salary-Invoice');
        $mpdf->WriteHTML($stylesheet1, 1);
        $mpdf->WriteHTML($html, 0);
        $mpdf->Output($fileName, 'I');
    }

}
