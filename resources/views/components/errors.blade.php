@props(['errors'])
@php $noneValidationErrors = true; @endphp

@if ($errors->any())
    @foreach ($errors->all() as $error)
        @if (!Str::startsWith($error, 'validation.'))
            @php $noneValidationErrors = false ; @endphp
        @endif
    @endforeach

    @if ($noneValidationErrors)
        <div class="alert alert-danger pt-1 pb-1">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endif
