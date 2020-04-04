<?php

namespace App\Http\Controllers;

use App\Packaging;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PackagingsController extends Controller
{
    public function index(Packaging $plant){

        $packaging = DB::table('packagings')->where('plant',$plant->plant)->get();
        $plant = $plant->plant;
        return view('packagings.index',compact('packaging','plant'));
    }
 
    public function store(Request $request){
        Packaging::create($request->all());
        return redirect('/packagings/'.$request->plant)->with('status','Packagings Target Added');
    }

    public function destroy(Packaging $packaging)
    {
        Packaging::destroy($packaging->id);
        return redirect('/packagings/'.$packaging->plant)->with('status','Item Deleted');
    }
}
