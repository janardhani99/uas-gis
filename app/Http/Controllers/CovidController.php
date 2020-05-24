<?php

namespace App\Http\Controllers;

use DB;
use App\Covid;
use App\Kabupaten;
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
        $covids = Covid::select('tb_input.id_input','tb_kabupaten.id_kabupaten', 'kabupaten', 'positif', 'rawat','sembuh','meninggal')
                ->join('tb_kabupaten','tb_input.id_kabupaten','=','tb_kabupaten.id_kabupaten')
                ->get();
        $test = Covid::select('tb_input.id_input','tb_kabupaten.id_kabupaten','kabupaten', 'positif','rawat','sembuh','meninggal')
                ->join('tb_kabupaten','tb_input.id_kabupaten','=','tb_kabupaten.id_kabupaten')
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
        
        $kabupaten = Kabupaten::all();
        $date   = \Carbon\Carbon::now()->format('d F Y');
        return view('create',compact('kabupaten','covids','test','positif','rawat','sembuh','meninggal','date'));
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
        $tanggal = $request->tanggal;
        $rawat = $request->rawat;
        $sembuh = $request->sembuh;
        $meninggal = $request->meninggal;

        $positif = $rawat + $sembuh + $meninggal;
        
        $covids = array(
        'Kabupaten' => $kabupaten,
        'Tanggal' => $tanggal
        );

        $count = DB::table('tb_input')->where('id_kabupaten', $kabupaten)
                                ->where('tanggal',  $tanggal)
                                ->count();
        if($count > 0){
            return redirect()->back();
        }else{
            $covids = new Covid;
            $covids->tanggal= $request->tanggal;
            $covids->id_kabupaten= $request->kabupaten;
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
        $covids = Covid::select('tb_input.id_input','kabupaten','tanggal','positif','rawat','sembuh','meninggal')
                ->join('tb_kabupaten','tb_input.id_kabupaten','=','tb_kabupaten.id_kabupaten')
                ->where('tb_input.id_kabupaten','=',$covids)
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
        $kabupaten = Kabupaten::get();
        return view("edit", compact("covids", "kabupaten"));
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


        $covids->positif = $positif;
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
