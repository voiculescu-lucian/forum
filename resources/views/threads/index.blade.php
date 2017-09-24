<div class="col-sm-12 threads-main">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="title">Threads</h2>
		</div>
		@foreach($threads as $thread)
			@include('threads.thread')
		@endforeach
	</div>
</div>