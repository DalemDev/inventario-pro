<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\Provider;
use App\Models\User;
use App\Models\Movement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialSeed extends Seeder
{
    public function run(): void
    {
        $company = Company::create([
            'name' => 'Dalemberg Company',
            'ruc' => '1234567890001',
            'address' => 'Av. Principal 123, Quito',
            'email' => 'empresa@dalemberg.com',
            'phone' => '0999999999',
        ]);

        $admin = User::create([
            'name' => 'Dalemberg García',
            'email' => 'dalemberismael7@gmail.com',
            'password' => Hash::make('12345678'),
            'company_id' => $company->id,
            'role' => 'admin',
        ]);

        $categories = collect([
            'Electrónica',
            'Alimentos',
            'Ropa',
            'Oficina',
            'Limpieza',
        ])->map(
            fn($name) =>
            Category::create([
                'company_id' => $company->id,
                'name' => $name
            ])
        );

        $providers = collect([
            [
                'name' => 'Distribuidora Andina',
                'email' => 'ventas@andina.com',
            ],
            [
                'name' => 'Comercial El Ahorro',
                'email' => 'contacto@elahorro.com',
            ],
            [
                'name' => 'Importadora Global',
                'email' => 'info@global.com',
            ],
        ])->map(
            fn($provider) =>
            Provider::create([
                'company_id' => $company->id,
                ...$provider,
            ])
        );

        $products = [
            [
                'name' => 'Laptop Lenovo ThinkPad',
                'sku' => 'LAP-001',
                'minimum_stock' => 5,
            ],
            [
                'name' => 'Mouse inalámbrico',
                'sku' => 'ACC-002',
                'minimum_stock' => 20,
            ],
            [
                'name' => 'Papel A4 Resma',
                'sku' => 'OFI-003',
                'minimum_stock' => 50,
            ],
            [
                'name' => 'Detergente líquido',
                'sku' => 'LIM-004',
                'minimum_stock' => 30,
            ],
        ];

        foreach ($products as $index => $data) {
            $product = Product::create([
                'company_id' => $company->id,
                'category_id' => $categories[$index % $categories->count()]->id,
                'description' => 'Producto de prueba para el sistema',
                ...$data,
            ]);

            $selectedProviders = $providers->random(rand(1, 2))->values();

            $pivotData = [];
            $defaultProviderId = $selectedProviders->first()->id;

            foreach ($selectedProviders as $provider) {
                $pivotData[$provider->id] = [
                    'company_id' => $company->id,
                    'cost' => rand(5, 200),
                    'is_default' => $provider->id === $defaultProviderId,
                ];
            }

            $product->providers()->attach($pivotData);

            $quantity = rand(10, 100);

            Movement::create([
                'company_id' => $company->id,
                'product_id' => $product->id,
                'provider_id' => $defaultProviderId,
                'user_id' => $admin->id,
                'type' => 'entrada',
                'quantity' => $quantity,
                'stock_before' => 0,
                'stock_after' => $quantity,
                'reason' => 'Stock inicial',
            ]);
        }
    }
}
