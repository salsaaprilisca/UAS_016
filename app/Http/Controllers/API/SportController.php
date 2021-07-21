<?php

namespace App\Http\Controllers\API;
use App\Sport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sport::with('pelatih')->get();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $data
        ],200);
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
        $validasi = Validator::make($request->all(),[
            "name"          => "required",
            "umur"    => "required|integer",
            "alamat"    => "required",
            "cabang_olahraga" => "required",
            "tinggi"    => "required|integer",
            "coach_id"       => "required|integer"
        ]);

        if ($validasi -> passes()){
            $data = Sport::create($request->all());
            return response()-> json([
                'pesan' => 'Data Berhasil Ditambahkan',
                'data' => $data
            ], 200);
        }

        return response()->json([
            'pesan' => 'Data Gagal Disimpan',
            'data' => $validasi->errors()->all()
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Sport::where('id', $id)->with('pelatih')->first();
        if (empty($data)){
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 404);
        }
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $data
        ], 200);
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
        $data = Sport::where('id',$id)->first();

        if (empty($data)){
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 404);
        } else {
            $validasi = Validator::make($request->all(),[
                "name"          => "required",
                "umur"    => "required|integer",
                "alamat"    => "required",
                "cabang_olahraga" => "required",
                "tinggi"    => "required|integer",
                "coach_id"       => "required|integer"
            ]);

            if ($validasi->passes()){
                $data->update($request->all());
                return response()->json([
                    'pesan' => 'Data Berhasil Diupdate',
                    'data' => $data
                ], 200);
            }else{
                return response()->json([
                    'pesan' => 'Data Gagal Diupdate',
                    'data' => $validasi->errors()->all()
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Sport::where('id',$id)->first();
        if (empty($data)){
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 404);
        }

        $data->delete();
        return response()->json([
            'pesan' => 'Data Berhasil Dihapus',
            'data' => $data
        ], 200);
    
    }
}
