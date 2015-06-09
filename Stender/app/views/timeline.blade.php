@extends('layouts.common')
@section('custom-jquery')
$('#image').hide();
$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
    var input = $(this).parents('.input-group').find(':text'),
        log = numFiles > 1 ? numFiles + ' files selected' : label;

    if( input.length ) {
        input.val(log);
    }
    else {
        if( log ) {
            $('#image').val(log);
            $('#image').show();
            //$('#image').css('display', 'inline-block');
        }
    }

});
$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});
@endsection
@section('content')
<div id="content" class="container">
    <div class="row">
        <div id="left-column" class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
            <div id="timeline-profile" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @if( empty($data['PhotoUrl']) )
                        <img src="{{ URL::to('uploads/default_profile_picture.png') }}" class="profile-image col-xs-4 col-sm-12 col-md-12 col-lg-12" />
                    @else
                        <img src="{{ URL::to('uploads/'.$data['PhotoUrl']) }}" class="profile-image col-xs-4 col-sm-12 col-md-12 col-lg-12" />
                    @endif
                <div class="clearfix"></div>
                <h3 class="col-xs-8 col-sm-12 col-md-12 col-lg-12">{{ $userProfile['DisplayName'] }}</h3>
                <div class="clearfix"></div>
                <div class="no-padding-left col-xs-4 col-sm-5 col-md-5 col-lg-5">
                    <span class="scoreHeader col-xs-12 col-sm-12 col-md-12 col-lg-12">Connecties</span>
                    <span id="connections" class="score col-xs-12 col-sm-12 col-md-12 col-lg-12">{{ $connections }}</span>
                </div>
                <div class="no-padding-left col-xs-4 col-sm-7 col-md-7 col-lg-7">
                    <span class="scoreHeader col-xs-12 col-sm-12 col-md-12 col-lg-12">Stender Score</span>
                    <span id="stenderScore" class="score col-xs-12 col-sm-12 col-md-12 col-lg-12">{{ $stenderScore }}</span>
                </div>
            </div>

            <div id="connections" class="hidden-xs spacing-top rounded-div-border col-sm-12 col-md-12 col-lg-12">
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
                @if($errors->any())
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        {{ implode('', $errors->all(':message'))}}
                    </div>
                @endif
                {{ Form::open(array('url' => 'postStatus', 'files'=> true)) }}
                    {{ Form::textarea('userStatus', '', array('class' => 'form-control', 'rows' => '3', 'placeholder' => 'Wat ben je aan het doen?')) }}
                    {{ Form::text('image', '', array('id' => 'image', 'class' => 'form-control', 'readonly' => 'readonly')) }}
                    <div class="btn-group no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12" role="group">
                        <span class="btn btn-default btn-file btn col-xs-4 col-sm-2 col-md-2 col-lg-2">
                            Browse {{ Form::file('statusImage', '', array('class' => 'col-xs-4 col-sm-2 col-md-4 col-lg-2', 'value' => 'Browse')) }}
                        </span>
                        {{ Form::submit('Plaats status', array('type' => 'button', 'class' => 'btn btn-success col-xs-4 col-sm-4 col-md-2 col-lg-2')) }}
                    </div>
                {{ Form::close() }}
            </div>

            @foreach ($statusUpdates as $statusUpdate)
                <div id="timeline" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a href="profile/{{ TimelineController::getUserProfileByUserID($statusUpdate['UserID'])['ProfileUrlPart'] }}">
                            {{ TimelineController::getUserProfileByUserID($statusUpdate['UserID'])['DisplayName'] }}
                        </a>
                        @if( $statusUpdate['UserID'] == Session::get('UserProfileID') )
                            <a href="deleteStatus/{{ $statusUpdate['StatusUpdateID'] }}" class="delete-btn btn btn-xs btn-danger pull-right">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        @endif
                        <span class="time-ago no-padding-left col-xs-12 col-sm-12 col-md-12 col-lg-12">{{ TimelineController::getTimeAgo($statusUpdate->DateCreated) }}</span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        {{ $statusUpdate['Text'] }}
                    </div>
                    @if( !empty($statusUpdate['ImageUrlPart']) )
                        <div class="status-update-image col-xs-offset-3 col-xs-6 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6">
                            <img src="{{ $statusUpdate['ImageUrlPart'] }}" />
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop
