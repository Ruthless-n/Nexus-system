<div>
    @if($grupoId)
        <div class="mb-2 p-2 bg-yellow-100 border border-yellow-400 rounded">
            <span class="text-yellow-800">Modo de edição - Editando o grupo: {{ $nome }}</span>
        </div>
    @endif
    
    <form wire:submit.prevent="store" class="mb-4">
        <input type="text" wire:model="nome" placeholder="Nome do Grupo" class="border p-2">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{ $grupoId ? 'Atualizar' : 'Adicionar' }}
        </button>
        @if($grupoId)
            <button type="button" wire:click="cancel" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
                Cancelar
            </button>
        @endif
    </form>

    
    <table class="table-auto w-full border">
        <thead>
            <tr>
                <th class="border px-2 py-1">Nome</th>
                <th class="border px-2 py-1">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grupos as $grupo)
                <tr>
                    <td class="border px-2 py-1">{{ $grupo->nome }}</td>
                    <td class="border px-2 py-1">
                        <button wire:click="edit({{ $grupo->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                        <button wire:click="delete({{ $grupo->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Excluir</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
