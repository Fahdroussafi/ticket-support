@extends('layouts.app')

@section('title', $ticket->title)

@section('content')
	<div class="row">
		<div class="col-md-7 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					#{{ $ticket->ticket_id }} - {{ $ticket->title }}
				</div>

				<div class="panel-body">
					<div class="ticket-info">
						<p>{{ $ticket->message }}</p>
						<p>Category: {{ $category->name }}</p>
						<p>
						@if ($ticket->status === 'Open')
							Status: <span class="label label-success">{{ $ticket->is_re }}</span>
						@else
							Status: <span class="label label-danger">{{ $ticket->is_resolved }}</span>
						@endif
						</p>
						<p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>
					</div>

					<hr>
					<!-- This will display comments -->
					<div class="comments">
						@foreach ($comments as $comment)
						<div class="panel panel-@if($ticket->user->id === $comment->user_id) {{"default"}}@else{{"success"}}@endif">
							<div class="panel panel-heading">
								{{ $comment->user->name }} <!-- This will display the user name -->
								<span class="pull-right">{{ $comment->created_at->format('d-m-Y H:i') }}</span>
							</div>

							<div class="panel panel-body">
								{{ $comment->comment }}
							</div>
						</div>
						@endforeach
					</div>

					<!-- This will POST the information entered to the CommentsController service. -->
					<div class="comment-form">
						<form action="{{ url('comment') }}" method="POST" class="form">
							{!! csrf_field() !!}

							<input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

							<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
								<textarea rows="10" id="comment" class="form-control" name="comment"></textarea>

								@if ($errors->has('comment'))
									<span class="help-block">
										<strong>{{ $errors->first('comment') }}</strong>
									</span>
								@endif
							</div>
							<div class="form-group">
								@include('includes.flash')
							@if ($ticket->is_resolved === 'Open' || (Auth::user()->is_admin === 1))
								<button type="submit" class="btn btn-primary">Comment</button>
							@else
								<button type="submit" class="btn btn-primary"disabled>Comment</button>
							@endif
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection