<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $res = array(
        'status' => true,
        'message' => 'Berhasil!',
        'data' => ''
    );

    public function index()
    {
        $divisions = Divisi::all();
        $this->res['data'] = $divisions;

        return response()->json($this->res);
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
        $division = Divisi::create($request->all());
        $this->res['data'] = $division;

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
        $division = Divisi::findOrFail($id);
        $this->res['data'] = $division;
        return response()->json($this->res);
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
        $division = Divisi::findOrFail($id);
        $division->update($request->all());
        $this->res['data'] = $division;
        $this->res['message'] = "Berhasil mengubah data.";

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
        Divisi::destroy($id);
        return response()->json($this->res, 204);
    }
}
