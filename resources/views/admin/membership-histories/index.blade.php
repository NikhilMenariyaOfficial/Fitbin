<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('membership-histories.index') }}">
                Membership Histories
            </a>
        </li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Membership Histories</h2>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('membership-histories.create') }}"
                class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                <span>New History</span>
            </a>
        </div>
    </div>

    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-8 d-md-flex">
                <div class="d-flex">
                    <form method="get" action="{{ route('members.index') }}"
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
                        <input class="form-control" type="text" name="search" value="{{ @$search }}"
                            placeholder="Search...">
                    </form>
                    @if (@$search)
                        <a href="{{ route('members.index') }}"
                            class="btn btn-sm btn-gray-800 d-inline-flex align-items-center ps-4 pe-4">
                            <i class="fas fa-times me-2"></i>
                            <span>Clear</span>
                        </a>
                    @endif
                </div>
            </div>

            <div class="col-3 col-lg-4 d-flex justify-content-end">
                <div class="btn-group">
                    <x-table-limit-button :limit="$limit" route="members.index"></x-table-limit-button>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow">
        <section class="card-header pt-2 pb-2">
            <strong><span class="fas fa-table text-primary"></span>
                <span class="ms-2 text-primary">Histories List</span>
            </strong>
        </section>

        <section class="card-body ps-3 pe-3">
            <section class="table-wrapper table-responsive">
                <table class="table table-hover mt-2">
                    <thead class="thead-light">

                        <tr>
                            <th class="border-0 rounded-start">Sr.No</th>
                            <th class="border-0">Member ID</th>
                            <th class="border-0">Member Name</th>
                            <th class="border-0">Membership Plan</th>
                            <th class="border-0">Start Date</th>
                            <th class="border-0">End Date</th>
                            <th class="border-0">Amount</th>
                            <th class="border-0">Due Amount</th>
                            <th class="border-0 rounded-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($histories as $index => $history)
                            <tr>
                                <td class="rounded-start">
                                    <span class="fw-bold text-primary">{{ ++$index }}</span>
                                </td>
                                <td> {{ $history->member->member_id}} </td>
                                <td> {{ $history->member->name }}</td>
                                <td> {{ $history->membershipPlan->name }} </td>
                                <td> {{ date('d F Y', strtotime($history->start_date)) }} </td>
                                <td> {{ date('d F Y', strtotime($history->end_date)) }} </td>
                                <td> {{ $history->amount }} </td>
                                <td> {{ $history->due_amount }} </td>
                                <td class="rounded-end">
                                    <form action="{{ route('membership-histories.destroy', ['id' => $history->id]) }}"  method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn button text-danger rounded-bottom" type="submit">
                                            <span class="fas fa-trash-alt"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <p>No History found.</p>
                        @endforelse
                    </tbody>
                </table>
            </section>
        </section>

        <section class="card-footer">
            <section
                class="ps-0 px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                @if ($paginationAvailable)
                    <nav aria-label="Page navigation example">
                        {{ $histories->links('pagination') }}
                    </nav>
                    <div class="fw-normal small mt-4 mt-lg-0">
                        Showing <b>{{ $histories->firstItem() }}</b> out of <b>{{ $histories->total() }}</b> entries
                    </div>
                @else
                    <div class="fw-normal small mt-4 mt-lg-0">
                        Showing <b>{{ count($histories->toArray()) }}</b> entries
                    </div>
                @endif
            </section>
        </section>
    </div>
</x-layouts.admin>
