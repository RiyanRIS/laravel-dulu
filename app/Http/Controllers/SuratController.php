<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use Illuminate\Validation\Rule;

class SuratController extends Controller
{
    private $res = [
        'status' => true,
        'message' => 'Berhasil!',
        'data' => '',
    ];

    public function index()
    {
        $surat = Surat::with(['pengirim', 'penerima'])->get();
        $surat->file_url = $surat->getFileUrl();

        $this->res['data'] = $surat;

        return response()->json($this->res);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string',
            'tanggal_kirim' => 'required|date',
            'perihal' => 'required|string',
            'id_pengirim' => [
                'required',
                Rule::exists('pegawai', 'id')->whereNull('deleted_at'),
            ],
            'id_penerima' => [
                'required',
                Rule::exists('pegawai', 'id')->whereNull('deleted_at'),
            ],
            'status' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $surat = Surat::create($request->except('file'));

        if ($request->hasFile('file')) {
            $surat->saveFile($request->file('file'));
        }

        $this->res['data'] = $surat;

        return response()->json($this->res, 201);
    }

    public function show($id)
    {
        $surat = Surat::with(['pengirim', 'penerima'])->findOrFail($id);

        $this->res['data'] = $surat;

        return response()->json($this->res);
    }

    public function update(Request $request, $id)
    {
        print_r($request->all()); die();
        
        $request->validate([
            'nomor_surat' => 'required|string',
            'tanggal_kirim' => 'required|date',
            'perihal' => 'required|string',
            'id_pengirim' => [
                'required',
                Rule::exists('pegawai', 'id')->whereNull('deleted_at'),
            ],
            'id_penerima' => [
                'required',
                Rule::exists('pegawai', 'id')->whereNull('deleted_at'),
            ],
            'status' => 'required|string',
            'file' => 'file|mimes:pdf,doc,docx',
        ]);


        $surat = Surat::findOrFail($id);
        $surat->update($request->except('file'));

        if ($request->hasFile('file')) {
            $surat->updateFile($surat, $request);
        }

        $this->res['data'] = $surat;

        return response()->json($this->res);
    }


    public function destroy($id)
    {
        Surat::destroy($id);

        return response()->json($this->res, 204);
    }
}
