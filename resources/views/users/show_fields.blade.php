<!-- Uuid Field -->
<div class="form-group">
    {!! Form::label('UUID', 'Uuid:') !!}
    <p>{{ $user->UUID }}</p>
</div>

<!-- Avatar Name Field -->
<div class="form-group">
    {!! Form::label('avatar_name', 'Avatar Name:') !!}
    <p>{{ $user->avatar_name }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Email Verified At Field -->
<div class="form-group">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    <p>{{ $user->email_verified_at }}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    <p>{{ $user->password }}</p>
</div>

<!-- Remember Token Field -->
<div class="form-group">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    <p>{{ $user->remember_token }}</p>
</div>

<!-- Api Token Field -->
<div class="form-group">
    {!! Form::label('api_token', 'Api Token:') !!}
    <p>{{ $user->api_token }}</p>
</div>

<!-- Last Login At Field -->
<div class="form-group">
    {!! Form::label('last_login_at', 'Last Login At:') !!}
    <p>{{ $user->last_login_at }}</p>
</div>

<!-- Last Login Ip Field -->
<div class="form-group">
    {!! Form::label('last_login_ip', 'Last Login Ip:') !!}
    <p>{{ $user->last_login_ip }}</p>
</div>

