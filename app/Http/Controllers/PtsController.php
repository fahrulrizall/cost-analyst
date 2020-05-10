<?php

namespace App\Http\Controllers;

use App\Pt;
use App\fg;
use App\Mac;
use App\Packaging;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class PtsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Pt $plant)
    {
        $pts = DB::table('pts')->distinct()->where('plant',$plant->plant)->get(['pt_name','plant']);
        $plant = $plant->plant;
        return view('pts.index',compact('pts','plant'));
    }

    public function store(Request $request)
    {
        //dd ($request);
        $request->validate([
            'pt_name' => 'unique:pts,pt_name',
            'validatept' => 'required|unique:pts,validate'
        ]);
        Pt::create([
            'pt_name' => $request->pt_name,
            'validate' => $request->validatept,
            'plant' => $request->plant
        ]);
        return redirect('/pts/'.$request->plant)->with('status','Productions Target Added');
    }

    public function show($plant,$pt)
    {
        $pts = DB::table('pts')->where([['pt_name',$pt->pt_name],['plant',$plant->plant]])->whereNotNull('sap_code')->get();
        $pt= $pt->pt_name;
        $sum = Pt::where([['pt_name', $pt],['plant',$plant->plant]])->sum('result');
        $fgs = DB::table('fgs')->where('plant',$plant->plant)->orderBy('id','desc')->get();
        $loin = DB::table('macs')->where('plant',$plant->plant)->get();
        $planttitle= $plant->plant;
        return view('pts.show',compact('pts','pt','fgs','sum','planttitle','loin'));
    }

    public function destroy(Pt $pt)
    {
        Pt::where('pt_name', $pt->pt_name)->delete();
        return redirect('/pts/'.$pt->plant)->with('status','Productions Target Deleted');
    }

    public function add(Request $request)
    {
        $request->validate([
            'validate' => 'unique:pts,validate'
        ]);
        Pt::create($request->all());
        return redirect('/pts/'.$request->plant.'/edit/'.$request->pt_name)->with('status','item Added');
    }

    public function destroyitem(Pt $pt)
    {
        Pt::destroy($pt->id);
        return redirect('/pts/'.$pt->plant.'/edit/'.$pt->pt_name)->with('status','Item Deleted');
    }

    public function getubah(Request $request)
    {
        $id = $request->input('id');
        $pt = Pt::find($id);
        $output = array(
            'lbs' => $pt->lbs,
            'loin' => explode(",",$pt->loin)
        );
        echo json_encode($output);
    }

    public function update(Request $request,Pt $pt,Packaging $packaging)
    {   
        $request->validate([
            'lbs' => 'required',
        ]);
                
        if ($request->sap_code > 0){
            $summac = DB::table('macs')->whereIn('sap_code',$request->sap_code)->get()->sum('mac');
            $mac = $summac/count($request->sap_code);
            $loin = implode(",",$request->sap_code);
            $totalpackaging = DB::table('packagings')->where('plant',$pt->plant)->latest()->take(3)->get()->sum('packaging');
            $total = DB::table('packagings')->where('plant',$pt->plant)->latest()->take(3)->get()->sum('total');
            $totallbs = DB::table('packagings')->where('plant',$pt->plant)->latest()->take(3)->get()->sum('lbs');
            $packaging = $totalpackaging/$totallbs;
            $ofc =  $total/$totallbs;

            $yield = 0.95;

            $data = DB::table('pts')
            ->select(DB::raw('(price_lbs*'.$request->lbs.')-((('.$mac.'/'.$yield.')+processing_fee+'.$ofc.'+'.$packaging.')*'.$request->lbs.') as result'))
            ->where('id', '=', $pt->id)
            ->first();

            Pt::where('id',$pt->id)->update([
                    'lbs' => $request->lbs,
                    'loin' => $loin,
                    'mac' => $mac,
                    'result' => $data->result
            ]);
        }else {
            Pt::where('id',$pt->id)->update([
                    'lbs' => $request->lbs,
            ]);
        }
        return redirect('/pts/'.$pt->plant.'/edit/'.$pt->pt_name)->with('status','Item Updated');
    }
}
