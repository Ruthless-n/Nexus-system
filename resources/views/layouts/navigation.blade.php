<nav x-data="{ open: false }" class="bg-[#C974E3] border-b shadow-lg shadow-purple-300/50 z-50">
    <div class="max-w-7xl mx-auto px-4 py-2 sm:px-6 sm:py-4 lg:px-8 lg:py-5">
        <div class="flex justify-between h-15">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('homepage') }}">
                        <x-application-logo class="block h-2 w-10 fill-current text-white" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('homepage')" :active="request()->routeIs('homepage')" class="text-white">
                        {{ __('Página inicial') }}
                    </x-nav-link>

                    <x-nav-link :href="route('grupos-economicos')" :active="request()->routeIs('grupos-economicos')" class="text-white">
                        {{ __('Grupos Econômicos') }}
                    </x-nav-link>

                    <x-nav-link :href="route('bandeiras')" :active="request()->routeIs('bandeiras')" class="text-white">
                        {{ __('Bandeiras') }}
                    </x-nav-link>

                    <x-nav-link :href="route('unidades')" :active="request()->routeIs('unidades')" class="text-white">
                        {{ __('Unidades') }}
                    </x-nav-link>

                    <x-nav-link :href="route('colaboradores')" :active="request()->routeIs('colaboradores')" class="text-white">
                        {{ __('Colaboradores') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <a href="{{ route('auditoria') }}" class="inline-flex items-center px-3 py-2 mr-3 rounded-md text-white bg-[#2C2C2C] hover:bg-[#242424] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6 2a1 1 0 000 2h8a1 1 0 100-2H6z" />
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2h8a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                    </svg>
                    Logs
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#3C004A] hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                    
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Sair') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#3C004A] border-t border-[#3C004A]">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('homepage')" :active="request()->routeIs('homepage')" class="text-white">
                {{ __('Página inicial') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('grupos-economicos')" :active="request()->routeIs('grupos-economicos')" class="text-white">
                {{ __('Grupos Econômicos') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('bandeiras')" :active="request()->routeIs('bandeiras')" class="text-white">
                {{ __('Bandeiras') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('unidades')" :active="request()->routeIs('unidades')" class="text-white">
                {{ __('Unidades') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('colaboradores')" :active="request()->routeIs('colaboradores')" class="text-white">
                {{ __('Colaboradores') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('auditoria')" class="text-white">
                {{ __('Auditoria') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('profile.edit')" class="text-white">
                {{ __('Relatorios') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-blue-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-white">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();" class="text-white">
                        {{ __('Sair') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
