<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('membership-plans.index') }}">Membership Plans</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Membership Plan Details</li>
        </li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="card border-0 shadow components-section">
        <div class="card-header ps-4 pt-3 pb-1">
            <h6>Membership Plan Details</h6>
        </div>
        <div class="card-body pt-3 ps-3">
            <div>
                <p><strong>Plan ID:</strong> {{ $plan->id }}</p>
                <p><strong>Name:</strong> {{ $plan->name }}</p>
                <p><strong>Rate:</strong> {{ $plan->rate }}</p>
                <p><strong>Validity (Days):</strong> {{ $plan->validity }}</p>
                <p><strong>Details:</strong> {{ $plan->details }}</p>
            </div>

            <div class="mt-3 d-flex bg-transparent">
                <a href="{{ route('membership-plans.index') }}" class="btn btn-sm btn-primary ps-4 pe-4 me-2">
                    <span class="fa fa-arrow-left me-2"></span>
                    <span class="fw-bold">Back</span>
                </a>
                <a href="{{ route('membership-plans.edit',$plan->id) }}"
                    class="btn btn-sm btn-primary ps-4 pe-4 me-2">
                    <span class="fas fa-edit me-2"></span>
                    <span class="fw-bold">Edit</span>
                </a>
                <form action="{{ route('membership-plans.destroy',$plan->id) }}" method="post">
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
