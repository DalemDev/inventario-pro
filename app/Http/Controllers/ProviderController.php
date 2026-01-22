<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = Provider::latest()->paginate(15);
        return view('providers.index', compact('providers'));
    }

    public function create()
    {
        return view('providers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:providers',
            'phone' => 'required|string',
            'address' => 'required|string'
        ]);

        $data['company_id'] = Auth::user()->company_id;

        Provider::create($data);

        return redirect()
            ->route('providers.index')
            ->with('success', 'Proveedor creado correctamente');
    }

    public function edit(Provider $provider)
    {
        return view('providers.edit', compact('provider'));
    }

    public function update(Request $request, Provider $provider)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:providers,email,' . $provider->id,
            'phone' => 'required|string',
            'address' => 'required|string'
        ]);

        $provider->update($data);

        return back()->with('success', 'Proveedor actualizado');
    }
}
