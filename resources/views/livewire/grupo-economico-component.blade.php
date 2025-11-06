<div>
    @if($grupoId)
        <div class="mb-2 p-2 bg-yellow-100 border border-yellow-400 rounded">
            <span class="text-yellow-800">Modo de edição - Editando o grupo: {{ $nome }}</span>
        </div>
    @endif
    
    <form wire:submit.prevent="store" class="mb-4">
        <div class="max-w-2xl mx-auto p-4">
            <div class="grid grid-cols-1 gap-4">
                <x-form-input
                    label="Nome do Grupo"
                    name="nome"
                    placeholder="Nome do Grupo"
                />
            </div>

            <div class="mt-4 flex justify-center gap-2">
                <x-primary-button class="w-full sm:w-auto">
                    {{ $grupoId ? 'Atualizar' : 'Adicionar' }}
                </x-primary-button>

                @if($grupoId)
                    <button type="button" wire:click="cancel" class="bg-gray-500 text-white px-4 py-2 rounded">
                        Cancelar
                    </button>
                @endif
            </div>
        </div>
    </form>

    
    <x-table>
        <x-slot name="header">
            <x-table-header>Nome</x-table-header>
            <x-table-header>Ações</x-table-header>
        </x-slot>
        @foreach($grupos as $grupo)
            <tr>
                <x-table-cell>{{ $grupo->nome }}</x-table-cell>
                <x-table-cell>
                    <button wire:click="edit({{ $grupo->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                    <button wire:click="delete({{ $grupo->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Excluir</button>
                </x-table-cell>
            </tr>
        @endforeach
    </x-table>
</div>
