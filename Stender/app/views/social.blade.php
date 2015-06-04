@extends('layouts.common')
@section('custom-jquery')
$(".delete").click(function(){
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

@endsection
@section('content')
<div id="content" class="container">
    <div class="row">
        <div id="profile" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
            
                @foreach($twitter as $tweet)
                <div class="btn-group delete" id="{{ $tweet['HashtagID'] }}">
                    <button type="button" class="btn btn-default btn-sm" >{{ $tweet['Value'] }}</button>
                    <button type="button" class="btn btn-default btn-sm" ><span href="#" class="times close">&times;</span></button>
                </div>
                
                @endforeach
            
        </div>

        
    </div>
</div>
@stop
