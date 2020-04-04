<?php

namespace App\Http\Controllers;

use App\Mac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MacsController extends Controller
{
    public function index(Mac $plant){
        $macs = DB::table('macs')->where('plant',$plant->plant)->orderBy('id','desc')->get();
        $plant = $plant->plant;
        return view('macs.index',compact('macs','plant'));
    }

    public function destroy(Mac $mac)
    {
        Mac::destroy($mac->id);
        return redirect('/macs/'.$mac->plant)->with('status','Item Deleted');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sap_code' => 'required',
            'material_desc' => 'required',
            'plant' => 'required',
            'mac' => 'required'
        ]);
        //cara ke-3
        Mac::create($request->all());
        return redirect('/macs/'.$request->plant)->with('status','New Item Added');
    }

    public function getubah(Request $request)
    {
        $id = $request->input('id');
        $fg = Mac::find($id);
        $output = array(
            'sap_code' => $fg->sap_code,
            'material_desc' => $fg->material_desc,
            'plant' => $fg->plant,
            'mac' => $fg->mac
        );
        echo json_encode($output);
    }

    public function update(Request $request,Mac $mac)
    {
        $request->validate([
            'sap_code' => 'required',
            'material_desc' => 'required',
            'plant' => 'required',
            'mac' => 'required',
        ]);
        Mac::where('id',$mac->id)->update([
                'sap_code' => $request->sap_code,
                'material_desc' => $request->material_desc,
                'plant' => $request->plant,
                'mac' => $request->mac,
        ]);
        return redirect('/macs/'.$mac->plant)->with('status','Item Updated');
    }
}
