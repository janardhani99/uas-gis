<?php

namespace App\Http\Controllers;
use DB;
use App\Covid;
use App\Kabupaten;
// use Carbon\Carbon as Carbon;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $tanggalSekarang = CARBON::now()->locale('id')->isoFormat('LL');
        $dateNow = Carbon::now()->format('Y-m-d');
        $covids = Covid::select('tb_input.id_input','tb_kabupaten.id_kabupaten','kabupaten','positif','rawat','sembuh','meninggal')
                ->join('tb_kabupaten','tb_input.id_kabupaten','=','tb_kabupaten.id_kabupaten')
                ->where('tanggal', $dateNow)->orderBy('positif','desc')
                ->get();
                $positif = Covid::select(DB::raw('COALESCE(SUM(positif),0) as positif'))->where('tanggal',$dateNow)->get();
                $rawat = Covid::select(DB::raw('COALESCE(SUM(rawat),0) as rawat'))->where('tanggal',$dateNow)->get();
                $sembuh = Covid::select(DB::raw('COALESCE(SUM(sembuh),0) as sembuh'))->where('tanggal',$dateNow)->get();
                $meninggal = Covid::select(DB::raw('COALESCE(SUM(meninggal),0) as meninggal'))->where('tanggal',$dateNow)->get();
                
                
        $kabupaten = Kabupaten::all();
        $labels = Kabupaten::select('kabupaten')->get();
        
        return view('index',compact('kabupaten','covids', 'tanggalSekarang','positif','rawat','sembuh','meninggal'));
        
    }

    public function search(Request $request)
    {
    	$tanggal = $request->tanggal;
        $tanggalSekarang = Carbon::parse($request->tanggal)->format('d F Y');
        $cekData = Covid::select('kabupaten','tb_kabupaten.id_kabupaten', 'positif','rawat','sembuh','meninggal','tanggal')
            ->rightjoin('tb_kabupaten','tb_input.id_kabupaten','=','tb_kabupaten.id_kabupaten')
            ->where('tanggal',$request->tanggal)
            ->orderBy('id_kabupaten','ASC')
            ->get();
        if (count($cekData) == 0) {
            $covids = Kabupaten::select('kabupaten', DB::raw('IFNULL("0",0) as positif'), DB::raw('IFNULL("0",0) as rawat'),DB::raw('IFNULL("0",0) as sembuh', DB::raw('IFNULL("0",0) as meninggal')))->get();
        }else{
            $covids = $cekData;
        }
        $positif = Covid::select(DB::raw('COALESCE(SUM(positif),0) as positif'))->where('tanggal',$request->tanggal)->get();
        $rawat = Covid::select(DB::raw('COALESCE(SUM(rawat),0) as rawat'))->where('tanggal',$request->tanggal)->get();
        $sembuh = Covid::select(DB::raw('COALESCE(SUM(sembuh),0) as sembuh'))->where('tanggal',$request->tanggal)->get();
        $meninggal = Covid::select(DB::raw('COALESCE(SUM(meninggal),0) as meninggal'))->where('tanggal',$request->tanggal)->get();
        
        return view('index',compact("covids", "positif", "rawat", "sembuh", "meninggal", "tanggalSekarang","tanggal"));

    }

    public function getData(Request $request)
    {
    	$dateNow = Carbon::now()->format('Y-m-d');
        if (is_null($request->date)) {
            $tanggal = $dateNow;
        }else{
            $tanggal = $request->date;
        }

        $covids = Covid::select('tb_input.id_input','tb_kabupaten.id_kabupaten','kabupaten', 'positif', 'rawat','sembuh', 'meninggal')
                ->rightjoin('tb_kabupaten','tb_input.id_kabupaten','=','tb_kabupaten.id_kabupaten')
                ->where('tanggal',$tanggal)
                ->orderBy('id_kabupaten','ASC')
                ->get();

        return $covids;

    }

    public function getPositif(Request $request)
    {
    	$dateNow = Carbon::now()->format('Y-m-d');
        if (is_null($request->date)) {
            $tanggal = $dateNow;
        }else{
            $tanggal = $request->date;
        }

        $pos = Covid::select('tb_input.id_input','tb_kabupaten.id_kabupaten','kabupaten', 'positif', 'rawat','sembuh','meninggal')
                ->rightjoin('tb_kabupaten','tb_input.id_kabupaten','=','tb_kabupaten.id_kabupaten')
                ->where('tanggal',$tanggal)
                ->orderBy('positif','DESC')
                ->get();
        return $pos;
    }

    public function createPallete(Request $request)
    {
    	$HexFrom = ltrim($request->start, '#');
        $HexTo = ltrim($request->end, '#');

    
        $ColorSteps = 9;
        $FromRGB['r'] = hexdec(substr($HexFrom, 0, 2));
        $FromRGB['g'] = hexdec(substr($HexFrom, 2, 2));
        $FromRGB['b'] = hexdec(substr($HexFrom, 4, 2));
    
        $ToRGB['r'] = hexdec(substr($HexTo, 0, 2));
        $ToRGB['g'] = hexdec(substr($HexTo, 2, 2));
        $ToRGB['b'] = hexdec(substr($HexTo, 4, 2));
    
        $StepRGB['r'] = ($FromRGB['r'] - $ToRGB['r']) / ($ColorSteps - 1);
        $StepRGB['g'] = ($FromRGB['g'] - $ToRGB['g']) / ($ColorSteps - 1);
        $StepRGB['b'] = ($FromRGB['b'] - $ToRGB['b']) / ($ColorSteps - 1);
    
        $GradientColors = array();
    
        for($i = 0; $i <= $ColorSteps; $i++) {
        $RGB['r'] = floor($FromRGB['r'] - ($StepRGB['r'] * $i));
        $RGB['g'] = floor($FromRGB['g'] - ($StepRGB['g'] * $i));
        $RGB['b'] = floor($FromRGB['b'] - ($StepRGB['b'] * $i));
    
        $HexRGB['r'] = sprintf('%02x', ($RGB['r']));
        $HexRGB['g'] = sprintf('%02x', ($RGB['g']));
        $HexRGB['b'] = sprintf('%02x', ($RGB['b']));
    
        $GradientColors[] = implode(NULL, $HexRGB);
        }
        $collect = collect($GradientColors);
        $filtered = $collect->filter(function($value, $key){
            return strlen($value) == 6;
        });
        return $filtered;
    }

    function len($val){
        return (strlen($val) == 6 ? true : false );
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
