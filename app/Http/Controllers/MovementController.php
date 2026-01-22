<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Provider;
use App\Services\MovementService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovementController extends Controller
{
    public function index(Product $product)
    {
        $product = Product::withCurrentStock()->findOrFail($product->id);
        $providers = Provider::get();

        $movements = $product->movements()
            ->latest()
            ->paginate(15);

        return view('movements.index', compact('product', 'movements', 'providers'));
    }

    public function store(Request $request, Product $product, MovementService $service)
    {
        $request->validate([
            'type' => 'required|in:entrada,salida,ajuste',
            'quantity' => 'required|integer|min:0',
            'reason' => 'nullable|string|max:255',
        ]);

        $product = Product::withCurrentStock()->findOrFail($product->id);

        $service->move(
            $product,
            $request->provider_id,
            $request->type,
            $request->quantity,
            $request->reason
        );

        return back()->with('success', 'Movimiento registrado');
    }
}
