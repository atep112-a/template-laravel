<?php

namespace App\Http\Controllers;

//import model dosen
use App\Models\Dosen;

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\Request;

//import Http Request
use Illuminate\Http\RedirectResponse;

//import Facades Storage
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use PDF;

class DosenController extends Controller
{

     /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all dosens
        $dosens = Dosen::latest()->paginate(10);

        //render view with dosens
        return view('dosens.index', compact('dosens'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('dosens.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'nama'         => 'required',
            'alamat'   => 'required',
            'mata_kuliah'         => 'required',
            'no_telp'         => 'required'
        ]);


        //create dosen
        Dosen::create([
            'nama'         => $request->nama,
            'alamat'   => $request->alamat,
            'mata_kuliah'         => $request->mata_kuliah,
            'no_telp'         => $request->no_telp
        ]);

        //redirect to index
        return redirect()->route('dosens.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get dosen by ID
        $dosen = Dosen::findOrFail($id);

        //render view with dosen
        return view('dosens.show', compact('dosen'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get dosen by ID
        $dosen = Dosen::findOrFail($id);

        //render view with dosen
        return view('dosens.edit', compact('dosen'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nama'         => 'required',
            'alamat'   => 'required',
            'mata_kuliah'         => 'required',
            'no_telp'         => 'required'
        ]);

        //get dosen by ID
        $dosen = Dosen::findOrFail($id);


            $dosen->update([
                'nama'         => $request->nama,
                'alamat'   => $request->alamat,
                'mata_kuliah'         => $request->mata_kuliah,
                'no_telp'         => $request->no_telp
            ]);




        //redirect to index
        return redirect()->route('dosens.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get dosen by ID
        $dosen = Dosen::findOrFail($id);

        //delete image
        Storage::delete('public/dosens/'. $dosen->image);

        //delete dosen
        $dosen->delete();

        //redirect to index
        return redirect()->route('dosens.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


    public function cetak_pdf()
    {
        $dosens = Dosen::latest()->get(); // It's better to use get() instead of paginate() for PDF generation
        $pdf = PDF::loadView('/dosens/dosen_pdf', ['dosens' => $dosens]);
        return $pdf->download('laporan-user-dosen.pdf');
    }
}
