<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function landing_page()
    {
        $data_cu = DB::table('carousel_utama')->select(
            'IMG_CU',
            'TITLE_CU',
            'SUB_TITLE_CU',
            'URL_CU'
        )->get();

        $data_store = DB::table('store')->select(
            'IMG_STORE',
            'TITLE_STORE',
            'DESC_STORE',
            'PRICE_STORE',
            'URL_STORE'
        )->get();

        // Send both data sets to the view
        return view('page_user', compact('data_cu', 'data_store'));
    }

    public function dashboard_admin()
    {

        $totalProduct = DB::table('store')->count();
        $totalCarouselUtama = DB::table('carousel_utama')->count();

        return 
            view('admin/header') .
            view('admin/sidebar') .
            view('admin/main_page/dashboard', [
                'totalProduct' => $totalProduct,
                'totalCarouselUtama' => $totalCarouselUtama
                ]) .
            view('admin/footer');
    }
}
