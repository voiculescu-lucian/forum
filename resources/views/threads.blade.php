@extends('layouts.app')

@section('content')
	<div class="col-sm-12 threads-main">
		@foreach($threads as $thread)
			@include('threads.thread')
		@endforeach
	</div>
@endsection