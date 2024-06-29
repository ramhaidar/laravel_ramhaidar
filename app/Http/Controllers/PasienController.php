<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index ()
    {
        $rumahSakits = RumahSakit::all ();
        $pasiens     = Pasien::with ( 'rumahSakit' )->get ();
        return view ( 'pasien.index', compact ( 'pasiens', 'rumahSakits' ) );
    }

    public function store ( Request $request )
    {
        $request->validate ( [ 
            'nama_pasien'    => 'required',
            'alamat'         => 'required',
            'no_telepon'     => 'required',
            'rumah_sakit_id' => 'required|exists:rumah_sakits,id'
        ] );

        $pasien = Pasien::create ( $request->all () );
        return response ()->json ( $pasien );
    }

    public function show ( $id )
    {
        $pasien = Pasien::findOrFail ( $id );
        return response ()->json ( $pasien );
    }

    public function edit ( $id )
    {
        $pasien = Pasien::findOrFail ( $id );
        return response ()->json ( $pasien );
    }

    public function update ( Request $request, $id )
    {
        $request->validate ( [ 
            'nama_pasien'    => 'required',
            'alamat'         => 'required',
            'no_telepon'     => 'required',
            'rumah_sakit_id' => 'required|exists:rumah_sakits,id'
        ] );

        $pasien = Pasien::findOrFail ( $id );
        $pasien->update ( $request->all () );
        return response ()->json ( $pasien );
    }

    public function destroy ( $id )
    {
        $pasien = Pasien::findOrFail ( $id );
        $pasien->delete ();
        return response ()->json ( [ 'success' => 'Pasien deleted successfully' ] );
    }

    public function filter ( $id )
    {
        if ( $id != 'all' )
        {
            $pasiens = Pasien::where ( 'rumah_sakit_id', $id )->with ( 'rumahSakit' )->get ();
        }
        else
        {
            $pasiens = Pasien::with ( 'rumahSakit' )->get ();
        }

        if ( $pasiens->isEmpty () )
        {
            return response ()->json ( [ 'message' => 'No patients found' ], 404 );
        }

        $output = view ( 'pasien.partials.table', compact ( 'pasiens' ) )->render ();
        return response ()->json ( [ 'html' => $output ] );
    }
}
