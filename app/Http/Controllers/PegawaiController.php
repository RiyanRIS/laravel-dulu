<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
   

    private $res = array(
        'status' => true,
        'message' => 'Berhasil!',
        'data' => ''
    );

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Pegawai::with('divisi')->get();
        $this->res['data'] = $employees;

        return response()->json($this->res);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        return response()->json($request, 201);
        die();


        $employee = Pegawai::create($request->all());
        $this->res['data'] = $employee;

        return response()->json($this->res, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Pegawai::with('divisi')->findOrFail($id);
        $this->res['data'] = $employee;
        return response()->json($this->res);
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
        $this->res['data'] = $employee;

        return response()->json($this->res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pegawai::destroy($id);
        return response()->json($this->res, 204);
    }
}
