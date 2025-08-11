<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page">Membership Plans</li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4"> Membership Plans</h2>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('membership-plans.create') }}"
                class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                New Plan
            </a>
        </div>
    </div>

    <div class="table-settings mb-4"><div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-8 d-md-flex"><div class="d-flex">
                <form method="get" action="{{ route('membership-plans.index') }}"
                    class="input-group me-2 me-lg-3 fmxw-300">
                    <a class="input-group-text" type="submit">
                        <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <input class="form-control" type="text" name="search" value="{{ $search }}"
                        placeholder="Search...">
                </form>
                @if ($search)
                    <a href="{{ route('membership-plans.index') }}"
                        class="btn btn-sm btn-gray-800 d-inline-flex align-items-center ps-4 pe-4">
                        <i class="fas fa-times me-2"></i>
                        <span>Clear</span>
                    </a>
                @endif
            </div></div>

            <div class="col-3 col-lg-4 d-flex justify-content-end"><div class="btn-group">
                <x-table-limit-button :limit="$limit" route="members.index"></x-table-limit-button>
            </div></div>
    </div></div>

    <div class="card border-0 shadow">
        <section class="card-header pt-2 pb-2">
            <strong>
                <span class="fas fa-table text-primary"></span>
                <span class="ms-2 text-primary">Membership Plans List</span>
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
                        @forelse ($plans as $index => $plan)
                            <tr>
                                <td>
                                    <span class="fw-bold text-primary">{{ ++$index }}</span>
                                </td>
                                <td>
                                    <a href={{ route('membership-plans.show',$plan->id) }}><b>{{ $plan->name }}</b></a>
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
                                                href={{ route('membership-plans.show',$plan->id) }}>
                                                <span class="fas fa-eye"></span>
                                                <span class="fw-bold">View Details</span>
                                            </a>
                                            <a class="dropdown-item"
                                                href={{ route('membership-plans.edit',$plan->id) }}>
                                                <span class="fas fa-edit"></span>
                                                <span class="fw-bold">Edit</span>
                                            </a>
                                            <form
                                                action="{{ route('membership-plans.destroy',$plan->id) }}"
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
                            <p>No plan found.</p>
                        @endforelse
                    </tbody>
                </table>
            </section>
        </section>

        <section class="card-footer">
            <section class="ps-0 px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                <nav aria-label="Page navigation example">
                    {{ $plans->appends(['search' => $search,'limit'=> $limit])->links('pagination') }}
                </nav>
                <div class="fw-normal small mt-4 mt-lg-0">
                    Showing <b>{{ $plans->firstItem() }}</b> out of <b>{{ $plans->total() }}</b> entries
                </div>
            </section>
        </section>
    </div>
</x-layouts.admin>
