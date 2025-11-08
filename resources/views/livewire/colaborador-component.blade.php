<div>
    <x-success-message />

    @if($colaboradorId)
        <x-edit-mode-banner 
            :id="$colaboradorId" 
            :nome="$nome"
            type="colaborador" 
        />
    @endif

    
    <form wire:submit.prevent="store" class="mb-4">
        <div class="max-w-2xl mx-auto p-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-form-input
                    label="Nome do Colaborador"
                    name="nome"
                    placeholder="Nome do Colaborador"
                />

                <x-form-input
                    label="Email"
                    name="email"
                    type="email"
                    placeholder="Email"
                />

                <x-form-input
                    label="CPF"
                    name="cpf"
                    placeholder="000.000.000-00"
                    maxlength="14"
                />

                <x-form-select
                    label="Unidade"
                    name="unidade_id"
                    class="border-gray-300 focus:border-[#3C004A] rounded-md"
                >
                    @foreach($unidades as $unidade)
                        <option value="{{ $unidade->id }}">{{ $unidade->nome_fantasia }}</option>
                    @endforeach
                </x-form-select>
            </div>

            <div class="mt-4 flex justify-center gap-2">
                <x-primary-button class="w-full sm:w-auto">
                    {{ $colaboradorId ? 'Atualizar' : 'Adicionar' }}
                </x-primary-button>

                @if($colaboradorId)
                    <button type="button" wire:click="cancel" class="bg-gray-500 text-white px-4 py-2 rounded">
                        Cancelar
                    </button>
                @endif
            </div>
        </div>
    </form>

    <div class="mb-4 flex justify-center">
    <a href="{{ route('reports.colaboradores') }}" class="bg-[#CC4242] text-white px-4 py-2 rounded inline-flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
        </svg>
        Relatório de Colaboradores
    </a>
    </div>

    <x-table>
        <x-slot name="header">
            <x-table-header>Nome</x-table-header>
            <x-table-header>Email</x-table-header>
            <x-table-header>CPF</x-table-header>
            <x-table-header>Unidade</x-table-header>
            <x-table-header>Ações</x-table-header>
        </x-slot>
        @foreach($colaboradores as $colaborador)
            <tr>
                <x-table-cell>{{ $colaborador->nome }}</x-table-cell>
                <x-table-cell>{{ $colaborador->email }}</x-table-cell>
                <x-table-cell>{{ $colaborador->cpf }}</x-table-cell>
                <x-table-cell>{{ $colaborador->unidade->nome_fantasia ?? 'N/A' }}</x-table-cell>
                <x-table-cell>
                    <x-edit-button :id="$colaborador->id" class="mr-1" />
                    <x-delete-button :id="$colaborador->id" />
                </x-table-cell>
            </tr>
        @endforeach
    </x-table>
</div>
