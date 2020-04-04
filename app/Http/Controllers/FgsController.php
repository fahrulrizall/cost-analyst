<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Fg;
use SebastianBergmann\Environment\Console;

class FgsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function index(Fg $plant)
   {
       $fgs = DB::table('fgs')->where('plant',$plant->plant)->orderBy('id','desc')->get();
       $plant = $plant->plant;
       return view('fgs.index',compact('fgs','plant'));
   }

   public function store(Request $request)
    {
        $request->validate([
            'sap_code' => 'required',
            'material_desc' => 'required',
            'plant' => 'required',
            'price_lbs' => 'required',
            'lbs' => 'required',
            'std_price' => 'required',
            'processing_fee' => 'required',
            'category' => 'required'
        ]);
        //cara ke-3
        Fg::create($request->all());
        return redirect('/fgs/'.$request->plant)->with('status','New Item Added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */

    public function destroy(Fg $fg)
    {
        Fg::destroy($fg->id);
        return redirect('/fgs/'.$fg->plant)->with('status','Item Deleted');
    }

    public function getubah(Request $request)
    {
        $id = $request->input('id');
        $fg = Fg::find($id);
        $output = array(
            'sap_code' => $fg->sap_code,
            'material_desc' => $fg->material_desc,
            'plant' => $fg->plant,
            'price_lbs' => $fg->price_lbs,
            'lbs' => $fg->lbs,
            'std_price' => $fg->std_price,
            'processing_fee' => $fg->processing_fee,
            'category' => $fg->category
        );
        echo json_encode($output);
    }

    public function update(Request $request,Fg $fg)
    {
        $request->validate([
            'sap_code' => 'required',
            'material_desc' => 'required',
            'plant' => 'required',
            'price_lbs' => 'required',
            'lbs' => 'required',
            'std_price' => 'required',
            'processing_fee' => 'required',
            'category' => 'required'
        ]);
        Fg::where('id',$fg->id)->update([
                'sap_code' => $request->sap_code,
                'material_desc' => $request->material_desc,
                'plant' => $request->plant,
                'price_lbs' => $request->price_lbs,
                'lbs' => $request->lbs,
                'std_price' => $request->std_price,
                'processing_fee' => $request->processing_fee,
                'category' => $request->category
        ]);
        return redirect('/fgs/'.$fg->plant)->with('status','Item Updated');
    }
}
