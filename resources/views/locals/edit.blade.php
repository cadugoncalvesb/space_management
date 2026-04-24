<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Local</title>
</head>
<body>
<h1>Novo Local</h1>

<form action="{{ route('locals.update', $local->id) }}" method="POST">
    @csrf
    @method('PUT')

    Nome do local: <input name="name" type="text" value="{{$local->name}}">
    Endereço: <input name="address" type="text" value="{{$local->address}}">
    Descrições: <input name="description" type="text" value="{{$local->description}}">

    <button type="submit">Salvar Local</button>
</form>

<br>
<a href="{{ route('locals.index') }}">Voltar para a lista</a>
</body>
</html>
