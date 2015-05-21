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
                {{ Form::open(['route' => 'sessions.store']) }}

                @if(Session::has('wrongCred'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ Session::get('wrongCred') }}
                    </div>
                @endif

                <div class="form-group">
                    {{ Form::text('emailLogin', '', array('class' => 'form-control', 'id' => 'email', 'placeholder' => ucfirst(Lang::get('attributes.user.email')), 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{ Form::password('password', array('placeholder' => ucfirst(Lang::get('attributes.user.password')), 'class' => 'form-control', 'required' => 'required'))}}
                </div>
                <div class="checkbox">
                        <label>
                            {{ Form::checkbox('blijf_ingelogd') }} Blijf ingelogd
                        </label>
                    </div>

                {{ Form::submit('Inloggen', array('class' => 'btn btn-primary col-xs-12 col-sm-12 col-md-12'))}}

                {{ Form::close() }}

            </div>

            <div id="register" class="rounded-div col-lg-12">
                <h2>Nieuw op Stender? Registreer nu</h2>
                <hr class="line">
                {{ Form::open(array('url' => 'postRegister'))}}
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ implode('', $errors->all(':message'))}}
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
