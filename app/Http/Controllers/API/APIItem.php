<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;

class APIItem extends Controller
{
    public function getAllItems()
    {
        return response()->json([
            'success' => true,
            'message' => "Item berhasil didapatkan semua!",
            'data' => Item::all()
        ], 200);
    }

    public function insert(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'stock' => 'required|numeric|min:1|bail',
            'price' => 'required|numeric|min:1000|bail',
            'image' => 'required|mimes:jpeg,jpg,png|max:5120'
        ], [
            'name.required' => ':attribute tidak boleh kosong!',
            'brand.required' => ':attribute tidak boleh kosong!',
            'stock.required' => ':attribute tidak boleh kosong!',
            'stock.numeric' => ':attribute harus berupa angka!',
            'stock.min' => ':attribute minimal 1!',
            'price.required' => ':attribute tidak boleh kosong!',
            'price.numeric' => ':attribute harus berupa angka!',
            'price.min' => ':attribute minimal Rp 1.000!',
            'image.required' => 'Gambar tidak boleh kosong!',
            'image.mimes' => 'Tipe :attribute harus bertipekan jpeg, jpg, atau png!',
            'image.max' => 'Ukuran :attribute tidak boleh besar dari 5 MB!',
        ], [
            'name' => 'Nama barang',
            'brand' => 'Brand',
            'stock' => 'Stok',
            'price' => 'Harga',
            'image' => 'gambar'
        ]);

        $new_image = time() . " - " . $fields['image']->getClientOriginalName();
        $fields['image']->move('src/kasir/store/img/', $new_image);

        $item = Item::create([
            'item_name' => $fields['name'],
            'item_brand' => ucwords(strtolower($fields['brand'])),
            'item_price' => $fields['price'],
            'item_stock' => $fields['stock'],
            'item_image_name' => $new_image
        ]);

        alert()->success('Yayyy!!', $item["item_name"] . ' berhasil ditambahkan!');
        return redirect()->route("master_item");
    }

    public function update(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'stock' => 'required|numeric|min:1|bail',
            'price' => 'required|numeric|min:1000|bail',
            'image' => 'mimes:jpeg,jpg,png|max:5120'
        ], [
            'name.required' => ':attribute tidak boleh kosong!',
            'brand.required' => ':attribute tidak boleh kosong!',
            'stock.required' => ':attribute tidak boleh kosong!',
            'stock.numeric' => ':attribute harus berupa angka!',
            'stock.min' => ':attribute minimal 1!',
            'price.required' => ':attribute tidak boleh kosong!',
            'price.numeric' => ':attribute harus berupa angka!',
            'price.min' => ':attribute minimal Rp 1.000!',
            'image.mimes' => 'Tipe :attribute harus bertipekan jpeg, jpg, atau png!',
            'image.max' => 'Ukuran :attribute tidak boleh besar dari 5 MB!',
        ], [
            'name' => 'Nama barang',
            'brand' => 'Brand',
            'stock' => 'Stok',
            'price' => 'Harga',
            'image' => 'gambar'
        ]);

        $item = Item::where("item_id", $request->item_id)->first();

        if($request->has('image')){
            File::delete("src/kasir/store/img/$item->image");

            $new_image = time() . " - " . $fields['image']->getClientOriginalName();
            $fields['image']->move('src/kasir/store/img/', $new_image);

            $item->item_name = $fields['name'];
            $item->item_brand = $fields['brand'];
            $item->item_price = $fields['price'];
            $item->item_stock = $fields['stock'];
            $item->item_image_name = $new_image;
        } else {
            $item->item_name = $fields['name'];
            $item->item_brand = $fields['brand'];
            $item->item_price = $fields['price'];
            $item->item_stock = $fields['stock'];
        }

        $item->save();
        alert()->success('Yayyy!!', $item["item_name"] . ' berhasil diupdate!');
        return redirect()->route('master_item')->with('success');
    }

    public function delete(Request $request)
    {
        $item = Item::where("item_id", $request->item_id)->first();
        $item->deleted_at = Carbon::now();
        $item->save();

        alert()->success('Yayyy!!', $item["item_name"] . ' berhasil dihapus!');
        return redirect()->back();
    }

    public function restore(Request $request)
    {
        $item = Item::withTrashed()->where("item_id", $request->item_id)->first();
        $item->deleted_at = null;
        $item->save();

        alert()->success('Yayyy!!', $item["item_name"] . ' berhasil direstore!');
        return redirect()->back();
    }
}
