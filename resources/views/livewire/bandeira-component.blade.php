<div>
    @if($bandeiraId)
        <div class="mb-2 p-2 bg-yellow-100 border border-yellow-400 rounded">
            <span class="text-yellow-800">Modo de edição - Editando bandeira ID: {{ $bandeiraId }}</span>
        </div>
    @endif
    
    <form wire:submit.prevent="store" class="mb-4 space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <input type="text" wire:model="nome" placeholder="Nome da Bandeira" class="border p-2 w-full">
                @error('nome') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <select wire:model="grupo_economico_id" class="border p-2 w-full">
                    <option value="">Selecione um Grupo Econômico</option>
                    @foreach($gruposEconomicos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nome }}</option>
                    @endforeach
                </select>
                @error('grupo_economico_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                {{ $bandeiraId ? 'Atualizar' : 'Adicionar' }}
            </button>
            @if($bandeiraId)
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
                <th class="border px-2 py-1">Nome</th>
                <th class="border px-2 py-1">Grupo Econômico</th>
                <th class="border px-2 py-1">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bandeiras as $bandeira)
                <tr>
                    <td class="border px-2 py-1">{{ $bandeira->id }}</td>
                    <td class="border px-2 py-1">{{ $bandeira->nome }}</td>
                    <td class="border px-2 py-1">{{ $bandeira->grupoEconomico->nome ?? 'N/A' }}</td>
                    <td class="border px-2 py-1">
                        <button wire:click="edit({{ $bandeira->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                        <button wire:click="delete({{ $bandeira->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Excluir</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
