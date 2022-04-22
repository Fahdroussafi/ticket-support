@extends('layouts.app')

@section('title', 'All Users')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-ticket">Users</i>
				</div>

				<div class="panel-body">
					@if ($users->isEmpty())
						<p>There are currently no users.</p>
					@else
						<table class="table">
							@include('includes.flash')
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th style="text-align:center" colspan="2">Actions</th>
								</tr>
							</thead>
							<tbody>
                                @foreach ($users as $user)
                                @if ($user->is_admin == 0)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                        
                                    <td style="text-align:center">
                                        <form action="{{ url('/admin/users', ['id'=> $user->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
							@endforeach
							</tbody>
						</table>

						{{ $users->render() }}
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection