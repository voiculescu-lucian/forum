<div class="panel-heading">
	<div class="thread">
		<h2>
			<a href="/threads/{{ $thread->id }}">
				{{ $thread->title }}
			</a>
		</h2>
		<p>{{ $thread->created_at->toFormattedDateString() }}</p>
		<div class="content-thread">
			{{ $thread->content }}
		</div>
	</div>
</div>