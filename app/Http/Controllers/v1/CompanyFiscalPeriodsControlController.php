<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CompanyFiscalPeriodsControl;
use App\CompanyFiscalPeriod;
use App\Company;

class CompanyFiscalPeriodsControlController extends Controller
{
    public function index()
    {
    	if(!$this->selected_company())
            return redirect()->route('companies')->with('status',Controller::error_message(5));
    	$company = Company::find(session('selected-company'));
    	$fiscal_periods = $company->fiscal_periods;
    	return view('v1.company-fiscal-periods-control.index')
    		->with('fiscal_periods',$fiscal_periods);
    }

    public function store(Request $request)
    {
        $company = Company::find(session('selected-company'));
        $fiscal_period = CompanyFiscalPeriod::find($request->fiscal_year);
        $fiscal_period->period_date_sequence = $request->period_date_sequence;
        $fiscal_period->save();

        if($fiscal_period->fiscal_periods_controls->count() > 1) {
            $fiscal_period->fiscal_periods_controls()->update(['locked'=>0]);
            if($request->locked) {
                foreach($request->locked as $id) {
                    $fiscal_periods_controls = CompanyFiscalPeriodsControl::find($id);
                    $fiscal_periods_controls->locked = 1;
                    $fiscal_periods_controls->save();
                }
            }
        } else {
            if($fiscal_period->fiscal_periods_controls->count())
                $fiscal_period->fiscal_periods_controls()->delete();
            for($a = $fiscal_period->start_date->format('n'); $a <= $fiscal_period->end_date->format('n'); $a++) {
                $fiscal_periods_control = new CompanyFiscalPeriodsControl;

                $number = cal_days_in_month(CAL_GREGORIAN, $a, $fiscal_period->end_date->format('Y'));

                if($a == $fiscal_period->start_date->format('n')) {
                    $fiscal_periods_control->beginning = $fiscal_period->start_date;
                    $end_dt = date_create($request->first_period_end_date);
                    $fiscal_periods_control->end = $end_dt->format("Y-m-d G:i:s");
                } else {
                    /*
                     *************************************
                     *************************************
                     *************************************
                    */
                    $start_dt = date_create($fiscal_period->end_date->format('Y')."-".$a."-1");
                    $end_dt = date_create($fiscal_period->end_date->format('Y')."-".$a."-".$number);
                    /*
                     *************************************
                     *************************************
                     *************************************
                    */
                    $fiscal_periods_control->beginning = $start_dt->format("Y-m-d G:i:s");
                    $fiscal_periods_control->end = $end_dt->format("Y-m-d G:i:s");
                }

                if($request->locked && in_array($a,$request->locked))
                    $fiscal_periods_control->locked = 1;
                $fiscal_periods_control->sequence = $a;
                $fiscal_period->fiscal_periods_controls()->save($fiscal_periods_control);

                if($fiscal_period->period_date_sequence == 1)
                    $a = $fiscal_period->end_date->format('n');
            }
        }

        return redirect()->route('company-fiscal-periods-controls')->with('status','Saved');
    }

    public function list($fiscal_period_id = null)
    {
        $fiscal_period = CompanyFiscalPeriod::findOrFail($fiscal_period_id);
        return $fiscal_periods_controls = $fiscal_period->fiscal_periods_controls;
    }
}
