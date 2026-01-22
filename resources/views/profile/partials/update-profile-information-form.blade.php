<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Información del perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Actualice la información de su perfil.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-10">
        @csrf
        @method('patch')

        <div class="space-y-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                👤 Perfil
            </h3>

            <div>
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                    required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <p class="text-sm mt-2 text-gray-600 dark:text-gray-400">
                        {{ __('Tu correo no está verificado.') }}

                        <button form="send-verification" class="underline hover:text-indigo-500 ml-1">
                            {{ __('Reenviar verificación') }}
                        </button>
                    </p>
                @endif
            </div>
        </div>

        <div class="space-y-6 pt-6 border-t border-white/10">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                🏢 Compañía
            </h3>

            <div>
                <x-input-label for="company_name" :value="__('Nombre de la empresa')" />
                <x-text-input id="company_name" name="company[name]" type="text" class="mt-1 block w-full"
                    :value="old('company.name', $user->company?->name)" required />
                <x-input-error class="mt-2" :messages="$errors->get('company.name')" />
            </div>

            <div>
                <x-input-label for="company_ruc" :value="__('RUC')" />
                <x-text-input id="company_ruc" name="company[ruc]" type="text" class="mt-1 block w-full"
                    :value="old('company.ruc', $user->company?->ruc)" />
                <x-input-error class="mt-2" :messages="$errors->get('company.ruc')" />
            </div>

            <div>
                <x-input-label for="company_address" :value="__('Dirección')" />
                <x-text-input id="company_address" name="company[address]" type="text" class="mt-1 block w-full"
                    :value="old('company.address', $user->company?->address)" />
                <x-input-error class="mt-2" :messages="$errors->get('company.address')" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="company_email" :value="__('Email empresa')" />
                    <x-text-input id="company_email" name="company[email]" type="email" class="mt-1 block w-full"
                        :value="old('company.email', $user->company?->email)" />
                    <x-input-error class="mt-2" :messages="$errors->get('company.email')" />
                </div>

                <div>
                    <x-input-label for="company_phone" :value="__('Teléfono')" />
                    <x-text-input id="company_phone" name="company[phone]" type="text" class="mt-1 block w-full"
                        :value="old('company.phone', $user->company?->phone)" />
                    <x-input-error class="mt-2" :messages="$errors->get('company.phone')" />
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                {{ __('Guardar cambios') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Guardado.') }}
                </p>
            @endif
        </div>
    </form>
</section>
