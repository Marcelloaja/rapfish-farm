<?php

namespace App\Http\Controllers;

use App\Models\CarouselUtama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarouselUtamaController extends Controller
{
    public function index()
    {
        $data_cu['data_cu'] = DB::select("
        SELECT
            *
        FROM
            carousel_utama
        ");

        return
            view('admin/header', $data_cu) .
            view('admin/sidebar', $data_cu) .
            view('admin/main_page/carousel_utama', $data_cu) .
            view('admin/footer');
    }

    public function saveCu(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'img_cu' => 'required|image|max:2048',
            'title_cu' => 'required|string|max:255',
            'sub_title_cu' => 'required|string|max:255',
            'url_cu' => 'required|url|max:255',
        ]);

        // Simpan file gambar
        $path = $request->file('img_cu')->store('images/carousel', 'public');

        // Simpan data
        CarouselUtama::create([
            'IMG_CU' => $path,
            'TITLE_CU' => $validatedData['title_cu'],
            'SUB_TITLE_CU' => $validatedData['sub_title_cu'],
            'URL_CU' => $validatedData['url_cu'],
        ]);

        return redirect()->back()->with('success', 'Carousel Utama berhasil ditambahkan.');
    }

    public function editCu(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'id_cu' => 'required|integer',
            'img_cu' => 'nullable|image|max:2048',
            'title_cu' => 'required|string|max:255',
            'sub_title_cu' => 'required|string|max:255',
            'url_cu' => 'required|url|max:255',
        ]);

        // Temukan data berdasarkan ID
        $carousel = CarouselUtama::findOrFail($request->id_cu);

        // Update data jika ada file gambar baru
        if ($request->hasFile('img_cu')) {
            $path = $request->file('img_cu')->store('images/carousel', 'public');
            $carousel->IMG_CU = $path;
        }

        $carousel->TITLE_CU = $validatedData['title_cu'];
        $carousel->SUB_TITLE_CU = $validatedData['sub_title_cu'];
        $carousel->URL_CU = $validatedData['url_cu'];
        $carousel->save();

        return redirect()->back()->with('success', 'Carousel Utama berhasil diperbarui.');
    }

    public function deleteCu($id)
    {
        // Hapus data berdasarkan ID
        $carousel = CarouselUtama::findOrFail($id);
        $carousel->delete();
        return redirect()->back()->with('success', 'Carousel Utama berhasil dihapus.');
    }
}
