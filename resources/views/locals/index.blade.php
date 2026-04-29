<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Espaços - Locais</title>
</head>
<body>
    <h1>Lista de Locais</h1>

    <a href="{{ route('locals.create') }}">Cadastrar Novo Local</a>

    <ul>
        @foreach($locals as $local)
            <li>
                {{ $local->name }}

                <form action="{{ route('locals.destroy', $local->id) }}" method="POST" style="display:inline;"
                      onsubmit="return confirm('Tem certeza que deseja excluir este local?')">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('locals.edit', $local->id) }}">Editar</a>
                    <button type="submit">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
