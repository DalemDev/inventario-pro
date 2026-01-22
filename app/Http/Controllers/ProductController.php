<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withCurrentStock()->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::get();
        $providers = Provider::get();
        return view('products.create', compact('categories', 'providers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|unique:products,sku',
            'description' => 'nullable|string',
            'minimum_stock' => 'required|integer|min:0',
            'category_id' => 'required|integer',
            'providers' => 'nullable|array',
            'default_provider' => 'nullable|integer',
        ]);

        $product = null;

        DB::transaction(function () use (&$product, $data) {
            $data['company_id'] = Auth::user()->company_id;
            $product = Product::create($data);

            foreach ($data['providers'] as $providerID => $dataProvider) {
                if (!isset($dataProvider['selected'])) continue;

                $product->providers()->attach($providerID, [
                    'company_id' => Auth::user()->company_id,
                    'cost' => $dataProvider['cost'],
                    'is_default' => $providerID == $data['default_provider']
                ]);
            }
        });

        return redirect()
            ->route('products.movements.index', $product)
            ->with('success', 'Producto creado. Registra el stock inicial.');
    }

    public function show(Product $product)
    {
        $product = Product::withCurrentStock()->with(['category', 'providers'])->findOrFail($product->id);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product = Product::withCurrentStock()->with(['providers'])->findOrFail($product->id);
        $categories = Category::get();
        $providers = Provider::get();
        return view('products.edit', compact('product', 'categories', 'providers'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'description' => 'nullable|string',
            'minimum_stock' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($request, $product) {
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'sku' => $request->sku,
                'minimum_stock' => $request->minimum_stock,
            ]);
        });

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Product $product)
    {
        DB::transaction(function () use ($product) {
            $product->delete();
        });

        return redirect()
            ->route('products.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}
