<?php

namespace App\Http\Controllers;

use App\Packaging;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PackagingsController extends Controller
{
    public function index(Packaging $plant){

        $packaging = DB::table('packagings')->where('plant',$plant->plant)->orderBy('id','desc')->get();
        $plant = $plant->plant;
        return view('packagings.index',compact('packaging','plant'));
    }
 
    public function store(Request $request){
        $request->validate([
            'month' => 'unique:packagings,month'
        ]);
        $total = $request->lab+$request->ofc+$request->expenses+$request->other;
        Packaging::create([
            'month' => $request->month,
            'plant' => $request->plant,
            'lab' => $request->lab,
            'ofc' => $request->ofc,
            'expenses' => $request->expenses,
            'packaging' => $request->packaging,
            'lbs' => $request->lbs,
            'other' => $request->other,
            'total' => $total
        ]);
        return redirect('/packagings/'.$request->plant)->with('status','Packagings Target Added');
    }

    public function destroy(Packaging $packaging)
    {
        Packaging::destroy($packaging->id);
        return redirect('/packagings/'.$packaging->plant)->with('status','Item Deleted');
    }

    public function getubah(Request $request)
    {
        $id = $request->input('id');
        $packaging = Packaging::find($id);
        $output = array(
            'month' => $packaging->month,
            'lab' => $packaging->lab,
            'ofc' => $packaging->ofc,
            'expenses' => $packaging->expenses,
            'packaging' => $packaging->packaging,
            'lbs' => $packaging->lbs,
            'other' => $packaging->other
        );
        echo json_encode($output);
    }

    public function update(Request $request, Packaging $packaging)
    {
        $request->validate([
            'lab' => 'required',
            'ofc' => 'required',
            'expenses' => 'required',
            'packaging' => 'required',
            'other' => 'required'
        ]);
        $total = $request->lab+$request->ofc+$request->expenses+$request->other;
        Packaging::where('id',$packaging->id)->update([
            'month' => $request->month,
            'lab' => $request->lab,
            'ofc' => $request->ofc,
            'expenses' => $request->expenses,
            'packaging' => $request->packaging,
            'lbs' => $request->lbs,
            'other' => $request->other,
            'total' => $total
        ]);
        return redirect('/packagings/'.$packaging->plant)->with('status','item updated');
    }
}
