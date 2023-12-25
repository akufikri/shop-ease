<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\TypeProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $type = TypeProduk::all();
        return view("backend.page.produk.index", compact("kategori", "type"));
    }
    public function get()
    {
        $data = Produk::with('kategori', 'type')->get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '<button class="btn btn-sm btn-primary">Edit</button> <button class="btn btn-sm btn-danger">Delete</button>';
            })
            ->addColumn('photo produk', function ($data) {
                return asset('ImageProduk/' . $data->photo_produk);
            })
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'produk_name' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'photo_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'expired' => 'nullable|date|after:tomorrow',
            'type_id' => [
                'required',
                Rule::exists('type_produks', 'id')->where(function ($query) use ($request) {
                    return true;
                }),
            ],
            'custom_field' => [
                'required_if:type_id,1',
                'string',
                'max:255',
            ],
            'related_field' => 'required_with:custom_field|numeric',
        ]);

        $produk = new Produk();
        $produk->produk_name = $request->produk_name;
        $produk->kategori_id = $request->kategori_id;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;

        // Handle file upload for photo_produk
        if ($request->hasFile('photo_produk')) {
            $file = $request->file('photo_produk');
            $filename = uniqid('produk_') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('ImageProduk/'), $filename);

            $produk->photo_produk = $filename;
        }

        $produk->expired = $request->expired;
        $produk->type_id = $request->type_id;
        $produk->save();

        return response()->json([
            'message' => 'Successfully created new product'
        ]);
    }
    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Hapus file gambar terkait
        $imagePath = public_path('ImageProduk/') . $produk->photo_produk;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Hapus record produk dari database
        $produk->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
    public function edit($id)
    {
        $produk = Produk::with('kategori', 'type')->find($id);

        if (!$produk) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json(['produk' => $produk]);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'produk_name' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'photo_produk' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'expired' => 'nullable|date|after:tomorrow',
            'type_id' => [
                'required',
                Rule::exists('type_produks', 'id')->where(function ($query) use ($request) {
                    return true;
                }),
            ],
            'custom_field' => [
                'required_if:type_id,1',
                'string',
                'max:255',
            ],
            'related_field' => 'required_with:custom_field|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Proses pembaruan data
        $produk->update($request->all());

        // Handle file upload for photo_produk
        if ($request->hasFile('photo_produk')) {
            $file = $request->file('photo_produk');
            $filename = uniqid('produk_') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('ImageProduk/'), $filename);

            // Hapus file gambar lama jika ada
            if ($produk->photo_produk) {
                $oldImagePath = public_path('ImageProduk/') . $produk->photo_produk;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $produk->photo_produk = $filename;
        }

        $produk->save();

        return response()->json(['message' => 'Product updated successfully']);
    }
}
