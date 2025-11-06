<button wire:click="export" class="bg-green-500 text-white px-4 py-2 rounded">
    Exportar Colaboradores
</button>

@if(session()->has('message'))
    <div class="mt-2 p-2 bg-green-100 text-green-800 rounded">
        {{ session('message') }}
    </div>
@endif
