<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestão de Usuários</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    function toggleAdminPassword() {
      const userType = document.getElementById('user_tipo').value;
      const adminPasswordField = document.getElementById('admin-password');
      adminPasswordField.style.display = (userType === 'adm') ? 'block' : 'none';
    }
  </script>
</head>

<body class="bg-light">
  <div class="container mt-5">

    @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    @auth
    <h1 class="mb-4" id="welcome-message">Bem vindo, {{ auth()->user()->nome }}</h1>

      @if (auth()->user()->user_tipo == 'adm')
      <p class="alert alert-success" id="user-type">User logado como ADMIN</p>

      <form action="/logout" method="POST" class="mb-4">
        @csrf
        <button class="btn btn-danger">Logout</button>
      </form>

      <div class="card mb-4">
        <div class="card-header">
          <h2>Usuários cadastrados:</h2>
        </div>
        <div class="card-body">
          @foreach ($usuarios as $usuario)
          <div class="p-3 mb-3 bg-light border">
            <h3>Nome: <span class="user-name">{{$usuario['nome']}}</span></h3>
            <h3>Email: <span class="user-email">{{$usuario['email']}}</span></h3>
            <h3>Tipo de acesso: <span class="user-type">{{$usuario->user_tipo == 'adm' ? 'ADMIN' : 'USER'}}</span></h3>
            <button class="btn btn-primary" onclick="window.location.href='/editar/{{$usuario->id}}'">Editar</button>
            <form action="/deletar/{{$usuario->id}}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este usuário?')">Deletar</button>
            </form>
          </div>
          @endforeach
        </div>
      </div>

      @else  
        <p class="alert alert-info" id="user-type">Usuário logado como USER</p>

        <form action="/logout" method="POST" class="mb-4">
          @csrf
          <button class="btn btn-danger">Logout</button>
        </form>

        <h2>Seus dados:</h2>
        <div class="p-3 mb-3 bg-light border">
          <h3>Nome: <span id="user-name">{{ auth()->user()->nome }}</span></h3>
          <h3>Email: <span id="user-email">{{ auth()->user()->email }}</span></h3>
          <button class="btn btn-primary" onclick="window.location.href='/editar/{{auth()->user()->id}}'">Editar</button>
        </div>
      @endif

    @else <!--else do auth-->
      <div class="card mb-4">
        <div class="card-header">
          <h2>Novo por aqui? Cadastre seu usuário:</h2>
        </div>
        <div class="card-body">
          <form action="/registrar" method="POST">
            @csrf
            <div class="mb-3">
              <label for="nome" class="form-label">Nome:</label>
              <input name="nome" type="text" class="form-control" placeholder="Nome" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email:</label>
              <input name="email" type="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Senha:</label>
              <input name="password" type="password" class="form-control" placeholder="Senha (mínimo 5 caracteres)" required>
            </div>
            <div class="mb-3">
              <label for="user_tipo" class="form-label">Tipo de usuário:</label>
              <select name="user_tipo" id="user_tipo" class="form-select" onchange="toggleAdminPassword()">
                <option value="usr">Usuário</option>
                <option value="adm">Administrador</option>
              </select>
            </div>
            <div class="mb-3" id="admin-password" style="display: none;">
              <label for="senha_controle" class="form-label">Super senha para criação de admins:</label>
              <input name="senha_controle" type="password" class="form-control" placeholder="Senha de Controle (somente para administradores)">
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
          </form>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header">
          <h2>Já é cadastrado? Faça seu Login:</h2>
        </div>
        <div class="card-body">
          <form action="/login" method="POST">
            @csrf
            <div class="mb-3">
              <label for="logemail" class="form-label">Email:</label>
              <input name="logemail" type="text" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
              <label for="logpwd" class="form-label">Senha:</label>
              <input name="logpwd" type="password" class="form-control" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
        </div>
      </div>
    @endauth

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
