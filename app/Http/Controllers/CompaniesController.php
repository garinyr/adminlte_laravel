<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\Companies;
use File;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies = companies::all();
        // dd($companies);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $item = $request->all();
        // dd($item);
        $messages = [
            'required' => 'Required',
            'dimensions' => 'max logo 100×100'
        ];

        $this->validate($request, [
            'name' => 'required|string|max:75',
            'email' => 'required|string|max:75',
            'logo' => 'dimensions:max_width>=100,max_height>=100',
            'website' => 'required'
        ], $messages);

        if ($request->hasFile('logo')) {
            //MAKA KITA SIMPAN SEMENTARA FILE TERSEBUT KEDALAM VARIABLE FILE
            $file = $request->file('logo');
            //KEMUDIAN NAMA FILENYA KITA BUAT CUSTOMER DENGAN PERPADUAN TIME DAN SLUG DARI NAMA PRODUK. ADAPUN EXTENSIONNYA KITA GUNAKAN BAWAAN FILE TERSEBUT
            $filename = $request->name . '.' . $file->getClientOriginalExtension();
            //SIMPAN FILENYA KEDALAM FOLDER PUBLIC/PRODUCTS, DAN PARAMETER KEDUA ADALAH NAMA CUSTOM UNTUK FILE TERSEBUT
            $file->storeAs('public/companies', $filename);
            // dd($filename);

            //SETELAH FILE TERSEBUT DISIMPAN, KITA SIMPAN INFORMASI PRODUKNYA KEDALAM DATABASE
            $companies = companies::create([
                'name' => $request->name,
                'email' => $request->email,
                'logo' => $filename, //PASTIKAN MENGGUNAKAN VARIABLE FILENAM YANG HANYA BERISI NAMA FILE SAJA (STRING)
                'website' => $request->website,
            ]);
        }


        return redirect(route('companies.index'))->with(['success' => 'Success!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $companies = companies::where('id', $id)->first();
        return view('companies.show', compact('companies'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $companies = companies::where('id', $id)->first();
        return view('companies.edit', compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $item = $request->all();
        // dd($item);

        if ($request->hasFile('logo')) {
            //MAKA KITA SIMPAN SEMENTARA FILE TERSEBUT KEDALAM VARIABLE FILE
            $file = $request->file('logo');
            //KEMUDIAN NAMA FILENYA KITA BUAT CUSTOMER DENGAN PERPADUAN TIME DAN SLUG DARI NAMA PRODUK. ADAPUN EXTENSIONNYA KITA GUNAKAN BAWAAN FILE TERSEBUT
            $filename = $request->name . '.' . $file->getClientOriginalExtension();
            //SIMPAN FILENYA KEDALAM FOLDER PUBLIC/PRODUCTS, DAN PARAMETER KEDUA ADALAH NAMA CUSTOM UNTUK FILE TERSEBUT
            $file->storeAs('public/companies', $filename);
            // dd($filename);

            $companies = companies::find($id);
            File::delete(storage_path('app/public/companies/' . $companies->logo));

            $companies->update([
                'name' => $request->name,
                'email' => $request->email,
                'logo' => $filename,
                'website' => $request->website
            ]);
        } else {
            $companies = companies::find($id);

            $companies->update([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website
            ]);
        }
        return redirect(route('companies.index'))->with(['update' => 'Updated !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $companies = companies::find($id);
        File::delete(storage_path('app/public/companies/' . $companies->logo));

        $companies->delete();
        return redirect(route('companies.index'))->with(['delete' => 'Deleted !']);
    }
}
