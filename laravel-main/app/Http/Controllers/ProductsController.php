<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Manufacturers;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\AbstractList;

class CompetitorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Products::all();
        $manufacturers = Manufacturers::all();
        return view('product.index', ['product' => $products, 'manufacturers' => $manufacturers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'manufacturer' => 'required|max:255',
            'price' => 'required|integer|min:0',
            'production_date' => 'required|max:255',
        ]);

        if ($validated) {
            $products = Products::create(
                $request->all(['title', 'manufacturer', 'price', 'production_date', 'products_id'])
            );
        }

        return view(
            'products.store',
            ['products' => $products]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $products = Products::find($id);
        if (!isset($products))
        {
            return abort(404);
        }
        return view('products.show', ['products' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $products = products::find($id);
        if (!isset($products))
        {
            return abort(404);
        }
        return view(
            'competitor.edit',
            ['products' => $products]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): View
    {
        $products = Products::find($id);
        if (!isset($products))
        {
            return abort(404);
        }
        $products = Products::find($id);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'manufacturer' => 'required|max:50',
            'price' => 'required|integer|min:0',
            'production_date' => 'required|max:255',
        ]);
        if ($validated) {
            $products->title = $request->input('title');
            $products->manufacturer = $request->input('manufacturer');
            $products->price = $request->input('price');
            $products->production_date = $request->input('production_date');
            $products->products_id = $request->input('products_id');
            $products->save();
        }

        return view('products.update', ['products' => $products]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): View
    {
        $products = Products::find($id);
        if (!isset($products))
        {
            return abort(404);
        }
        $products->delete();
        return view(
            'products.destroy',
            ['products' => $products]
        );
    }
}
