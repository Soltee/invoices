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
            'invoices'   => Auth::user()->invoices()
                            ->with('project')
                            ->with('client')
                            ->filter(request()->only('search'))
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
                                    // 'projects'      => $invoice->projects_count,
                                    // 'clients'       => $invoice->clients_count,
                                    'created'       => $invoice->created_at
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
                                    'id' => $client->id
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
                'client'    => 'bail|numeric|required',
                'project'   => 'bail|numeric|required',
                'amount'    => 'required|numeric|min:0',
                'discount'  => 'nullable|numeric',
                'grand'     => 'required|numeric|min:0',
                'due'       => 'required|date'
            ]);

        if($data['discount']){
            $discountArr =  ['discount'     => $data['discount']];
        }

        Auth::user()->invoices()->create(
            array_merge(
                [
                    'generatedId'     => Str::random(20),
                    'client_id'       => $data['client'],
                    'project_id'      => $data['project'],
                    'sub_total'       => $data['amount'],
                    'grand_total'     => $data['grand'],
                    'due'             => $data['due']
                ],

                $discountArr ?? []
            ));

        return redirect()->route('invoice.create')->with('success', 'Client added to the list.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
