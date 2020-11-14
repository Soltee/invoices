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
use Carbon\Carbon;

class DashboardController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //Invoices
        //Sent , NOt Sent & Total
        $current_mth_invoice_sent       =  Auth::user()->invoices()
                                        ->whereMonth('created_at',  Carbon::now())
                                        ->where('is_sent', true)
                                        ->count();

        $current_mth_invoice_sent_tot   =  Auth::user()->invoices()
                                        ->whereMonth('created_at',  Carbon::now())
                                        ->where('is_sent', true)
                                        ->sum('grand_total');

        $current_mth_invoice_pend       =  Auth::user()->invoices()
                                        ->whereMonth('created_at',  Carbon::now())
                                        ->where('is_sent', false)
                                        ->count();

        $current_mth_invoice_pend_tot   =  Auth::user()->invoices()
                                        ->whereMonth('created_at',  Carbon::now())
                                        ->where('is_sent', false)
                                        ->sum('grand_total');

        $current_mth_invoice_overall    = Auth::user()->invoices()
                                        ->whereMonth('created_at',  Carbon::now())
                                        ->count();
        $current_mth_invoice_overall_total  = Auth::user()->invoices()
                                                ->whereMonth('created_at',  Carbon::now())
                                                ->sum('grand_total');

        //Projects
        $current_mth_project_completed      = Auth::user()->projects()
                                                ->whereMonth('created_at',  Carbon::now())
                                                ->where('is_completed', true)
                                                ->count();

        $current_mth_project_incomplete     = Auth::user()->projects()
                                                ->whereMonth('created_at',  Carbon::now())
                                                ->where('is_completed', false)
                                                ->count();

        $current_mth_project_total          = Auth::user()->projects()
                                                ->whereMonth('created_at',  Carbon::now())
                                                ->count();


        //Overall
        $overall_sent           = Auth::user()->invoices()
                                        ->where('is_sent', true)
                                        ->count();
        $overall_sent_total     = Auth::user()->invoices()
                                        ->where('is_sent', true)
                                        ->sum('grand_total');

        $overall_pending        = Auth::user()->invoices()
                                            ->where('is_sent', false)
                                            ->count();

        $overall_pending_total  = Auth::user()->invoices()
                                        ->where('is_sent', false)
                                        ->sum('grand_total');

        $overall                = Auth::user()->invoices()->count();
        $overall_total          = Auth::user()->invoices()->sum('grand_total');

        //For Chart
        $invoices_sent_data        = [];
        $invoices_not_send_data    = [];
        $months                    = [];

        for ($i=0; $i <= 5; $i++) { 
            array_push($invoices_sent_data, $this->getDatafromMonth($i, 'is_sent', 1));
            array_push($invoices_not_send_data, $this->getDatafromMonth($i, 'is_sent', 0));

            array_push($months, $this->getMonths($i));
        }
        // dd($months);

        // dd([
        //     $invoices_sent_data,
        //     $invoices_not_send_data
        // ]);

        return Inertia::render('Dashboard/Index', [
                'current_mth_invoice_sent'            => $current_mth_invoice_sent,
                'current_mth_invoice_sent_tot'        => $current_mth_invoice_sent_tot,
                'current_mth_invoice_pend'            => $current_mth_invoice_pend,
                'current_mth_invoice_pend_tot'        => $current_mth_invoice_pend_tot,
                'current_mth_invoice_overall'         => $current_mth_invoice_overall,
                'current_mth_invoice_overall_total'   => $current_mth_invoice_overall_total,

                'overall_sent'                => $overall_sent,
                'overall_sent_total'          => $overall_sent_total,
                'overall_pending'             => $overall_pending,
                'overall_pending_total'       => $overall_pending_total,
                'overall'                     => $overall,
                'overall_total'               => $overall_total,

                'invoices_data_by_month'      => [
                                                    array_reverse($invoices_sent_data),
                                                    array_reverse($invoices_not_send_data),
                                                    array_reverse($months)
                                                ]
            ]);
    }


    //Get Data from Data
    protected function getDatafromMonth($mth, string $type, bool $value)
    {
        return 
            Auth::user()->invoices()
                            ->where(''. $type .'', $value) 
                            ->whereMonth('created_at', Carbon::now()->subMonths($mth))
                            ->count();
    }

    //Get Month
    protected function getMonths($mth){
        return Carbon::now()->subMonth($mth)->format('F');
    }
    
    //Get Paid based on Month Helper
    protected function getPaidDatafromMonth($mth)
    {
        return [
                
                'total'   =>  Auth::user()->invoices()
                            ->where('is_paid', true) 
                            ->whereMonth('due', '<=', Carbon::now()->subMonths($mth))
                            ->count(),
                'month'   => Carbon::now()->subMonth($mth)->format('F')
            ];
    }
}
