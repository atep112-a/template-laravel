<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PDF;


class ProductController2 extends Controller
{

    public function cetak_pdf()
    {
        $products = Product::latest()->get(); // It's better to use get() instead of paginate() for PDF generation
        $pdf = PDF::loadView('/products/product_pdf', ['products' => $products]);
        return $pdf->download('laporan-product.pdf');
    }
}
