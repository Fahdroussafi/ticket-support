@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>

				<div class="panel-body">
					
					<p>You are logged in!</p>

					@if (Auth::user()->is_admin)
						<p>
							See all <a href="{{ url('admin/tickets') }}">tickets</a>
						</p>
						<p>
							Add <a href="{{ url('/admin/add_category') }}">categories</a>
						<p>
							See all <a href="{{ url('/admin/users') }}">Users</a>
						</p>
						</p>
					@else
						<p>
							See all your <a href="{{ url('my_tickets') }}">tickets</a> or <a href="{{ route('newticket') }}">open new ticket</a>
						</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection