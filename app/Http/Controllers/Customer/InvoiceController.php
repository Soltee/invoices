<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Models\Invoice;
use App\Models\User;
use Auth;

use Inertia\Inertia;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
// use App\Mail\SendInvoice;
use App\Mail\InvoiceSent;

use Illuminate\Support\Facades\Storage;

// use LaravelDaily\Invoices\Invoice as PDF;
// use LaravelDaily\Invoices\Classes\Party;
// use LaravelDaily\Invoices\Classes\InvoiceItem;
use PDF;
// use Michelf\MarkdownExtra;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search  = request()->search;

        return Inertia::render('Invoices/Index', [
            'search'     => request()->search,
            'filter'     => request()->filter,
            'invoices'   => Auth::user()->invoices()
                            ->latest()
                            ->with('project')
                            ->with('client')
                            ->filter(request()->only('search', 'filter'))
                            ->paginate(10)
                            ->transform(function ($invoice) {
                                return [
                                    'id'            => $invoice->id,
                                    'generatedId'   => $invoice->generatedId,
                                    'payment_type'  => $invoice->payment_type,
                                    'is_paid'       => $invoice->is_paid,
                                    'is_sent'       => $invoice->is_sent,
                                    'due'           => $invoice->due,
                                    'grand_total'   => $invoice->grand_total,
                                    'created'       => $invoice->created_at,
                                    'link'          => $invoice->link,
                                    'file_name'          => $invoice->file_name
                                ];
                            }),
            ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return Inertia::render('Invoices/Create', [
                'clients'   => Auth::user()->clients()->get()
                            ->transform(function ($client) {
                                return [
                                    'name'    => $client->first_name . ' ' . $client->last_name,
                                    'id' => $client->id,
                                    'email'   => $client->email,
                                    'gender'  => $client->gender
                                ];
                            }),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
                'num'       => 'required|string',
                'client'    => 'bail|numeric|required',
                'project'   => 'bail|numeric|required',
                'amount'    => 'required|numeric|min:0',
                'discount'  => 'nullable|numeric',
                'grand'     => 'required|numeric|min:0',
                'due'       => 'nullable|date',
                'from_name' => 'string',
                'from_about' => 'required',
                'client_name' => 'string',
                'client_email' => 'required|string',
                'project_name'  => 'required|string',
                'tax'       => 'numeric|min:0',
                'created'   => 'date',
                'delivery'  => 'date'
            ]);


        $file_name = $data['client_name'] . Str::random(10) . '.pdf';

        $details = [
            'title'   => 'Payment Invoice',
            'num'   => $data['num'],
            'from_name'   => $data['from_name'],
            'from_about'   => $data['from_about'],
            'client_name'   => $data['client_name'],
            'client_email'   => $data['client_email'],
            'project_name'   => $data['project_name'],  
            'created'   => $data['created'],
            'delivery'   => $data['delivery'],
            'amount'   => $data['amount'],
            'tax'   => $data['tax'],
            'grand'   => $data['grand']
        ];

        $pdf =  PDF::loadView('pdf/template', $details);
        Storage::put('public/' . $file_name, $pdf->output());

        $link      = env('APP_URL') . '/storage/' . $file_name;

        Auth::user()->invoices()->create(
            array_merge(
                [
                    'generatedId'     => $data['num'],
                    'client_id'       => $data['client'],
                    'project_id'      => $data['project'],
                    'sub_total'       => $data['amount'],
                    'sales_tax'       => $data['tax'],
                    'grand_total'     => $data['grand'],
                    'created_at'      => $data['created'],
                    'delivery'        => $data['delivery'],
                    'link'            => $link,
                    'file_name'       => $file_name
                ],

                $discountArr ?? []
            ));

        Mail::to($data['client_email'])
                ->send( new InvoiceSent($link, $data['client_name']) );


        return response()->json([], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(Invoice $invoice)
    // {
    //      return Inertia::render('Invoices/Show', [
    //             'invoice'   => $invoice,
    //             'project'   => $invoice->project,
    //             'client'    => $invoice->client,
    //             'clients'   => Auth::user()->clients()->get()
    //                         ->transform(function ($client) {
    //                             return [
    //                                 'name'    => $client->first_name . ' ' . $client->last_name,
    //                                 'id' => $client->id
    //                             ];
    //                         }),
    //         ]);
    // }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Invoice $invoice)
    // {   
    //    $data = $request->validate([
    //             'client'    => 'bail|numeric|required',
    //             'project'   => 'bail|numeric|required',
    //             'amount'    => 'required|numeric|min:0',
    //             'discount'  => 'nullable|numeric',
    //             'grand'     => 'required|numeric|min:0',
    //             'due'       => 'nullable|date'
    //         ]);

    //     if($data['discount']){
    //         $discountArr =  ['discount'     => $data['discount']];
    //     }

    //     $invoice->update(
    //         array_merge(
    //             [
    //                 'client_id'       => $data['client'],
    //                 'project_id'      => $data['project'],
    //                 'sub_total'       => $data['amount'],
    //                 'grand_total'     => $data['grand']
    //             ],

    //             $discountArr ?? []
    //         ));

    //     return redirect()->to('invoices/' .$invoice->id)
    //                             ->with('success', 'Client updated.');
    // }

    /**
     * Send Invoice
     */
    // public function send(Invoice $invoice)
    // {   
    //     Mail::to($invoice->client->email)
    //             ->send( new SendInvoice($invoice) );
    //     // return (new \App\Mail\SendInvoice($invoice))->render();
    //     $invoice->update([
    //         'is_sent'  => true
    //     ]);
        
    //     return redirect()->back()->with('success', 'Invoice sent.');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {

        Storage::disk('public')->delete($invoice->file_name);

        $invoice->delete();
        return response()->json([], 204);
    }
}
