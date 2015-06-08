@extends('layouts.common')
@section('custom-jquery')
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

@endsection
@section('content')
<div id="content" class="container">
    <div class="row">
        <div id="profile" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1>HashTags</h1>
                @foreach($twitter as $tweet)
                <div class="btn-group hashtag" id="{{ $tweet['HashtagID'] }}">
                    <button type="button" class="btn btn-default btn-sm" >{{ $tweet['Value'] }}</button>
                    <button type="button" class="btn btn-default btn-sm" ><span href="#" class="times close">&times;</span></button>
                </div>
                
                @endforeach
        </div>

        <div id="profile" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1>Skills</h1>
                @foreach($linkedin as $skill)
                <div class="btn-group skill" id="{{ $skill['SkillID'] }}">
                    <button type="button" class="btn btn-default btn-sm" >{{ $skill['Value'] }}</button>
                    <button type="button" class="btn btn-default btn-sm" ><span href="#" class="times close">&times;</span></button>
                </div>
                
                @endforeach
        </div>

        
    </div>
</div>
@stop
