@if ($message = session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="close flex justify-self-end justify-content-end" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
</div>
@endif

@if ($message = session('error'))
<div class="alert alert-danger alert-dismissible fade show">
	<button type="button" class="close" data-bs-dismiss="alert"><i class="fa fa-close"></i></button>
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = session('warning'))
<div class="alert alert-warning alert-dismissible fade show">
	<button type="button" class="close" data-bs-dismiss="alert">X</button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = session('info'))
<div class="alert alert-info alert-dismissible fade show">
	<button type="button" class="close" data-bs-dismiss="alert">X</button>
	<strong>{{ $message }}</strong>
</div>
@endif
