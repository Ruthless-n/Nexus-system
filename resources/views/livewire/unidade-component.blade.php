<div>
    @if($unidadeId)
        <div class="mb-2 p-2 bg-yellow-100 border border-yellow-400 rounded">
            <span class="text-yellow-800">Modo de edição - Editando unidade ID: {{ $unidadeId }}</span>
        </div>
    @endif
    
    <form wire:submit.prevent="store" class="mb-4 space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <input type="text" wire:model="nome_fantasia" placeholder="Nome Fantasia" class="border p-2 w-full">
                @error('nome_fantasia') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <input type="text" wire:model="razao_social" placeholder="Razão Social" class="border p-2 w-full">
                @error('razao_social') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <input type="text" wire:model="cnpj" placeholder="CNPJ (00.000.000/0000-00)" class="border p-2 w-full" maxlength="18">
                @error('cnpj') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <select wire:model="bandeira_id" class="border p-2 w-full">
                    <option value="">Selecione uma Bandeira</option>
                    @foreach($bandeiras as $bandeira)
                        <option value="{{ $bandeira->id }}">{{ $bandeira->nome }}</option>
                    @endforeach
                </select>
                @error('bandeira_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                {{ $unidadeId ? 'Atualizar' : 'Adicionar' }}
            </button>
            @if($unidadeId)
                <button type="button" wire:click="cancel" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
                    Cancelar
                </button>
            @endif
        </div>
    </form>

    <table class="table-auto w-full border">
        <thead>
            <tr>
                <th class="border px-2 py-1">ID</th>
                <th class="border px-2 py-1">Nome Fantasia</th>
                <th class="border px-2 py-1">Razão Social</th>
                <th class="border px-2 py-1">CNPJ</th>
                <th class="border px-2 py-1">Bandeira</th>
                <th class="border px-2 py-1">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($unidades as $unidade)
                <tr>
                    <td class="border px-2 py-1">{{ $unidade->id }}</td>
                    <td class="border px-2 py-1">{{ $unidade->nome_fantasia }}</td>
                    <td class="border px-2 py-1">{{ $unidade->razao_social }}</td>
                    <td class="border px-2 py-1">{{ $unidade->cnpj }}</td>
                    <td class="border px-2 py-1">{{ $unidade->bandeira->nome ?? 'N/A' }}</td>
                    <td class="border px-2 py-1">
                        <button wire:click="edit({{ $unidade->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                        <button wire:click="delete({{ $unidade->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Excluir</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
