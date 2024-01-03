<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;

/**
 * Class Divisi
 * 
 * protected $fillable = ['nama_divisi', 'deskripsi_divisi'];
 * by riyanris, 03 jan 2024
 */

class DivisiController extends Controller
{
    public function index()
    {
        $divisions = Divisi::all();

        return response()->json([
            'message' => trans('division.success_fetch'),
            'data' => $divisions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_divisi' => 'required|max:250',
            'deskripsi_divisi' => 'required',
        ]);

        $division = Divisi::create($request->all());

        return response()->json([
            'message' => trans('division.created'),
            'data' => $division
        ], 201);
    }

    public function show($id)
    {
        $division = Divisi::findOrFail($id);

        return response()->json([
            'message' => trans('division.success_fetch'),
            'data' => $division
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_divisi' => 'required|max:250',
            'deskripsi_divisi' => 'required',
        ]);

        $division = Divisi::findOrFail($id);

        $division->update($request->all());

        return response()->json([
            'message' => trans('division.updated'),
            'data' => $division
        ]);
    }

    public function destroy($id)
    {
        $division = Divisi::findOrFail($id);

        $division->delete();

        return response()->json([
            'message' => trans('division.deleted'),
        ]);
    }
}
