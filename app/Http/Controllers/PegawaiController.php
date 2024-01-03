<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Validation\Rule;

/**
 * Class Pegawai
 * 
 * protected $fillable = ['nama_pegawai', 'jabatan', 'id_divisi'];
 * by riyanris, 03 jan 2024
 */
class PegawaiController extends Controller
{
    public function index()
    {
        $employees = Pegawai::with('divisi')->get();

        return response()->json([
            'message' => trans('employee.success_fetch'),
            'data' => $employees
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required|string',
            'jabatan' => 'required|string',
            'id_divisi' => [
                'required',
                Rule::exists('divisi', 'id')->whereNull('deleted_at')
            ]
        ]);

        $employee = Pegawai::create($request->all());

        return response()->json([
            'message' => trans('employee.created'),
            'data' => $employee
        ]);
    }

    public function show($id)
    {
        $employee = Pegawai::with('divisi')->findOrFail($id);
        return response()->json([
            'message' => trans('employee.success_fetch'),
            'data' => $employee
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pegawai' => 'required|string',
            'jabatan' => 'required|string',
            'id_divisi' => [
                'required',
                Rule::exists('divisi', 'id')->whereNull('deleted_at')
            ]
        ]);

        $employee = Pegawai::findOrFail($id);
        $employee->update($request->all());

        return response()->json([
            'message' => trans('employee.updated'),
            'data' => $employee
        ]);
    }

    public function destroy($id)
    {
        $division = Pegawai::findOrFail($id);

        $division->delete();
        
        return response()->json([
            'message' => trans('employee.deleted'),
        ]);
    }
}
