@extends('layouts.common')
@section('content')
<div id="content" class="container">
    <div class="row">
        <div id="profile" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="up-down-vote" class="col-xs-4 col-sm-2 col-md-1 col-lg-1">
                <button id="vote-up-button" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" />
                <button id="vote-down-button" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" />
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

                <div id="profile-score-info" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <span class="scoreHeader">Connecties</span>
                    <span id="connections" class="score">20</span>
                    <span class="scoreHeader">Stender Score</span>
                    <span id="stenderScore" class="score">+9</span>
                </div>
            </div>
        </div>

        <div id="socialData" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="interest-block" class="social-media-blocks border-right col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div id="interests-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Interests</h5>
                </div>
                <div id="interests" class="border-top col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul>
                        <li>Interests 1</li>
                        <li>Interests 2</li>
                        <li>Interests 3</li>
                        <li>Interests 4</li>
                    </ul>
                </div>
            </div>
            <div id="experience-block" class="border-right social-media-blocks col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div id="experience-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Experience</h5>
                </div>
                <div id="experience" class="border-top col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul>
                        <li>Experience 1</li>
                        <li>Experience 2</li>
                        <li>Experience 3</li>
                        <li>Experience 4</li>
                    </ul>
                </div>
            </div>
            <div id="hobby-block" class="social-media-blocks col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div id="hobby-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Hobby</h5>
                </div>
                <div id="hobby" class="border-top col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul>
                        <li>Hobby 1</li>
                        <li>Hobby 2</li>
                        <li>Hobby 3</li>
                        <li>Hobby 4</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="reviews" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="review-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h5>Reviews</h5>
            </div>
            <div id="review-list" class="border-top col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul>
                    <li>Review 1</li>
                    <li>Review 2</li>
                    <li>Review 3</li>
                    <li>Review 4</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop
