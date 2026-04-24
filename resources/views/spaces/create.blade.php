<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Espaço</title>
</head>
<body>
    <h1>Novo Espaço</h1>

    <form action="{{ route('spaces.store') }}" method="POST">
        @csrf

        Nome do Espaço: <input type="text" name="name">
        Tipo (ex: Laboratório, Sala): <input type="text" name="type">
        Capacidade: <input type="number" name="capacity">
        Status:
        <select name="status">
            <option value="active">Ativo</option>
            <option value="inactive">Inativo</option>
            <option value="maintenance">Em Manutenção</option>
        </select>
        <select name="local_id">
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
