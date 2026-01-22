<a href="/" class="flex flex-col items-center gap-1">
    <span class="text-2xl font-semibold tracking-tight text-white">
        Inventario<span class="text-indigo-400">Pro</span>
    </span>

    @if (request()->is('login') || request()->is('register'))
        <span class="text-xs text-gray-400">
            Control inteligente
        </span>
    @endif
</a>
