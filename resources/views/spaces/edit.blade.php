<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Espaço</title>
</head>
<body>
    <h1>Editar Espaço</h1>

    <form action="{{ route('spaces.update', $space->id) }}" method="POST">
        @csrf
        @method('PUT')

        Nome do Espaço: <input type="text" name="name" value="{{ $space->name }}">
        Tipo (ex: Laboratório, Sala): <input type="text" name="type" value="{{ $space->type }}">
        Capacidade: <input type="number" name="capacity" value="{{$space->capacity}}">
        Status:
        <select name="status">
            <option value="active" {{ $space->status == 'active' ? 'selected' : '' }}>Ativo</option>
            <option value="inactive" {{ $space->status == 'inactive' ? 'selected' : '' }}>Inativo</option>
            <option value="maintenance" {{ $space->status == 'maintenance' ? 'selected' : '' }}>Em Manutenção</option>
        </select>
        <select name="local_id">
            @foreach($locals as $local)
                <option value="{{ $local->id }}" {{ $space->local_id == $local->id ? 'selected' : '' }}>
                    {{ $local->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Salvar Espaço</button>
    </form>

    <br>
    <a href="{{ route('spaces.index') }}">Voltar para a lista</a>
</body>
</html>
