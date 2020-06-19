<?php

namespace App\Http\Controllers;

use DB;
use App\Covid;
use App\Kabupaten;
use App\Kecamatan;
use App\Kelurahan;
use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;
class CovidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $covids = Covid::select('tb_input.id_input','tb_kabupaten.id_kabupaten','tb_kecamatan.id_kecamatan','tb_kelurahan.id_kelurahan','kabupaten','kecamatan','kelurahan','positif','rawat','sembuh','meninggal','ppln','ppdn','tl','lainnya','level')
                ->join('tb_kelurahan','tb_input.id_kelurahan','=','tb_kelurahan.id_kelurahan')
                ->join('tb_kecamatan','tb_kelurahan.id_kecamatan','=','tb_kecamatan.id_kecamatan')
                ->join('tb_kabupaten','tb_kecamatan.id_kabupaten','=','tb_kabupaten.id_kabupaten')
                ->get();
        $test = Covid::select('tb_input.id_input','tb_kabupaten.id_kabupaten','tb_kecamatan.id_kecamatan','tb_kelurahan.id_kelurahan','kabupaten','kecamatan','kelurahan','positif','rawat','sembuh','meninggal','ppln','ppdn','tl','lainnya','level')
                ->join('tb_kelurahan','tb_input.id_kelurahan','=','tb_kelurahan.id_kelurahan')
                ->join('tb_kecamatan','tb_kelurahan.id_kecamatan','=','tb_kecamatan.id_kecamatan')
                ->join('tb_kabupaten','tb_kecamatan.id_kabupaten','=','tb_kabupaten.id_kabupaten')
                ->where('tanggal', Covid::max('tanggal'))->orderBy('tanggal','desc')
                ->get();
        $positif = Covid::where('tanggal', Covid::max('tanggal'))->orderBy('tanggal','desc')
                ->sum('positif');
        $rawat = Covid::where('tanggal', Covid::max('tanggal'))->orderBy('tanggal','desc')
                ->sum('rawat');
        $sembuh = Covid::where('tanggal', Covid::max('tanggal'))->orderBy('tanggal','desc')
                ->sum('sembuh');
        $meninggal = Covid::where('tanggal', Covid::max('tanggal'))->orderBy('tanggal','desc')
                ->sum('meninggal');
        $level = Covid::where('tanggal', Covid::max('tanggal'))->orderBy('tanggal','desc')
                ->sum('level');
        $ppln = Covid::where('tanggal', Covid::max('tanggal'))->orderBy('tanggal','desc')
                ->sum('ppln');
        $ppdn = Covid::where('tanggal', Covid::max('tanggal'))->orderBy('tanggal','desc')
                ->sum('ppdn');
        $tl = Covid::where('tanggal', Covid::max('tanggal'))->orderBy('tanggal','desc')
                ->sum('tl');
        $lainnya = Covid::where('tanggal', Covid::max('tanggal'))->orderBy('tanggal','desc')
                ->sum('lainnya');
        
        
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        $date   = \Carbon\Carbon::now()->format('d F Y');
        return view('create',compact('kabupaten', 'kecamatan', 'kelurahan', 'covids','test','positif','rawat','sembuh','meninggal','level','ppln','ppdn','tl','lainnya','date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kabupaten = $request->kabupaten;
        $kecamatan = $request->kecamatan;
        $kelurahan = $request->kelurahan;
        $level = $request->level;
        $ppln = $request->ppln;
        $ppdn = $request->ppdn;
        $tl = $request->tl;
        $lainnya = $request->lainnya;
        $tanggal = $request->tanggal;
        $rawat = $request->rawat;
        $sembuh = $request->sembuh;
        $meninggal = $request->meninggal;

        $positif = $rawat + $sembuh + $meninggal;
        
        $covids = array(
        'Kelurahan' => $kelurahan,
        'Tanggal' => $tanggal
        );

        $count = DB::table('tb_input')->where('id_kelurahan', $kelurahan)
                                ->where('tanggal',  $tanggal)
                                ->count();
        if($count > 0){
            return redirect()->back();
        }else{
            $covids = new Covid;
            $covids->tanggal= $request->tanggal;
            // $covids->id_kabupaten= $request->kabupaten;
            // $covids->id_kecamatan= $request->kecamatan;
            $covids->id_kelurahan= $request->kelurahan;
            $covids->level= $request->level;
            $covids->ppln= $request->ppln;
            $covids->ppdn= $request->ppdn;
            $covids->tl= $request->tl;
            $covids->lainnya= $request->lainnya;
            $covids->positif= $positif;
            $covids->rawat= $request->rawat;
            $covids->sembuh = $request->sembuh;
            $covids->meninggal= $request->meninggal;

            $covids->save();
        }

        session()->flash('msg', 'Successfully done!.');
        return redirect('/covid-19');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Covid  $covid
     * @return \Illuminate\Http\Response
     */
    public function show($covids)
    {
        //
        $covids = Covid::select('tb_input.id_input','tb_kabupaten.id_kabupaten','tb_kecamatan.id_kecamatan','tb_kelurahan.id_kelurahan','kabupaten','kecamatan','kelurahan','positif','rawat','sembuh','meninggal','ppln','ppdn','tl','lainnya','level')
                ->join('tb_kelurahan','tb_input.id_kelurahan','=','tb_kelurahan.id_kelurahan')
                ->join('tb_kecamatan','tb_kelurahan.id_kecamatan','=','tb_kecamatan.id_kecamatan')
                ->join('tb_kabupaten','tb_kecamatan.id_kabupaten','=','tb_kabupaten.id_kabupaten')
                ->where('tb_input.id_kelurahan','=',$covids)
                ->get();
        
        return view('list',compact('covids'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Covid  $covid
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $covid = Covid::where('id_input',$id);
    //     $kabupatens = Kabupaten::get();
    //     // return $covid;
    //     return view("edit", compact("covid", "kabupatens"));
    //     // return $covid['1']['id_input'];
    // }
    public function edit($id)
    {
        $covids = Covid::find($id);
        // $kabupaten = Kabupaten::get();
        // $kecamatan = Kecamatan::get();
        $kelurahan = Kelurahan::get();
        // return view("edit", compact("covids", "kabupaten", "kecamatan", "kelurahan"));
        return view("edit", compact("covids", "kelurahan"));
        // return $covid;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Covid  $covid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $covids = Covid::find($id);
        $rawat= $request->rawat;
        $sembuh= $request->sembuh;
        $meninggal= $request->meninggal;
        $positif = $rawat+$sembuh+$meninggal;
        $ppln= $request->ppln;
        $ppdn= $request->ppdn;
        $tl= $request->tl;
        $lainnya = $request->lainnya;
        $level = $request->level;

        $covids->ppln = $request->$ppln;
        $covids->ppdn = $request->$ppdn;
        $covids->tl = $request->$tl;
        $covids->lainnya = $request->$lainnya;
        $covids->level = $request->$level;
        $covids->positif = $request->$positif;
        $covids->rawat = $request->rawat;
        $covids->sembuh = $request->sembuh;
        $covids->meninggal = $request->meninggal;
        
        $covids->save();

        return redirect("/covid-19");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Covid  $covid
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $covids = Covid::find($id);
        $covids->delete();
        return redirect("/covid-19")->with('alert-success','Data berhasil dihapus!');
    }
}
