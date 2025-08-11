@if (session('success'))
    <div class="alert alert-success pt-1 pb-1">{{ session('success') }}</div>
@endif

@if (session('warning'))
    <div class="alert alert-warning pt-1 pb-1">{{ session('warning') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger pt-1 pb-1">{{ session('error') }}</div>
@endif
