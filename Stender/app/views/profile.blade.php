@extends('layouts.common')
@section('custom-jquery')
$('#vote-up-button').click(function() {
    $.ajax({
        url: '{{ URL::to('/upvote') }}',
        type: 'GET',
        data: { "id" : "{{ $data['UserProfileID'] }}" },
        success: function (result) {
            location.reload();
        }
    });
});
$('#vote-down-button').click(function() {
    $.ajax({
        url: '{{ URL::to('/downvote') }}',
        type: 'GET',
        data: { "id" : "{{ $data['UserProfileID'] }}" },
        success: function (result) {
            location.reload();
        }
    });
});
@endsection
@section('content')
<div id="content" class="container">
    <div class="row">
        <div id="profile" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="up-down-vote" class="col-xs-4 col-sm-2 col-md-1 col-lg-1">
                @if( $data['UserProfileID'] !== Session::get('UserProfileID') )
                    <a id="vote-up-button" href="#" class="btn col-xs-12 col-sm-12 col-md-12 col-lg-12"></a>
                    <a id="vote-down-button" href="#" class="btn col-xs-12 col-sm-12 col-md-12 col-lg-12"></a>
                @endif
            </div>
            <div id="profile-photo" class="col-xs-8 col-sm-4 col-md-3 col-lg-3">
                @if( empty($data['PhotoUrl']) )
                    <img src="{{ URL::to('uploads/default_profile_picture.png') }}" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" />
                @else
                    <img src="{{ URL::to('uploads/'.$data['PhotoUrl']) }}" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" />
                @endif
            </div>
            <div id="profile-info" class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                <h2>{{ $data['DisplayName'] }}</h2>
                Geboren: {{ $data['Birthday'] }}<br/>
                Woonplaats: {{ $data['City'] }}<br/>
                Opleiding: {{ $data['Education'] }}

                <div id="profile-score-info" class="no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="no-padding-left col-xs-4 col-sm-4 col-md-3 col-lg-3">
                        <span class="scoreHeader no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">Connecties</span>
                        <span id="connections" class="score no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">{{ $connections }}</span>
                    </div>
                    <div class="no-padding-left col-xs-4 col-sm-4 col-md-3 col-lg-3">
                        <span class="scoreHeader no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">Stender Score</span>
                        <span id="stenderScore" class="score no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">{{ $stenderScore }}</span>
                    </div>
                    @if( $data['UserProfileID'] !== Session::get('UserProfileID') && $connectionState != true )
                        {{ Form::open(array('url' => 'connect')) }}
                            {{ Form::hidden('user', $data["UserProfileID"], array('type' => 'hidden')) }}
                            {{ Form::hidden('url', $data["ProfileUrlPart"], array('type' => 'hidden')) }}
                            {{ Form::submit('Connect', array('type' => 'button', 'class' => 'btn btn-primary col-xs-offset-2 col-sm-offset-2 col-md-offset-4 col-lg-offset-4')) }}
                        {{ Form::close() }}
                    @endif
                </div>
            </div>
        </div>

        <div id="socialData" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="interest-block" class="social-media-blocks border-right col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div id="interests-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Interesses</h5>
                </div>
                <div id="interests" class="border-top no-list-signs col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul>
                        @foreach ($interests as $interest)
                            <li>{{ $interest }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div id="experience-block" class="border-right social-media-blocks col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div id="experience-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Vaardigheden</h5>
                </div>
                <div id="experience" class="border-top no-list-signs col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul>
                        @foreach ($skills as $skill)
                            <li>{{ $skill }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div id="hobby-block" class="social-media-blocks col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div id="hobby-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Hashtags</h5>
                </div>
                <div id="hobby" class="border-top no-list-signs col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul>
                        @foreach ($places as $place)
                            <li>#{{ $place }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div id="reviews" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="review-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h5>Reviews</h5>
            </div>
            <div id="review-list" class="border-top no-list-signs col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul>
                    @foreach ($reviews as $review)
                        <li>{{ $review }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@stop
