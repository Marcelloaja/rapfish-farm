<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index()
    {
        $data_store['data_store'] = DB::select("SELECT * FROM store");

        return view('admin/header', $data_store)
            . view('admin/sidebar', $data_store)
            . view('admin/main_page/store', $data_store)
            . view('admin/footer');
    }

    public function saveDs(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'img_store' => 'required|image|max:2048',
            'title_store' => 'required|string|max:255',
            'desc_store' => 'required|string|max:255',
            'price_store' => 'required|string|max:255',
            'url_store' => 'required|url|max:255',
        ]);

        // Simpan file gambar
        $path = $request->file('img_store')->store('images/store', 'public');

        // Simpan data
        Store::create([
            'IMG_STORE' => $path,
            'TITLE_STORE' => $validatedData['title_store'],
            'DESC_STORE' => $validatedData['desc_store'],
            'PRICE_STORE' => $validatedData['price_store'],
            'URL_STORE' => $validatedData['url_store'],
        ]);

        return redirect()->back()->with('success', 'Item store berhasil ditambahkan.');
    }

    public function editDs(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'id_store' => 'required|integer',
            'img_store' => 'nullable|image|max:2048',
            'title_store' => 'required|string|max:255',
            'desc_store' => 'required|string|max:255',
            'price_store' => 'required|string|max:255',
            'url_store' => 'required|url|max:255',
        ]);

        // Temukan data berdasarkan ID
        $store_item = Store::findOrFail($request->id_store);

        // Update data jika ada file gambar baru
        if ($request->hasFile('img_store')) {
            $path = $request->file('img_store')->store('images/store', 'public');
            $store_item->IMG_STORE = $path;
        }

        $store_item->TITLE_STORE = $validatedData['title_store'];
        $store_item->DESC_STORE = $validatedData['desc_store'];
        $store_item->PRICE_STORE = $validatedData['price_store'];
        $store_item->URL_STORE = $validatedData['url_store'];
        $store_item->save();

        return redirect()->back()->with('success', 'Item store berhasil diperbarui.');
    }

    public function deleteDs($id)
    {
        // Hapus data berdasarkan ID
        $store_item = Store::findOrFail($id);
        $store_item->delete();
        return redirect()->back()->with('success', 'Item store berhasil dihapus.');
    }
}
