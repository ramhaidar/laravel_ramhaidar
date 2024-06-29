<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    public function index ()
    {
        $rumahSakits = RumahSakit::all ();
        return view ( 'rumah_sakit.index', compact ( 'rumahSakits' ) );
    }

    public function store ( Request $request )
    {
        $request->validate ( [ 
            'nama_rumah_sakit' => 'required',
            'alamat'           => 'required',
            'email'            => 'required|email',
            'telepon'          => 'required'
        ] );

        $rumahSakit = RumahSakit::create ( $request->all () );
        return response ()->json ( $rumahSakit );
    }

    public function show ( $id )
    {
        $rumahSakit = RumahSakit::findOrFail ( $id );
        return response ()->json ( $rumahSakit );
    }

    public function edit ( $id )
    {
        $rumahSakit = RumahSakit::findOrFail ( $id );
        return response ()->json ( $rumahSakit );
    }

    public function update ( Request $request, $id )
    {
        $request->validate ( [ 
            'nama_rumah_sakit' => 'required',
            'alamat'           => 'required',
            'email'            => 'required|email',
            'telepon'          => 'required'
        ] );

        $rumahSakit = RumahSakit::findOrFail ( $id );
        $rumahSakit->update ( $request->all () );
        return response ()->json ( $rumahSakit );
    }

    public function destroy ( $id )
    {
        // Hapus data pasien terkait
        Pasien::where ( 'rumah_sakit_id', $id )->delete ();

        // Hapus data rumah sakit
        $rumahSakit = RumahSakit::findOrFail ( $id );
        $rumahSakit->delete ();
        return response ()->json ( [ 'success' => 'Rumah Sakit deleted successfully' ] );
    }
}
