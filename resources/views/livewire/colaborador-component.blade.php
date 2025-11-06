<div>
    @if($colaboradorId)
        <div class="mb-2 p-2 bg-yellow-100 border border-yellow-400 rounded">
            <span class="text-yellow-800">Modo de edição - Editando colaborador ID: {{ $colaboradorId }}</span>
        </div>
    @endif
    
    <form wire:submit.prevent="store" class="mb-4 space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <input type="text" wire:model="nome" placeholder="Nome do Colaborador" class="border p-2 w-full">
                @error('nome') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <input type="email" wire:model="email" placeholder="Email" class="border p-2 w-full">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <input type="text" wire:model="cpf" placeholder="CPF (000.000.000-00)" class="border p-2 w-full" maxlength="14">
                @error('cpf') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <select wire:model="unidade_id" class="border p-2 w-full">
                    <option value="">Selecione uma Unidade</option>
                    @foreach($unidades as $unidade)
                        <option value="{{ $unidade->id }}">{{ $unidade->nome_fantasia }}</option>
                    @endforeach
                </select>
                @error('unidade_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                {{ $colaboradorId ? 'Atualizar' : 'Adicionar' }}
            </button>
            @if($colaboradorId)
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
                <th class="border px-2 py-1">Email</th>
                <th class="border px-2 py-1">CPF</th>
                <th class="border px-2 py-1">Unidade</th>
                <th class="border px-2 py-1">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($colaboradores as $colaborador)
                <tr>
                    <td class="border px-2 py-1">{{ $colaborador->id }}</td>
                    <td class="border px-2 py-1">{{ $colaborador->nome }}</td>
                    <td class="border px-2 py-1">{{ $colaborador->email }}</td>
                    <td class="border px-2 py-1">{{ $colaborador->cpf }}</td>
                    <td class="border px-2 py-1">{{ $colaborador->unidade->nome_fantasia ?? 'N/A' }}</td>
                    <td class="border px-2 py-1">
                        <button wire:click="edit({{ $colaborador->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                        <button wire:click="delete({{ $colaborador->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Excluir</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
