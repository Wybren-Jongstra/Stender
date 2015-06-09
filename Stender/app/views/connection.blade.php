@extends('layouts.common')
@section('content')
    <div id="content" class="container">
        <div class="row">
            <div class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="border-bottom spacing-bottom col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Connecties</h5>
                </div>
                @if( count($connections) > 0 )
                    @foreach ($connections as $connection)
                        <div class="connection-spacing no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="no-padding-left col-xs-2 col-sm-2 col-md-1 col-lg-1">
                                @if( empty($connection[1]) )
                                    <img src="{{ URL::to('uploads/default_profile_picture.png') }}" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" />
                                @else
                                    <img src="{{ URL::to('uploads/'.$connection[1]) }}" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" />
                                @endif
                            </div>
                            <div class="no-padding-left col-xs-10 col-sm-10 col-md-11 col-lg-11">
                                <div class="no-padding-left col-xs-7 col-sm-5 col-md-4 col-lg-3">
                                    <div class="no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <a href="profile/{{ $connection[0] }}">
                                            {{ $connection[2] }}
                                        </a>
                                    </div>
                                    <div class="scoreHeader no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        Laatst gezien: {{ ConnectionPageController::getLastLogin($connection[3]) }}
                                    </div>
                                </div>
                                <div class="no-padding-left col-xs-5 col-sm-7 col-md-8 col-lg-9">
                                    <span class="scoreHeader no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">Stender Score</span>
                                    <span id="stenderScore" class="score no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">{{ ConnectionPageController::getStenderScore($connection[3]) }}</span>
                                </div>
                                <a href="removeConnection/{{ $connection[4] }}" class="delete-connection-btn btn btn-xs btn-danger pull-right">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="connection-spacing col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        Geen connecties
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
