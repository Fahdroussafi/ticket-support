@if ($message = Session::get('status'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('closed'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('comment'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
