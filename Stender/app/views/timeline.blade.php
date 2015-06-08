@extends('layouts.common')
@section('content')
<div id="content" class="container">
    <div class="row">
        <div id="left-column" class="hidden-xs col-sm-4 col-md-3 col-lg-3">
            <div id="profile" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @if( empty($data['PhotoUrl']) )
                        <img src="{{ URL::to('uploads/default_profile_picture.png') }}" class="profile-image col-xs-12 col-sm-12 col-md-12 col-lg-12" />
                    @else
                        <img src="{{ URL::to('uploads/'.$data['PhotoUrl']) }}" class="profile-image col-xs-12 col-sm-12 col-md-12 col-lg-12" />
                    @endif
                <div class="clearfix"></div>
                <h3 class="col-xs-12 col-sm-12 col-md-12 col-lg-12">{{ $userProfile['DisplayName'] }}</h3>
                <div class="clearfix"></div>
                <div class="no-padding-left col-xs-5 col-sm-5 col-md-5 col-lg-5">
                    <span class="scoreHeader col-xs-12 col-sm-12 col-md-12 col-lg-12">Connecties</span>
                    <span id="connections" class="score col-xs-12 col-sm-12 col-md-12 col-lg-12">{{ $connections }}</span>
                </div>
                <div class="no-padding-left col-xs-7 col-sm-7 col-md-7 col-lg-7">
                    <span class="scoreHeader col-xs-12 col-sm-12 col-md-12 col-lg-12">Stender Score</span>
                    <span id="stenderScore" class="score col-xs-12 col-sm-12 col-md-12 col-lg-12">{{ $stenderScore }}</span>
                </div>
            </div>

            <div id="connections" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="review-header" class="border-bottom col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Connecties</h5>
                </div>
                @if( count($connectionProfiles) > 0 )
                    @foreach ($connectionProfiles as $connectionProfile)
                        <div class="online col-xs-2 col-sm-2 col-md-2 col-lg-2"><span class="glyphicon glyphicon-globe"></span></div>
                        <a href="profile/{{ $connectionProfile[0] }}" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">{{ $connectionProfile[1] }}</a>
                    @endforeach
                @endif
            </div>
        </div>
        <div id="right-column" class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
            <div id="timeline-post" class="spacing-top col-xs-12 col-sm-12 col-md-12 col-lg-12">
                {{ Form::open(array('url' => 'postStatus')) }}
                    {{ Form::textarea('userStatus', '', array('class' => 'form-control', 'rows' => '3', 'placeholder' => 'Wat ben je aan het doen?')) }}
                    {{ Form::submit('Plaats status', array('type' => 'button', 'class' => 'btn btn-success col-xs-4 col-sm-2 col-md-2 col-lg-2')) }}
                {{ Form::close() }}
            </div>

            @foreach ($statusUpdates as $statusUpdate)
                <div id="timeline" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a href="profile/{{ TimelineController::getUserProfileByUserID($statusUpdate['UserID'])['ProfileUrlPart'] }}" class="no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            {{ TimelineController::getUserProfileByUserID($statusUpdate['UserID'])['DisplayName'] }}
                        </a>
                        <span class="time-ago no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">{{ TimelineController::getTimeAgo($statusUpdate->DateCreated) }}</span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        {{ $statusUpdate['Text'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop
