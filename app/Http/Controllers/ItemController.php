<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        return view('index', [
            'items' => Item::latest()->with('user')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'stock' => 'required|integer'
        ]);

        $validateData['slug'] = SlugService::createSlug(Item::class, 'slug', $validateData['name']);
        $validateData['created_by'] = auth()->user()->id;

        Item::create($validateData);
        return redirect(RouteServiceProvider::HOME)->with('success', 'Barang Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'stock' => 'required|integer'
        ]);

        // Mengecek apakah field nama berubah, jika tidak slug tidak akan di regenerate/diubah
        if ($validateData['name'] !== $item->name) {
            $validateData['slug'] = SlugService::createSlug(Item::class, 'slug', $validateData['name']);
        }

        $validateData['updated_at'] = now();

        $item->update($validateData);
        return redirect(RouteServiceProvider::HOME)->with('success', 'Barang berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return back();
    }
}
