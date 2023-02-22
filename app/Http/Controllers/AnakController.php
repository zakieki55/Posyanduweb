<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnakController extends Controller
{
    //
    public function index(Request $request)
    {
        $data_anak = Anak::query();

        if ($request->has('cari')) {
            $data_anak = $data_anak->where('nama', 'LIKE', '%' . $request->cari . '%');
        }
        
        if ($request->has('kelurahan')) {
            $data_anak = $data_anak->where('kelurahan', $request->kelurahan);
        }

        if ($request->has('kecamatan')) {
            $data_anak = $data_anak->where('kecamatan', $request->kecamatan);
        }

        if ($request->has('pedusunan')) {
            $data_anak = $data_anak->where('pedusunan', $request->pedusunan);
        }

        $data_anak = $data_anak->paginate(5);

        if ($request->user()->role == User::ROLE_ADMIN) {
            return view('anak.index', ['data_anak' => $data_anak]);
        } elseif ($request->user()->role == User::ROLE_SUPERUSER) {
            return view('anak.superuser', ['data_anak' => $data_anak]);
        } else {
            return view('anak.user', ['data_anak' => $data_anak]);
        }
    }

    public function create(Request $request)
    {

        $data_anak = \App\Models\Anak::all();
        foreach ($data_anak as $datanyaanak);
        \App\Models\Anak::create($request->all());
        $datanyaanak->ket = '';


        return redirect('/anak')->with('Sukses', 'Data berhasil di input!');
    }

    public function edit($id)
    {
        $data_anak = \App\Models\Anak::find($id);
        return view('anak.edit', ['anak' => $data_anak]);
    }

    public function update(Request $request, $id)
    {
        $data_anak = \App\Models\Anak::find($id);
        $data_anak->update($request->all());
        return redirect('anak')->with('sukses', 'Data berhasil diupdate');
    }
    public function delete($id)
    {
        $data_anak = \App\Models\Anak::find($id);
        $data_anak->delete();
        return redirect('anak')->with('Sukses', 'Data berhasil dihapus');
    }

    public function cari(Request $request)
    {
        $cari = $request->cari;
        $data_anak = DB::table('anak')
            ->where('nik', 'like', "%" . $cari . "%")
            ->paginate();

        return view('anak.index', ['data_anak' => $data_anak]);
    }
}
