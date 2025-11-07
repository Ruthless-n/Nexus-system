<div class="max-w-5xl mx-auto p-4">
    <div class="bg-white p-4 rounded shadow">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Modelo</label>
                <input wire:model="model" type="text" class="border p-2 w-full" placeholder="App\\Models\\Colaborador">
            </div>

            <div>
                <label class="block text-sm font-medium">User ID</label>
                <input wire:model="user_id" type="text" class="border p-2 w-full" placeholder="ID do usuário">
            </div>
        </div>
    </div>

    <div class="mt-4">
        <x-table>
            <x-slot name="header">
                <x-table-header>ID</x-table-header>
                <x-table-header>Usuário</x-table-header>
                <x-table-header>Modelo</x-table-header>
                <x-table-header>Evento</x-table-header>
                <x-table-header>Data</x-table-header>
                <x-table-header>Detalhes</x-table-header>
            </x-slot>

            @foreach($audits as $audit)
                <tr>
                    <x-table-cell>{{ $audit->id }}</x-table-cell>
                    <x-table-cell>{{ $audit->user_id ?? 'System' }}</x-table-cell>
                    <x-table-cell>{{ class_basename($audit->auditable_type) }}</x-table-cell>
                    <x-table-cell>{{ $audit->event }}</x-table-cell>
                    <x-table-cell>{{ $audit->created_at }}</x-table-cell>
                    <x-table-cell>
                        <details class="text-sm">
                            <summary class="cursor-pointer text-indigo-600">Ver</summary>
                            <pre class="mt-2 text-xs bg-gray-100 p-2 rounded">Old: {{ json_encode($audit->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            <pre class="mt-2 text-xs bg-gray-100 p-2 rounded">New: {{ json_encode($audit->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </details>
                    </x-table-cell>
                </tr>
            @endforeach
        </x-table>

        <div class="mt-4">
            {{ $audits->links() }}
        </div>
    </div>
</div>