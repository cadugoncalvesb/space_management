<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Local</title>
</head>
<body>
    <h1>Novo Local</h1>

    <form action="{{ route('locals.store') }}" method="POST">
        @csrf

        Nome do local: <input name="name" type="text">
        Endereço: <input name="address" type="text">
        Descrições: <input name="description" type="text">

        <button type="submit">Salvar Local</button>
    </form>

    <br>
    <a href="{{ route('locals.index') }}">Voltar para a lista</a>
</body>
</html>
