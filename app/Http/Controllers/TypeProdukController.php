<?php

namespace App\Http\Controllers;

use App\Models\TypeProduk;
use Illuminate\Http\Request;

class TypeProdukController extends Controller
{
    public function index()
    {
        return view("backend.page.type.index");
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'image|mimes:png,jpg|max:2048'
        ]);

        $kategori = TypeProduk::create([
            'name' => $request->input('name'),
            'logo' => null,
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = uniqid('logo_') . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('LogoType/'), $filename);

            $kategori->logo = $filename;
            $kategori->save();
        }

        return response()->json([
            'message' => 'sukses',
            'status' => 200
        ]);
    }
    public function getData()
    {
        $data = TypeProduk::all();
        return response()->json($data);
    }
}
