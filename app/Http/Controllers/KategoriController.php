<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Kategori';
        $kategori = new Kategori();
        $kode = $kategori->kodeKategori();

        $data = Kategori::all();

        return view('pages.kategori.index', compact('title', 'kode', 'data'));
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
        $this->validate($request, [
            'nama_kategori' => 'required'
        ]);

        try {

            DB::table('kategori')->insert([
                'nama_kategori' => $request->nama_kategori,
                'kode_kategori' => $request->kode_kategori
            ]);
            return back()->with('success', 'Kategori Berhasil ditambahkan..!');
        } catch (\Throwable $th) {
            return back()->with('success', 'Kategori Berhasil ditambahkan..!');
        }
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
        $kategori = Kategori::find($id);

        return response()->json([
            'data' => $kategori,
            'message' => 'success'
        ], 200);
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
        $data =  Kategori::where('id', $id)->first();
        $data->delete();

        return redirect()->back();
    }
}
