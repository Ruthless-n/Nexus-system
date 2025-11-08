<div>
    <x-success-message />

    @if($unidadeId)
        <x-edit-mode-banner 
            :id="$unidadeId" 
            :nome="$nome_fantasia"
            type="unidade" 
        />
    @endif
    
    <form wire:submit.prevent="store" class="mb-4">
        <div class="max-w-2xl mx-auto p-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-form-input
                    label="Nome Fantasia"
                    name="nome_fantasia"
                    placeholder="Nome Fantasia"
                />

                <x-form-input
                    label="Razão Social"
                    name="razao_social"
                    placeholder="Razão Social"
                />

                <x-form-input
                    label="CNPJ"
                    name="cnpj"
                    placeholder="00.000.000/0000-00"
                    maxlength="18"
                />

                <x-form-select
                    label="Bandeira"
                    name="bandeira_id"
                    class="border-gray-300 focus:border-[#3C004A] rounded-md"
                >
                    @foreach($bandeiras as $bandeira)
                        <option value="{{ $bandeira->id }}">{{ $bandeira->nome }}</option>
                    @endforeach
                </x-form-select>
            </div>

            <div class="mt-4 flex justify-center gap-2">
                <x-primary-button class="w-full sm:w-auto">
                    {{ $unidadeId ? 'Atualizar' : 'Adicionar' }}
                </x-primary-button>

                @if($unidadeId)
                    <button type="button" wire:click="cancel" class="bg-gray-500 text-white px-4 py-2 rounded">
                        Cancelar
                    </button>
                @endif
            </div>
        </div>
    </form>

    <x-table>
        <x-slot name="header">
            <x-table-header>Nome Fantasia</x-table-header>
            <x-table-header>Razão Social</x-table-header>
            <x-table-header>CNPJ</x-table-header>
            <x-table-header>Bandeira</x-table-header>
            <x-table-header>Ações</x-table-header>
        </x-slot>
        @foreach($unidades as $unidade)
            <tr>
                <x-table-cell>{{ $unidade->nome_fantasia }}</x-table-cell>
                <x-table-cell>{{ $unidade->razao_social }}</x-table-cell>
                <x-table-cell>{{ $unidade->cnpj }}</x-table-cell>
                <x-table-cell>{{ $unidade->bandeira->nome ?? 'N/A' }}</x-table-cell>
                <x-table-cell>
                    <x-edit-button :id="$unidade->id" class="mr-1" />
                    <x-delete-button :id="$unidade->id" />
                </x-table-cell>
            </tr>
        @endforeach
    </x-table>
</div>
