@extends('layouts.header')
    @section('jquery-scripts')
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    @endsection
    @section('custom-scripts')
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" >
    $(document).ready(function(){
        $(".dropdown-toggle").dropdown('toggle');


        $('#inputName').autocomplete({
            serviceUrl: '/admin/searches',
            dataType: 'json',
            type: 'GET',
            onSelect: function (suggestion) {
                alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
            }
        });

    });
    </script>
    @endsection
    @section('body')
        <div id="header" class="container-fluid">
            <div class="row">
                <a id="logo" class="col-xs-2 col-sm-3 col-md-2 col-lg-2" href="/"></a>
                <div class="search col-xs-6 col-sm-offset-2 col-sm-4 col-md-offset-3 col-md-4 col-lg-offset-3 col-lg-4">
                    {{ Form::open(['action' => ['SearchController@searchUser'], 'method' => 'GET']) }}
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                {{ Form::text('userName', '', array('class' => 'form-control', 'id' => 'inputName', 'placeholder' => 'Naam', 'required' => 'required')) }}
                                <span class="input-group-btn">
                                    {{ Form::submit('Zoek', array('type' => 'button', 'class' => 'btn btn-default'))}}
                                </span>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
                <div class="menu col-xs-3 col-sm-3 col-md-3 col-lg-offset-2 col-lg-1 pull-right">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/timeline">Tijdlijn</a></li>
                                <li><a href="#">Profiel</a></li>
                                <li><a href="#">Connecties</a></li>
                                <li><a href="#">Account</a></li>
                                <li class="divider"></li>
                                <li><a href="/logout">Log uit</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
		@yield('content')
    @stop