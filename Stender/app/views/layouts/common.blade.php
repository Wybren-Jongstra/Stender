@extends('layouts.header')
    @section('jquery-scripts')
    @endsection
    @section('custom-scripts')
        <script src="{{ URL::to('js/jquery-ui.js') }}"></script>
        <!-- <script src="{{ URL::to('js/jquery-ui.min.js') }}"></script> -->
        <!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->

            <link href="{{ URL::to('/css/bootstrap-editable.css') }}" rel="stylesheet">
            <script src="{{ URL::to('js/bootstrap-editable.js') }}">
            </script>

        <script>
        $(document).ready(function(){

//$("#menuButton").onclick(function(){
  //          $(".dropdown-toggle").dropdown('toggle');
    //    });

        $( "#inputName" ).autocomplete(
        {
            source: '/search/autocomplete',
            select: function( event, ui ) {
                $( "#inputName" ).val( ui.item.label + " / " + ui.item.actor );
                return false;
            }
        });


            @yield('custom-jquery')
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
                                {{ Form::text('inputName', '', array('class' => 'form-control', 'id' => 'inputName', 'placeholder' => 'Naam', 'required' => 'required')) }}
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
                            <a href="#" id="menuButton" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/timeline">Tijdlijn</a></li>
                                <li><a href="/profile/{{ $data['ProfileUrlPart'] }}">Profiel</a></li>
                                <li><a href="#">Connecties</a></li>
                                <li><a href="/settings">Instellingen</a></li>
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