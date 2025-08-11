<link rel="icon" href="{{ asset('assets/img/' . $favicon) }}" type="image/x-icon">
<title>{{ $title }}</title>

<div class="py-3">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item rounded"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
            {{ $slot }}
        </ol>
    </nav>
</div>
