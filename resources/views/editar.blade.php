<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container mt-5">
    <h2>Editando Usuário: <strong>{{$usuario->nome}}</strong></h2>
    
    <form action="/editar/{{$usuario->id}}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input name="nome" type="text" class="form-control" value="{{ $usuario->nome }}" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input name="email" type="email" class="form-control" value="{{ $usuario->email }}" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Nova Senha (opcional):</label>
        <input name="password" type="password" class="form-control" placeholder="Digite uma nova senha se desejar">
      </div>

      @if (auth()->user()->user_tipo == 'adm')
      <div class="mb-3">
        <label for="user_tipo" class="form-label">Tipo de Usuário:</label>
        <select name="user_tipo" class="form-select">
          <option value="usr" {{ $usuario->user_tipo == 'usr' ? 'selected' : '' }}>Usuário</option>
          <option value="adm" {{ $usuario->user_tipo == 'adm' ? 'selected' : '' }}>Administrador</option>
        </select>
      </div>
      @endif

      <button type="submit" class="btn btn-primary">Atualizar</button>
      <a href="/" class="btn btn-secondary">Voltar</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
