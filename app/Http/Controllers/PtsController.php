<?php

namespace App\Http\Controllers;

use App\Pt;
use App\fg;
use App\Mac;
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


    // bagian item/PTs
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
            'loin' => $pt->loin
        );
        echo json_encode($output);
    }

    public function update(Request $request,Pt $pt)
    {    
        $request->validate([
            'lbs' => 'required',
        ]);
        
        $calculate = ($request->a108591+$request->a108592+$request->a108593
                +$request->a107290+$request->a107289+$request->a107288+$request->a107287
                +$request->a107294+$request->a107293+$request->a107292
                +$request->a107992+$request->a107993+$request->a107994);
                
        if ($calculate > 0){
            $mac = $calculate/(count($request->all())-3);
            $packaging = 0.30;
            $ofc = 0.21;
            $yield = 0.95;
            
            $data = DB::table('pts')
            ->select(DB::raw('(price_lbs*'.$request->lbs.')-((('.$mac.'/'.$yield.')+processing_fee+'.$ofc.'+'.$packaging.')*'.$request->lbs.') as result'))
            ->where('id', '=', $pt->id)
            ->first();

            Pt::where('id',$pt->id)->update([
                    'lbs' => $request->lbs,
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
