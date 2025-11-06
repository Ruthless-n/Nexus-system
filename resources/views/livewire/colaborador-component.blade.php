<div>
    @if($colaboradorId)
        <div class="mb-2 p-2 bg-yellow-100 border border-yellow-400 rounded">
            <span class="text-yellow-800">Modo de edição - Editando colaborador ID: {{ $colaboradorId }}</span>
        </div>
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

    <x-table>
        <x-slot name="header">
            <x-table-header>ID</x-table-header>
            <x-table-header>Nome</x-table-header>
            <x-table-header>Email</x-table-header>
            <x-table-header>CPF</x-table-header>
            <x-table-header>Unidade</x-table-header>
            <x-table-header>Ações</x-table-header>
        </x-slot>
        @foreach($colaboradores as $colaborador)
            <tr>
                <x-table-cell>{{ $colaborador->id }}</x-table-cell>
                <x-table-cell>{{ $colaborador->nome }}</x-table-cell>
                <x-table-cell>{{ $colaborador->email }}</x-table-cell>
                <x-table-cell>{{ $colaborador->cpf }}</x-table-cell>
                <x-table-cell>{{ $colaborador->unidade->nome_fantasia ?? 'N/A' }}</x-table-cell>
                <x-table-cell>
                    <button wire:click="edit({{ $colaborador->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                    <button wire:click="delete({{ $colaborador->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Excluir</button>
                </x-table-cell>
            </tr>
        @endforeach
    </x-table>
</div>
