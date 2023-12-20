<?php

namespace App\Http\Controllers;

use App\Models\TypeProduk;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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

        $data = TypeProduk::create([
            'name' => $request->input('name'),
            'logo' => null,
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = uniqid('logo_') . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('LogoType/'), $filename);

            $data->logo = $filename;
            $data->save();
        }

        return response()->json([
            'message' => 'sukses',
            'status' => 200
        ]);
    }

    public function getData()
    {
        $data = TypeProduk::all();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '<button class="btn btn-sm btn-primary">Edit</button> <button class="btn btn-sm btn-danger">Delete</button>';
            })
            ->addColumn('logo', function ($data) {
                return asset('LogoType/' . $data->logo);
            })
            ->make(true);
    }
    public function showData($id)
    {
        $data = TypeProduk::find($id);
        return response()->json($data);
    }

    public function deleteData($id)
    {
        $typeProduk = TypeProduk::find($id);

        if ($typeProduk) {
            // Delete the associated logo file
            if ($typeProduk->logo) {
                $logoPath = public_path('LogoType/') . $typeProduk->logo;
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }

            $typeProduk->delete();

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'edit_name' => 'required',
            'edit_logo' => 'image|mimes:png,jpg|max:2048' // Adjust max file size as needed
        ]);

        $type =  TypeProduk::find($id);

        if (!$type) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        $type->name = $request->input('edit_name');

        if ($request->hasFile('edit_logo')) {
            $logo = $request->file('edit_logo');
            $filename = uniqid('logo_') . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('LogoType/'), $filename);

            // Delete old logo file if it exists
            if ($type->logo) {
                unlink(public_path('LogoType/') . $type->logo);
            }

            $type->logo = $filename;
        }

        $type->save();

        return response()->json([
            'message' => 'Record updated successfully.',
            'status' => 200
        ]);
    }
}
