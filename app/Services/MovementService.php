<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Movement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class MovementService
{
    public function move(Product $product, int $provider_id, string $type, int $quantity, ?string $reason = null)
    {
        return DB::transaction(function () use ($product, $type, $quantity, $reason, $provider_id) {

            $stockBefore = $product->current_stock ?: 0;
            $stockAfter = $stockBefore;

            if ($type === 'entrada') {
                $stockAfter += $quantity;
            }

            if ($type === 'salida') {
                if ($quantity > $stockBefore) {
                    throw new Exception('Stock insuficiente');
                }
                $stockAfter -= $quantity;
            }

            if ($type === 'ajuste') {
                $stockAfter = $quantity;
            }

            Movement::create([
                'company_id'    => Auth::user()->company_id,
                'product_id'    => $product->id,
                'provider_id'   => $provider_id,
                'user_id'       => Auth::id(),
                'type'          => $type,
                'quantity'      => $quantity,
                'stock_before'  => $stockBefore,
                'stock_after'   => $stockAfter,
                'reason'        => $reason,
            ]);

            return $stockAfter;
        });
    }
}
