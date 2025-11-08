@props(['id', 'nome', 'type'])

<div class="mb-2 p-2 bg-yellow-100 border border-yellow-400 rounded">
    <span class="text-yellow-800">
        Modo de edição - Editando {{ $type }}: {{ $nome }}
    </span>
</div>