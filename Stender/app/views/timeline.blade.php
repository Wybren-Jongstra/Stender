@extends('layouts.common')
@section('content')
<div id="content" class="container">
    <div class="row">
        <div id="left-column" class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
            <h1>Welkom {{ $data['firstname'] }}</h1>
            <p>
                Verbind met je klasgenoten - studiegenoten - en andere medestudenten. Ontvang updates over jou interesses.
                Bekijk met wie jij naar een studenten feest wilt.

            </p>
        </div>
        <div id="right-column" class="col-xs-12 col-sm-12 col-md-5 col-lg-5">

        </div>
    </div>
</div>
@stop
