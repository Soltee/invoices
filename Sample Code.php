<?php
//This Month
        // $current_mth_paid       =  Auth::user()->invoices()
        //                                 ->whereDate('due', '<=', now())
        //                                 ->where('is_paid', true)
        //                                 ->count();
        // $current_mth_paid_tot   =  Auth::user()->invoices()
        //                                 ->whereDate('due', '<=', now())
        //                                 ->where('is_paid', true)
        //                                 ->sum('grand_total');

        // $current_mth_pend       =  Auth::user()->invoices()
        //                                 ->whereDate('due', '<=', now())
        //                                 ->where('is_paid', false)
        //                                 ->count();
        // $current_mth_pend_tot   =  Auth::user()->invoices()
        //                                 ->whereDate('due', '<=', now())
        //                                 ->where('is_paid', false)
        //                                 ->sum('grand_total');

        // $current_mth_overall    = Auth::user()->invoices()
        //                                 ->whereDate('due', '<=', now())
        //                                 ->count();
        // $current_mth_overall_total  = Auth::user()->invoices()
        //                                 ->whereDate('due', '<=', now())
        //                                 ->sum('grand_total');



        //Overall
        $overall_paid           = Auth::user()->invoices()
                                        ->where('is_paid', true)
                                        ->count();
        $overall_paid_total     = Auth::user()->invoices()
                                        ->where('is_paid', true)
                                        ->sum('grand_total');

        $overall_pending        = Auth::user()->invoices()
                                            ->where('is_paid', false)
                                            ->count();

        $overall_pending_total  = Auth::user()->invoices()
                                        ->where('is_paid', false)
                                        ->sum('grand_total');

        $overall                = Auth::user()->invoices()->count();
        $overall_total          = Auth::user()->invoices()->sum('grand_total');

        //For Chart
        $invoices_data_by_month    = [];

        for ($i=0; $i <= 5; $i++) { 
            array_push($invoices_data_by_month, $this->getDatafromMonth($i));
        }

        // dd($invoices_data_by_month);

        // return Inertia::render('Dashboard/Index', [
        //         'current_mth_paid'            => $current_mth_paid,
        //         'current_mth_paid_tot'        => $current_mth_paid_tot,
        //         'current_mth_pend'            => $current_mth_pend,
        //         'current_mth_pend_tot'        => $current_mth_pend_tot,
        //         'current_mth_overall'         => $current_mth_overall,
        //         'current_mth_overall_total'   => $current_mth_overall_total,

        //         'overall_paid'                => $overall_paid,
        //         'overall_paid_total'          => $overall_paid_total,
        //         'overall_pending'             => $overall_pending,
        //         'overall_pending_total'       => $overall_pending_total,
        //         'overall'                     => $overall,
        //         'overall_total'               => $overall_total,

        //         'invoices_data_by_month'      => $invoices_data_by_month
        //     ]);