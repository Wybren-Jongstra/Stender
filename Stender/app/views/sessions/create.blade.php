@extends('layouts.common')
@section('content')

<div id="content" class="container">
    <div class="row">
        <div id="left-column" class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
            <div id="log-in" class="rounded-div col-lg-12">
                {{ Form::open(['route' => 'sessions.store']) }}

                @if(Session::has('wrongCred'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ Session::get('wrongCred') }}
                    </div>
                @endif

                <div class="form-group">
                    {{ Form::text('Email', '', array('class' => 'form-control', 'id' => 'email', 'placeholder' => 'E-mailadres', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{ Form::password('Password', array('placeholder' => 'Wachtwoord', 'class' => 'form-control', 'required' => 'required'))}}
                </div>
                <div class="checkbox">
                        <label>
                            {{ Form::checkbox('blijf_ingelogd') }} Blijf ingelogd
                        </label>
                    </div>

                {{ Form::submit('Inloggen', array('class' => 'btn btn-primary col-xs-12 col-sm-12 col-md-12'))}}

                {{ Form::close() }}

            </div>
        </div>
        <div id="right-column" class="col-xs-12 col-sm-12 col-md-5 col-lg-5">

        </div>
    </div>
</div>
@stop
