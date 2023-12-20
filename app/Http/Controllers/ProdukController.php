<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\TypeProduk;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

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
                return asset('ImgProduk/' . $data->photo_produk);
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
            'expired' => 'required|date|after:tomorrow',
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
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload_path'), $fileName);
            $produk->photo_produk = $fileName;
        }

        $produk->expired = $request->expired;
        $produk->type_id = $request->type_id;
        $produk->save();

        return response()->json([
            'message' => 'Successfully created new produk'
        ]);
    }
}
