<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        return view("backend.page.kategori.index");
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'image|mimes:png,jpg|max:2048' // Adjust max file size as needed
        ]);

        $kategori = Kategori::create([
            'name' => $request->input('name'),
            'logo' => null, // Default value in case no logo is uploaded
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = uniqid('logo_') . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('LogoKategori/'), $filename);

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
        $kategori = Kategori::all();

        return DataTables::of($kategori)
            ->addColumn('action', function ($kategori) {
                return '<button class="btn btn-sm btn-primary">Edit</button> <button class="btn btn-sm btn-danger">Delete</button>';
            })
            ->addColumn('logo', function ($kategori) {
                return asset('LogoKategori/' . $kategori->logo);
            })
            ->make(true);
    }
    public function deleteData($id)
    {
        $kategori = Kategori::find($id);

        if ($kategori) {
            $kategori->delete();
            return response()->json([
                'message' => 'Record deleted successfully.',
                'status' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Record not found.',
                'status' => 404
            ], 404);
        }
    }
    public function showData($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        return response()->json($kategori);
    }
    // ...

    public function update(Request $request, $id)
    {
        $request->validate([
            'edit_name' => 'required',
            'edit_logo' => 'image|mimes:png,jpg|max:2048' // Adjust max file size as needed
        ]);

        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        $kategori->name = $request->input('edit_name');

        if ($request->hasFile('edit_logo')) {
            $logo = $request->file('edit_logo');
            $filename = uniqid('logo_') . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('LogoKategori/'), $filename);

            // Delete old logo file if it exists
            if ($kategori->logo) {
                unlink(public_path('LogoKategori/') . $kategori->logo);
            }

            $kategori->logo = $filename;
        }

        $kategori->save();

        return response()->json([
            'message' => 'Record updated successfully.',
            'status' => 200
        ]);
    }
}
