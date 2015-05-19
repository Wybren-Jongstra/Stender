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
                        <input type="email" class="form-control" id="email" placeholder="E-mailadres">
                    </div>
<<<<<<< HEAD
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" placeholder="Wachtwoord">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">Blijf ingelogd
                        </label>
=======

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
                            {{ Form::text('fullName', '', array('class' => 'form-control', 'id' => 'inputName', 'placeholder' => 'Volledige naam', 'required' => 'required'))}}
                        </div>
                        <div class="form-group">
                            {{ Form::text('email', '', array('class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'E-mailadres', 'required' => 'required'))}}
                        </div>
                        <div class="form-group">
                            {{ Form::password('password', array('placeholder' => 'Wachtwoord', 'class' => 'form-control', 'required' => 'required'))}}
                        </div>
                        {{ Form::submit('Registreren', array('class' => 'btn btn-warning col-xs-12 col-sm-12 col-md-12'))}}

                        {{ Form::close() }}

                        <!--<form>
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputName" placeholder="Volledige naam">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="inputEmail" placeholder="E-mailadres">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="inputPassword" placeholder="Wachtwoord">
                            </div>
                            <button type="submit" class="btn btn-warning col-xs-12 col-sm-12 col-md-12">Register</button>
                        </form> -->
>>>>>>> develop
                    </div>
                    <button type="submit" class="btn btn-primary col-xs-12 col-sm-12 col-md-12">Inloggen</button>
                </form>
            </div>

            <div id="register" class="rounded-div col-lg-12">
                <h2>Nieuw op Stender? Registreer nu</h2>
                <hr class="line">
                {{ Form::open(array('url' => 'postRegister'))}}
                @if($errors->any())
                <div class="alert alert-error">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ implode('', $errors->all('<li class="error">:message</li>'))}}
                </div>
                @endif
                <div class="form-group">
                    {{ Form::text('fullName', '', array('class' => 'form-control', 'id' => 'inputName', 'placeholder' => 'Volledige naam', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{ Form::text('email', '', array('class' => 'form-control', 'id' => 'inputEmail', 'placeholder' => 'E-mailadres', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{ Form::password('password', array('placeholder' => 'Wachtwoord', 'class' => 'form-control', 'required' => 'required'))}}
                </div>
                {{ Form::submit('Registreren', array('class' => 'btn btn-warning col-xs-12 col-sm-12 col-md-12'))}}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop
