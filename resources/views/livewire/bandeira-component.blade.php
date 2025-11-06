<div>
    @if($bandeiraId)
        <div class="mb-2 p-2 bg-yellow-100 border border-yellow-400 rounded">
            <span class="text-yellow-800">Modo de edição - Editando bandeira ID: {{ $bandeiraId }}</span>
        </div>
    @endif
    
    <form wire:submit.prevent="store" class="mb-4">
        <div class="max-w-2xl mx-auto p-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-form-input
                    label="Nome da Bandeira"
                    name="nome"
                    placeholder="Nome da Bandeira"
                />

                <x-form-select
                    label="Grupo Econômico"
                    name="grupo_economico_id"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md"
                >
                    @foreach($gruposEconomicos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nome }}</option>
                    @endforeach
                </x-form-select>
            </div>

            <div class="mt-4 flex justify-center gap-2">
                <x-primary-button class="w-full sm:w-auto">
                    {{ $bandeiraId ? 'Atualizar' : 'Adicionar' }}
                </x-primary-button>

                @if($bandeiraId)
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
            <x-table-header>Grupo Econômico</x-table-header>
            <x-table-header>Ações</x-table-header>
        </x-slot>
        @foreach($bandeiras as $bandeira)
            <tr>
                <x-table-cell>{{ $bandeira->id }}</x-table-cell>
                <x-table-cell>{{ $bandeira->nome }}</x-table-cell>
                <x-table-cell>{{ $bandeira->grupoEconomico->nome ?? 'N/A' }}</x-table-cell>
                <x-table-cell>
                    <button wire:click="edit({{ $bandeira->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                    <button wire:click="delete({{ $bandeira->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Excluir</button>
                </x-table-cell>
            </tr>
        @endforeach
    </x-table>
</div>
