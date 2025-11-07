<div class="max-w-4xl mx-auto p-4">
    <div class="bg-white p-4 rounded shadow">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium">Unidade</label>
                <select wire:model="unidade_id" class="border p-2 w-full">
                    <option value="">Todas</option>
                    @foreach($unidades as $u)
                        <option value="{{ $u->id }}">{{ $u->nome_fantasia }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium">Nome</label>
                <input wire:model="nome" type="text" class="border p-2 w-full" placeholder="Pesquisar por nome">
            </div>
        </div>

        <div class="mt-4 flex gap-2 justify-end">
            <button wire:click="export" class="bg-[#3C004A] text-white px-4 py-2 rounded">Exportar Excel</button>
        </div>
    </div>

    <div class="mt-4">
        <x-table>
            <x-slot name="header">
                <x-table-header>ID</x-table-header>
                <x-table-header>Nome</x-table-header>
                <x-table-header>Email</x-table-header>
                <x-table-header>CPF</x-table-header>
                <x-table-header>Unidade</x-table-header>
            </x-slot>

            @foreach($colaboradores as $colaborador)
                <tr>
                    <x-table-cell>{{ $colaborador->id }}</x-table-cell>
                    <x-table-cell>{{ $colaborador->nome }}</x-table-cell>
                    <x-table-cell>{{ $colaborador->email }}</x-table-cell>
                    <x-table-cell>{{ $colaborador->cpf }}</x-table-cell>
                    <x-table-cell>{{ $colaborador->unidade->nome_fantasia ?? 'N/A' }}</x-table-cell>
                </tr>
            @endforeach
        </x-table>

        <div class="mt-4">
            {{ $colaboradores->links() }}
        </div>
    </div>
</div>