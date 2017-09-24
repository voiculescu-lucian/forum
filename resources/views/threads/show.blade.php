@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-sm-12 threads-main">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1>{{ $thread->title }}</h1>
			</div>
			
			<div class="panel-heading">
				{{ $thread->content }}
			</div>
			<div class="panel-body">
				<h3>Replies</h3>

				<ul class="list-group">
				@foreach($thread->comments as $comment)
					<li class="list-group-item">
						<strong>
							{{ $comment->created_at->diffForHumans() }}: 
						</strong>
						{{ $comment->body }}
					</li>
				@endforeach
				</ul>
			</div>
			<div class="panel-body">
				<div class="col-sm-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul style="list-style-type: none">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                @if(session()->has('success'))
	                <div class="alert alert-success">
	                    {{ session()->get('success') }}
	                </div>
	            @endif

                <div class="col-sm-12 col-md-4">
            		<h3 class="title">Leave a reply</h3>
            		<form class="form-horizontal" method="POST" action="/threads/{{ $thread->id }}/comments">
                    	{{ csrf_field() }}
                    	<input type="hidden" name="thread_id" value="{{ $thread->id }}" />

                    	<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
	                        <div class="col-md-12">
	                            <textarea rows="5" id="body" class="form-control" name="body" required>{{ old('body') }}</textarea>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <div class="col-sm-12">
	                            <button type="submit" class="btn btn-primary">
	                                Send
	                            </button>
	                        </div>
	                    </div>
                    </form>
            	</div>
			@if($show == true)
                <div class="col-sm-12 col-md-8">
                	<h3 class="title">Update Thread</h3>
					<form class="form-horizontal" method="POST" action="/threads/{{ $thread->id }}">
	                    {{ csrf_field() }}
	                    <input type="hidden" name="id" value="{{ $thread->id }}" >

	                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	                        <label for="title" class="col-md-3 control-label">Title</label>

	                        <div class="col-sm-12 col-md-9">
	                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

	                            @if ($errors->has('title'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('title') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
	                        <label for="content" class="col-md-3 control-label">Content</label>

	                        <div class="col-sm-12 col-md-9">
	                            <textarea rows="5" id="content" class="form-control" name="content">{{ old('content') }}</textarea>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <div class="col-sm-12 col-md-9 col-md-offset-3">
	                            <button type="submit" class="btn btn-primary">
	                                Save
	                            </button>
	                        </div>
	                    </div>
	                </form>
	                <h3 class="title">Delete this thread</h3>
	                <form class="form-horizontal" method="POST" action="/threads/{{ $thread->id }}/delete">
	                    {{ csrf_field() }}
	                    <input type="hidden" name="id" value="{{ $thread->id }}" >
	                    <div class="form-group">
	                        <div class="col-sm-12 col-md-9 col-md-offset-3">
	                            <button type="submit" class="btn btn-danger">
	                                Delete
	                            </button>
	                        </div>
	                    </div>
	                </form>
	            </div>
			@endif
			</div>
		</div>
	</div>
</div>
@endsection