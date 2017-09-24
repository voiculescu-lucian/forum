<div class="panel-heading">
	<div class="thread">
		<h2>
			<a href="/threads/{{ $thread->id }}">
				{{ $thread->title }}
			</a>
		</h2>
		<p>{{ $thread->created_at->toFormattedDateString() }}</p>
		<div class="content-thread">
			{{ str_limit($thread->content, 75) }}
		</div>
		<a href="/threads/{{ $thread->id }}">Read more...</a>
	</div>
</div>