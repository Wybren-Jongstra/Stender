@extends('layouts.common')
@section('custom-jquery')
   $('.click').editable({
    type: 'text',
    pk: 0,
    url: '{{ URL::to('/saveProfile/'.$data['ProfileUrlPart'])}}',
}); 

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

$(".hashtag").click(function(){
var attr = $(this).attr("id");
    $.ajax({
    url: "{{ URL::to('/deleteHashtag/') }}",
    type: "POST",
    data: 'id='+attr,
    success: function(){
         $ ("#"+attr).fadeOut();
    }
    })
});
$(".skill").click(function(){
var attr = $(this).attr("id");
    $.ajax({
    url: "{{ URL::to('/deleteSkill/') }}",
    type: "POST",
    data: 'id='+attr,
    success: function(){
         $ ("#"+attr).fadeOut();
    }
    })
});
$(".interest").click(function(){
var attr = $(this).attr("id");
    $.ajax({
    url: "{{ URL::to('/deleteInterest/') }}",
    type: "POST",
    data: 'id='+attr,
    success: function(){
         $ ("#"+attr).fadeOut();
    }
    })
});

 $(".education").val('{{ $data['EducationID'] }}');
$(".education").on('change', function() {
  $.ajax({
    url: "{{ URL::to('/changeEducation/') }}",
    type: "POST",
    data: 'id='+$(this).val(),
    })

});
@endsection
@section('content')
<div id="content" class="container">
    <div class="row">
        <div id="profile" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @if( $data['UserProfileID'] !== Session::get('UserProfileID') )
                <div id="up-down-vote" class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                    @if( $vote == 'no vote' )
                        <a id="vote-up-button" href="#" class="btn col-xs-12 col-sm-12 col-md-12 col-lg-12"></a>
                        <a id="vote-down-button" href="#" class="btn col-xs-12 col-sm-12 col-md-12 col-lg-12"></a>
                    @elseif( $vote == 0 )
                        <a id="vote-up-button" href="#" class="btn col-xs-12 col-sm-12 col-md-12 col-lg-12"></a>
                        <a id="vote-down-button-disabled" href="#" class="btn col-xs-12 col-sm-12 col-md-12 col-lg-12 disabled"></a>
                    @elseif( $vote == 1 )
                        <a id="vote-up-button-disabled" href="#" class="btn col-xs-12 col-sm-12 col-md-12 col-lg-12 disabled"></a>
                        <a id="vote-down-button" href="#" class="btn col-xs-12 col-sm-12 col-md-12 col-lg-12"></a>
                    @endif
                </div>
            @endif
            <div id="profile-photo" class="col-xs-8 col-sm-4 col-md-3 col-lg-3">
                @if( empty($data['PhotoUrl']) )
                    <img src="{{ URL::to('uploads/default_profile_picture.png') }}" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" />
                @else
                    <img src="{{ URL::to('uploads/'.$data['PhotoUrl']) }}" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" />
                @endif
            </div>
            <div id="profile-info" class="col-xs-12 col-sm-6 col-md-8 col-lg-8 edit">
                <div id="displayName">
                    <b class="click" id="DisplayName">{{ $data['DisplayName'] }}</b>
                </div>
                <div id="extraInfo">
                    Geboren:<b class="click" id="Birthday">
                    @if($data['Birthday'] == null || $data['Birthday'] == '01-01-1970')
                        {{"Voer je verjaardag in!"}}
                    @else
                       {{ $data['Birthday'] }} 
                    @endif
                    </b></br>
                    Woonplaats:<b class="click" id="City">
                    @if($data['City'] == null)
                        {{"Voer je Woonplaats in!"}}
                    @else
                       {{ $data['City'] }} 
                    @endif</b></br>
                    Opleiding:
                    <select class="education" style="width: 250px;">
                        @if($data['EducationID'] == null)
                            <option value=''>- Kies een opleiding -</option>
                        @endif
                        @foreach($education as $name)
                            <option value="{{ $name['EducationID'] }}">{{ $name['Name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="profile-score-info" class="no-padding-left col-xs-11 col-sm-12 col-md-12 col-lg-12">
                    <div class="no-padding-left col-xs-4 col-sm-3 col-md-3 col-lg-3">
                        <span class="scoreHeader no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">Connecties</span>
                        <span id="connections" class="score no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">{{ $connections }}</span>
                    </div>
                    <div class="no-padding-left col-xs-4 col-sm-5 col-md-3 col-lg-3">
                        <span class="scoreHeader no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">Stender Score</span>
                        <span id="stenderScore" class="score no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">{{ $stenderScore }}</span>
                    </div>
                    @if( $data['UserProfileID'] !== Session::get('UserProfileID') && $connectionState != true )
                        {{ Form::open(array('url' => 'connect')) }}
                            {{ Form::hidden('user', $data["UserProfileID"], array('type' => 'hidden')) }}
                            {{ Form::hidden('url', $data["ProfileUrlPart"], array('type' => 'hidden')) }}
                            {{ Form::submit('Connect', array('type' => 'button', 'class' => 'btn btn-primary col-xs-offset-1 col-md-offset-4 col-lg-offset-4')) }}
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
                        @if($interests == null)
                            <a href="#">Klik hier om je interesses op te halen van Facebook!</a>
                        @else
                            @foreach ( $interests as $id => $interest )
                                <li><div class="btn-group interest col-lg-12 " id="interest{{ $id }}">
                                    <button type="button" class="btn btn-default btn-sm col-lg-8" ><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> {{ $interest }}</button>
                                    <button type="button" class="btn btn-default btn-sm" ><span href="#" class="times close">&times;</span></button>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div id="experience-block" class="border-right social-media-blocks col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div id="experience-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Vaardigheden</h5>
                </div>
                <div id="experience" class="border-top col-xs-12 col-sm-12 col-md-12 col-lg-12 no-list-signs">
                    <ul>
                        @if($skills == null)
                            <a href="/social?network=linkedin">Klik hier om je vaardigheden op te halen van LinkedIn!</a>
                        @else
                            @foreach ( $skills as $id => $skill )
                                <li><div class="btn-group skill col-lg-12" id="skill{{ $id }}">
                                    <button type="button" class="btn btn-default btn-sm col-lg-8" ><span class="glyphicon glyphicon-wrench"></span> {{ $skill }}</button>
                                    <button type="button" class="btn btn-default btn-sm" ><span href="#" class="times close">&times;</span></button>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div id="hobby-block" class="social-media-blocks col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div id="hobby-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Hashtags</h5>
                </div>
                <div id="hashtags" class="border-top col-xs-12 col-sm-12 col-md-12 col-lg-12 no-list-signs">
                    <ul>
                        @if($hashtags == null)
                            <a href="/social?network=twitter">Klik hier om hashtags op te halen van Twitter!</a>
                        @else
                            @foreach ( $hashtags as $id => $hashtag )
                                <li><div class="btn-group hashtag col-lg-12" id="hashtag{{ $id }}">
                                    <button type="button" class="btn btn-default btn-sm hashtag col-lg-8" ><b>#</b> {{ $hashtag }}</button>
                                    <button type="button" class="btn btn-default btn-sm" ><span class="times close">&times;</span></button>
                                    </div>
                                </li>
                            @endforeach
                        @endif
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
                    @if($reviews == null)
                        <li class="no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            Er zijn nog geen reviews over jou geschreven.
                        </li>
                    @else
                        @foreach ($reviews as $review)
                            <li class="no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <a href="profile/{{ $review[0] }}">{{ $review[1] }}</a> schreef op {{ $review[2] }}:<br/>
                                {{ $review[3] }}
                                @if( $data['UserProfileID'] == Session::get('UserProfileID') || $review[5] == Session::get('UserProfileID') )
                                    <button href="deleteReview/{{ $review[4] }}" class="btn btn-xs btn-danger pull-right">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@stop
