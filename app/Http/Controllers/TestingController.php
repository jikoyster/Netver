<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestAcct;
use Illuminate\Support\Facades\DB;

class TestingController extends Controller
{
	public function testing(){
		return view("test-view");
	}
	public function store(Request $request)
	{
		if($request->description && $request->date) {
			$test = new TestAcct;
			$test->description = $request->description;
			$test->date = $request->date;
			//$test->debit = number_format(floatval(str_replace(',', '', $request->debit)),5);
			//$test->credit = number_format(floatval(str_replace(',', '', $request->credit)),5);
			$test->amount = number_format(floatval(str_replace(',', '', $request->debit)) - floatval(str_replace(',', '', $request->credit)),5);
			$test->save();
			return $test;
		}
	}
	public function update(Request $request)
	{
		if($request->id) {
			$test = TestAcct::findOrFail($request->id);
			$test->description = $request->description;
			$test->date = $request->date;
			//$test->debit = number_format(floatval(str_replace(',', '', $request->debit)),5);
			//$test->credit = number_format(floatval(str_replace(',', '', $request->credit)),5);
			$test->amount = number_format(floatval(str_replace(',', '', $request->debit)) - floatval(str_replace(',', '', $request->credit)),5);
			$test->save();
			$test['total_debit'] = DB::table('test_accts')->where('amount','>=',0)->sum(DB::raw('replace(amount,",","")'));
			$test['total_credit'] = abs(DB::table('test_accts')->where('amount','<',0)->sum(DB::raw('replace(amount,",","")')));
			return $test;
		} else {
			return [];
		}
	}

    public function test_accts(Request $request)
    {
    	return TestAcct::all();
    }

    public function destroy(Request $request)
    {
    	$test = TestAcct::findOrFail($request->id);
    	$test->delete();
    }

    public function post()
    {
    	DB::table('test_accts')->truncate();
    	return redirect()->route('testing');
    }
}
