<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('personal-training.index') }}">Personal Training</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Personal Training Details</li>
        </li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="card border-0 shadow components-section">
        <div class="card-header ps-4 pt-3 pb-1">
            <h6>Personal Training Details</h6>
        </div>
        <div class="card-body pt-3 ps-3">
            <div>
                <p><strong class="text-primary">Plan ID:</strong> {{ $plan->id }}</p>
                <p><strong class="text-primary">Name:</strong> {{ $plan->name }}</p>
                <p><strong class="text-primary">Rate:</strong> {{ $plan->rate }}</p>
                <p><strong class="text-primary">Validity (Days):</strong> {{ $plan->validity }}</p>
                <p><strong class="text-primary">Details:</strong> {{ $plan->details }}</p>
            </div>

            <div class="mt-3 d-flex bg-transparent">
                <a href="{{ route('personal-training.index') }}" class="btn btn-sm btn-primary ps-4 pe-4 me-2">
                    <span class="fa fa-arrow-left me-2"></span>
                    <span class="fw-bold">Back</span>
                </a>
                <a href="{{ route('personal-training.edit', ['id' => $plan->id]) }}"
                    class="btn btn-sm btn-primary ps-4 pe-4 me-2">
                    <span class="fas fa-edit me-2"></span>
                    <span class="fw-bold">Edit</span>
                </a>
                <form action="{{ route('personal-training.destroy', ['id' => $plan->id]) }}" method="post">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger ps-4 pe-4 me-2" type="submit">
                        <span class="fas fa-trash me-2"></span>
                        <span class="fw-bold">Delete</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
