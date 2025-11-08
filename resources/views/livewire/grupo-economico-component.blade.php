<div>
    <x-success-message />

    @if($grupoId)
        <x-edit-mode-banner 
            :id="$grupoId" 
            :nome="$nome"
            type="grupo econômico" 
        />
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
                    <x-edit-button :id="$grupo->id" class="mr-1" />
                    <x-delete-button :id="$grupo->id" />
                </x-table-cell>
            </tr>
        @endforeach
    </x-table>
</div>
