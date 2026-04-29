<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Local</title>
</head>
<body>
    <h1>Novo Local</h1>

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

    <form action="{{ route('locals.store') }}" method="POST">
        @csrf

        Nome do local: <input name="name" type="text" value="{{old('name')}}" required>
        Endereço: <input name="address" type="text" value="{{old('address')}}" required>
        Descrições: <input name="description" type="text" value="{{old('description')}}">

        <button type="submit">Salvar Local</button>
    </form>

    <br>
    <a href="{{ route('locals.index') }}">Voltar para a lista</a>
</body>
</html>
