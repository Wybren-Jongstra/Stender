@extends('layouts.default')
@section('content')
<div id="header" class="container-fluid">
    <a id="logo" href="/"></a>
</div>
<div class="background-overlay"></div>
<div id="content-home" class="container">
    <div class="row">
        <div id="left-column" class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
            <h1>Welkom op Stender</h1>
            <p>
                Verbind met je klasgenoten - studiegenoten - en andere medestudenten. Ontvang updates over jou interesses.
                Bekijk met wie jij naar een studenten feest wilt.
            </p>
        </div>
        <div id="right-column" class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
            <div id="log-in" class="rounded-div col-lg-12">
                <form>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" placeholder="<?php echo ucfirst(Lang::get('attributes.user.email')); ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" placeholder="<?php echo ucfirst(Lang::get('attributes.user.password')); ?>">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">Blijf ingelogd
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary col-xs-12 col-sm-12 col-md-12">Inloggen</button>
                </form>
            </div>

            <div id="register" class="rounded-div col-lg-12">
                <h2>Nieuw op Stender? Registreer nu</h2>
                <hr class="line">

                @if(Session::has('success'))
                <div class="alert alert-success">
                        {{ Session::get('success') }}
                </div>
                @endif
                {{ Form::open(array('url' => 'postRegister'))}}
                @if($errors->any())
                <div class="alert alert-error">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ implode('', $errors->all('<li class="error">:message</li>'))}}
                </div>
                @endif
                <div class="form-group">
                    {{ Form::text('fullName', '', array('class' => 'form-control', 'id' => 'inputName', 'placeholder' => ucfirst(Lang::get('attributes.user.fullName')), 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{ Form::text('email', '', array('class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => ucfirst(Lang::get('attributes.user.email')), 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{ Form::password('password', array('placeholder' => ucfirst(Lang::get('attributes.user.password')), 'class' => 'form-control', 'required' => 'required'))}}
                </div>
                {{ Form::submit('Registreren', array('class' => 'btn btn-warning col-xs-12 col-sm-12 col-md-12'))}}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop
