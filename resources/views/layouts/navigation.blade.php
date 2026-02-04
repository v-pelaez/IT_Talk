<nav x-data="{ open: false }" class="bg-white border-b border-[#e1e8ed] sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-12">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('timeline') }}" class="flex items-center group">
                        <i class="fa-solid fa-bug text-[#1da1f2] text-xl mr-2 transition-transform group-hover:rotate-12"></i> 
                        <span class="font-black text-xl tracking-tighter text-[#1da1f2]">IT-TALK</span>
                    </a>
                </div>

                <div class="hidden space-x-1 sm:-my-px sm:ms-10 sm:flex">
                    {{-- Usamos clases condicionales para el estado activo --}}
                    <x-nav-link :href="route('timeline')" :active="request()->routeIs('timeline')"
                        class="px-4 font-bold transition duration-150 border-b-2 {{ request()->routeIs('timeline') ? 'text-[#14171a] border-[#1da1f2]' : 'text-[#657786] border-transparent hover:text-[#1da1f2] hover:bg-[#f5f8fa]' }}">
                        <i class="fas fa-home mr-1"></i> {{ __('Inicio') }}
                    </x-nav-link>
                    <x-nav-link :href="route('ranking')" :active="request()->routeIs('ranking')"
                        class="px-4 font-bold transition duration-150 border-b-2 {{ request()->routeIs('ranking') ? 'text-[#14171a] border-[#1da1f2]' : 'text-[#657786] border-transparent hover:text-[#1da1f2] hover:bg-[#f5f8fa]' }}">
                        <i class="fas fa-solid fa-award mr-1"></i> {{ __('Ranking') }}
                    </x-nav-link>

                    @auth
                        @role('admin|moderator')
                        <x-nav-link :href="route('userlist')" :active="request()->routeIs('userlist')"
                            class="px-4 font-bold transition duration-150 border-b-2 {{ request()->routeIs('userlist') ? 'text-[#14171a] border-[#1da1f2]' : 'text-[#657786] border-transparent hover:text-[#1da1f2] hover:bg-[#f5f8fa]' }}">
                            <i class="fas fa-users mr-1"></i> {{ __('Usuarios') }}
                        </x-nav-link>
                        @endrole
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-1 border border-[#e1e8ed] text-sm leading-4 font-bold rounded-full text-[#657786] bg-white hover:bg-[#f5f8fa] hover:text-[#1da1f2] focus:outline-none transition ease-in-out duration-150">
                                <div class="flex items-center">
                                    <span class="mr-2">{{ Auth::user()->name }}</span>
                                    <span class="text-[9px] bg-[#f5f8fa] border border-[#e1e8ed] px-1.5 py-0.5 rounded text-[#657786] uppercase tracking-tighter">
                                        {{ auth()->user()->roles->pluck('name')->first() ?? 'User' }}
                                    </span>
                                </div>
                                <i class="fas fa-chevron-down ms-2 text-[10px] opacity-50"></i>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-[10px] text-[#657786] border-b border-[#e1e8ed] mb-1 font-bold uppercase tracking-widest">
                                Cuenta
                            </div>
                            <x-dropdown-link :href="route('profile.edit')" class="hover:bg-[#f5f8fa] hover:text-[#1da1f2] font-semibold text-sm">
                                <i class="fas fa-user-circle mr-2"></i> {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        class="hover:bg-[#fff1f0] hover:text-red-600 font-semibold text-sm text-red-500"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fas fa-power-off mr-2"></i> {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-[#657786] hover:text-[#1da1f2] px-3 py-2 transition">
                            {{ __('Entrar') }}
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="inline-flex items-center px-4 py-1.5 bg-[#1da1f2] border border-transparent rounded-full font-bold text-xs text-white hover:bg-[#1991db] transition duration-150 shadow-sm">
                                {{ __('Registrarse') }}
                            </a>
                        @endif
                    </div>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#1da1f2] hover:bg-[#f5f8fa] focus:outline-none transition">
                    <i :class="{'hidden': open, 'inline-block': ! open }" class="fas fa-bars text-xl"></i>
                    <i :class="{'hidden': ! open, 'inline-block': open }" class="fas fa-times text-xl hidden"></i>
                </button>
            </div>
        </div>
    </div>
</nav>