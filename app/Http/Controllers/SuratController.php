<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use Illuminate\Validation\Rule;

class SuratController extends Controller
{
    public function index()
    {
        $surat = Surat::with(['pengirim', 'penerima'])->get();

        return response()->json([
            'message' => trans('surat.success_fetch'),
            'data' => $surat
        ]);
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

        return response()->json([
            'message' => trans('surat.created'),
            'data' => $surat
        ], 201);
    }

    public function show($id)
    {
        $surat = Surat::with(['pengirim', 'penerima'])->findOrFail($id);

        return response()->json([
            'message' => trans('surat.success_fetched'),
            'data' => $surat
        ]);
    }

    public function update(Request $request, $id)
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
            'file' => 'file|mimes:pdf,doc,docx',
        ]);


        $surat = Surat::findOrFail($id);
        $surat->update($request->except('file'));

        if ($request->hasFile('file')) {
            $surat->updateFile($surat, $request);
        }

        return response()->json([
            'message' => trans('surat.updated'),
            'data' => $surat
        ]);
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);

        $surat->deleteFile($surat);
        $surat->delete();

        return response()->json([
            'message' => trans('surat.deleted'),
            'data' => $surat
        ]);
    }
}
