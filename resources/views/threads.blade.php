@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-sm-12 col-md-4 threads-main">
    		<div class="panel panel-default title">
    			<div class="panel-heading">
    				<h3 class="title">Filters</h3>
    			</div>
    			<div class="panel-body">
    				<h5 class="title">Sort By</h5>
		    		<select id="order-by">
					  <option value="1">Newest</option>
					  <option value="2">Alphabetically</option>
					</select>
				</div>
				<div class="panel-body">
    				<h5 class="title">Order By Users</h5>
    				@foreach($listUsers as $user)
    					<input type="checkbox" name="user" value="{{ $user->id }}">{{ $user->username }}<br>
    				@endforeach
    				<button type="submit" id="filter-users" class="btn btn-primary">
                        Filter
                    </button>
				</div>
			</div>
    	</div>
		<div class="col-sm-12 col-md-8 threads-main">
			<div class="panel panel-default">
				<div class="panel-heading main-heading">
					<div class="col-sm-12">
						<h2 class="title">Threads</h2>
					</div>
				</div>
				<div class="thread-container">
					@foreach($threads as $thread)
						@include('threads.thread')
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#order-by").change(function() {
			sortBy($(this).val());
		});

		$("#filter-users").click(function() {
			var selectedUsers = [];

			$('input[type="checkbox"]:checked').each(function () {
		         selectedUsers.push($(this).val());
		    });

			
			if(!jQuery.isEmptyObject(selectedUsers)) {
				filter(selectedUsers);
			} else {
				$(".thread-container").html('');
			}
		});

		function sortBy(value) {
			$.ajax({
				url: "/threads/show",
				type: "post",
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					sortBy: value
				}
			})
			.done(function(data) {
				$(".thread-container").html(data.html);
			})
		}

		function filter(value) {
			$.ajax({
				url: "/threads/show",
				type: "post",
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					filter: value
				}
			})
			.done(function(data) {
				$(".thread-container").html(data.html);
			})
		}
	});
</script>
@endsection