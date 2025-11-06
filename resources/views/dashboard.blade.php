@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Bem-vindo(a) ao Nexus System</h1>
                    <p class="mb-4">Sistema de gerenciamento de grupos econômicos, bandeiras, unidades e colaboradores.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
                        <a href="{{ route('grupos-economicos') }}" class="block p-4 bg-purple-50 border border-[#3C004A]  rounded-lg hover:bg-purple-100 transition">
                            <h3 class="text-lg font-semibold text-[#3C004A]">Grupos Econômicos</h3>
                            <p class="text-sm text-purple-700">Gerenciar grupos econômicos</p>
                        </a>
                        
                        <a href="{{ route('bandeiras') }}" class="block p-4 bg-purple-50 border border-[#3C004A]  rounded-lg hover:bg-purple-100 transition">
                            <h3 class="text-lg font-semibold text-[#3C004A]">Bandeiras</h3>
                            <p class="text-sm text-purple-700">Gerenciar bandeiras</p>
                        </a>
                        
                        <a href="{{ route('unidades') }}" class="block p-4 bg-purple-50 border border-[#3C004A]  rounded-lg hover:bg-purple-100 transition">
                            <h3 class="text-lg font-semibold text-[#3C004A]">Unidades</h3>
                            <p class="text-sm text-purple-700">Gerenciar unidades</p>
                        </a>
                        
                        <a href="{{ route('colaboradores') }}" class="block p-4 bg-purple-50 border border-[#3C004A]  rounded-lg hover:bg-purple-100 transition">
                            <h3 class="text-lg font-semibold text-[#3C004A]">Colaboradores</h3>
                            <p class="text-sm text-purple-700">Gerenciar colaboradores</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
