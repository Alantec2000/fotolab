@extends('templates.master')

@section('pageName', 'Login')

@section('conteudo-view')
<div id="form-session">
    <div class="panel">
        <h2>LOGIN</h2>

        <p id="authenticationErrors">
            @include('templates.errors', [
                'errors' => $errors,
                'field' => 'email'
            ])
        </p>

        <form action="{{ route('login.autenticar') }}" method="POST">
            {{ csrf_field() }}

           <div class="form">
                <input type="email" name="email" value="" placeholder="Email">
                <input type="password" name="senha" value="" placeholder="Senha" required>
                <button type="submit" name="login" class="btn bg-dark">Entrar</button>
           </div>
        </form>
    </div>
</div>
@endsection

