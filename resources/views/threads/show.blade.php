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
			@if($show == true)
				<div class="panel-body">
					<h3 class="title">Update Thread</h3>
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

					<form class="form-horizontal" method="POST" action="/threads/{{ $thread->id }}">
	                    {{ csrf_field() }}
	                    <input type="hidden" name="id" value="{{ $thread->id }}" >

	                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
	                        <label for="title" class="col-md-4 control-label">Title</label>

	                        <div class="col-md-6">
	                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

	                            @if ($errors->has('title'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('title') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
	                        <label for="content" class="col-md-4 control-label">Content</label>

	                        <div class="col-md-6">
	                            <textarea rows="5" id="content" class="form-control" name="content">{{ old('content') }}</textarea>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <div class="col-md-6 col-md-offset-4">
	                            <button type="submit" class="btn btn-primary">
	                                Save
	                            </button>
	                        </div>
	                    </div>
	                </form>

	                <form class="form-horizontal" method="POST" action="/threads/{{ $thread->id }}/delete">
	                    {{ csrf_field() }}
	                    <input type="hidden" name="id" value="{{ $thread->id }}" >
	                    <div class="form-group">
	                        <div class="col-md-6 col-md-offset-4">
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
@endsection