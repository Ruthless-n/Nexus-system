<div>
    <x-success-message />

    @if($bandeiraId)
        <x-edit-mode-banner 
            :id="$bandeiraId" 
            :nome="$nome"
            type="bandeira" 
        />
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
                    class="border-gray-300 focus:border-[#3C004A] rounded-md"
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
            <x-table-header>Nome</x-table-header>
            <x-table-header>Grupo Econômico</x-table-header>
            <x-table-header>Ações</x-table-header>
        </x-slot>
        @foreach($bandeiras as $bandeira)
            <tr>
                <x-table-cell>{{ $bandeira->nome }}</x-table-cell>
                <x-table-cell>{{ $bandeira->grupoEconomico->nome ?? 'N/A' }}</x-table-cell>
                <x-table-cell>
                    <x-edit-button :id="$bandeira->id" class="mr-1" />
                    <x-delete-button :id="$bandeira->id" />
                </x-table-cell>
            </tr>
        @endforeach
    </x-table>
</div>
