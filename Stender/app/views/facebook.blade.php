@extends('layouts.common')
@section('content')
<div id="content" class="container">
	<img src="{{ $fb->photoURL }}">
	{{ $fb->firstName }}
	{{ $fb->lastName }}
</div>
@stop