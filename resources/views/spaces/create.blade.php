<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Espaço</title>
</head>
<body>
    <h1>Novo Espaço</h1>

    @if($errors->any())
        <div style="color: red; margin-bottom: 20px;">
            <strong>Atenção:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('spaces.store') }}" method="POST">
        @csrf

        Nome do Espaço: <input type="text" name="name" value="{{old('name')}}" required>
        Tipo (ex: Laboratório, Sala): <input type="text" name="type" value="{{old('type')}}" required>
        Capacidade: <input type="number" name="capacity" value="{{old('capacity')}}" required>
        Status:
        <select name="status" required>
            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Ativo</option>
            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inativo</option>
            <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Em Manutenção</option>
        </select>
        <select name="local_id" required>
            <option value="">Selecione um Local:</option>
            @foreach($locals as $local)
                <option value="{{ $local->id }}">{{ $local->name }}</option>
            @endforeach
        </select>

        <button type="submit">Salvar Espaço</button>
    </form>

    <br>
    <a href="{{ route('spaces.index') }}">Voltar para a lista</a>
</body>
</html>
