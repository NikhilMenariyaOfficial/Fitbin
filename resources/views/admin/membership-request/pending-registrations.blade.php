<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page">Membership Requests</li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4"> Membership Requests</h2>
        </div>
    </div>

    <div class="card border-0 shadow mt-2">
        <section class="card-header pt-2 pb-2">
            <strong>
                <span class="fas fa-table text-primary"></span>
                <span class="ms-2 text-primary">Membership Requests List</span>
            </strong>
        </section>

        <section class="card-body ps-3 pe-3">
            <section class="table-wrapper table-responsive">
                <table class="table table-hover mt-2">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">Sr.No</th>
                            <th class="border-0">Name</th>
                            <th class="border-0">Rate</th>
                            <th class="border-0">Validity (Days)</th>
                            <th class="border-0">Details</th>
                            <th class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($plans ?? [] as $index => $plan)
                            <tr>
                                <td>
                                    <span class="fw-bold text-primary">{{ ++$index }}</span>
                                </td>
                                <td>
                                    <a
                                        href={{ route('membership-plans.show', $plan->id) }}><b>{{ $plan->name }}</b></a>
                                </td>
                                <td> {{ $plan->rate }} </td>
                                <td> {{ $plan->validity }} </td>
                                <td>
                                    <span class="text-wrap">{{ $plan->details }}</span>
                                </td>
                                <td class="rounded-end">
                                    <div class="btn-group position-static">
                                        <button
                                            class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-2"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="icon icon-sm">
                                                <span class="fas fa-ellipsis-h icon-dark"></span>
                                            </span>
                                            <span class="visually-hidden">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu py-0">
                                            <a class="dropdown-item rounded-top"
                                                href={{ route('membership-plans.show', $plan->id) }}>
                                                <span class="fas fa-eye"></span>
                                                <span class="fw-bold">View Details</span>
                                            </a>
                                            <a class="dropdown-item"
                                                href={{ route('membership-plans.edit', $plan->id) }}>
                                                <span class="fas fa-edit"></span>
                                                <span class="fw-bold">Edit</span>
                                            </a>
                                            <form action="{{ route('membership-plans.destroy', $plan->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item text-danger rounded-bottom" type="submit">
                                                    <span class="fas fa-trash-alt"></span>
                                                    <span class="fw-bold">Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <p>No pending request.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </section>
        </section>

        <section class="card-footer">
            <section
                class="ps-0 px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                <nav aria-label="Page navigation example">
                </nav>
                <div class="fw-normal small mt-4 mt-lg-0">
                </div>
            </section>
        </section>
    </div>
</x-layouts.admin>
