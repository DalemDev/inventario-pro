<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    const DEFAULT_COMPANY_TYPE_ID = 1;
    const DEFAULT_LEGAL_TYPE_ID = 1;
    const DEFAULT_ACTIVE_STATUS_ID = 1;
    const DEFAULT_IDENTIFICATION_TYPE_ID = 1;

    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'company' => ['required', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($request) {
            $company = Company::create([
                'name' => mb_strtolower($request->company, 'UTF-8'),
                'trade_name' => mb_strtolower($request->company, 'UTF-8'),
                'company_type_id' => self::DEFAULT_COMPANY_TYPE_ID,
                'legal_type_id' => self::DEFAULT_LEGAL_TYPE_ID,
                'legal_code' => '00000000000000',
                'email' => 'prueba2@gmail.com',
                'phone' => '0000000000',
                'status_id' => self::DEFAULT_ACTIVE_STATUS_ID,
            ]);

            $user = User::create([
                'company_id' => $company->id,
                'name' => mb_strtolower($request->name, 'UTF-8'),
                'password' => Hash::make($request->password),
                'first_name' => '',
                'last_name' => '',
                'identification_type_id' => self::DEFAULT_IDENTIFICATION_TYPE_ID,
                'identification_number' => '0000000000',
                'email' => $request->email,
                'last_login_at' => now(),
                'status_id' => self::DEFAULT_ACTIVE_STATUS_ID,
                'created_by' => self::DEFAULT_ACTIVE_STATUS_ID,
            ]);

            event(new Registered($user));

            Auth::login($user);
        });

        return redirect()->route('dashboard');
    }
}
