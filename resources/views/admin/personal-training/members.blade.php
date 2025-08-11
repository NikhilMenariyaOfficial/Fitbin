<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('members.index') }}">Members</a></li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Members List</h2>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('members.export') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center me-2">
                <svg class="icon icon-xs me-2" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 48 48">
                    <path fill="#169154" d="M29,6H15.744C14.781,6,14,6.781,14,7.744v7.259h15V6z"></path><path fill="#18482a" d="M14,33.054v7.202C14,41.219,14.781,42,15.743,42H29v-8.946H14z"></path><path fill="#0c8045" d="M14 15.003H29V24.005000000000003H14z"></path><path fill="#17472a" d="M14 24.005H29V33.055H14z"></path><g><path fill="#29c27f" d="M42.256,6H29v9.003h15V7.744C44,6.781,43.219,6,42.256,6z"></path><path fill="#27663f" d="M29,33.054V42h13.257C43.219,42,44,41.219,44,40.257v-7.202H29z"></path><path fill="#19ac65" d="M29 15.003H44V24.005000000000003H29z"></path><path fill="#129652" d="M29 24.005H44V33.055H29z"></path></g><path fill="#0c7238" d="M22.319,34H5.681C4.753,34,4,33.247,4,32.319V15.681C4,14.753,4.753,14,5.681,14h16.638 C23.247,14,24,14.753,24,15.681v16.638C24,33.247,23.247,34,22.319,34z"></path><path fill="#fff" d="M9.807 19L12.193 19 14.129 22.754 16.175 19 18.404 19 15.333 24 18.474 29 16.123 29 14.013 25.07 11.912 29 9.526 29 12.719 23.982z"></path>
                </svg>
                <span>Export</span>
            </a>

            <a href="{{ route('members.create') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                <span>New Member</span>
            </a>
        </div>
    </div>

    <div class="table-settings mb-4"><div class="row justify-content-between align-items-center">
        <div class="col-9 col-lg-8 d-md-flex"><div class="d-flex">
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
                <input class="form-control" type="text" name="search" value="{{ $search }}" style="border-radius:0rem 0.5rem 0.5rem 0rem;"
                    placeholder="Search...">
                <input type="hidden" name="limit" value="{{$limit}}">
            </form>
            @if ($search)
                <a href="{{ route('members.index') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center ps-4 pe-4">
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
            <strong><span class="fas fa-table text-primary"></span>
                <span class="ms-2 text-primary">Members List with Personal Training Profiles</span>
            </strong>
        </section>

        <section class="card-body ps-3 pe-3">
            <section class="table-wrapper table-responsive">
                <table class="table table-hover mt-2">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">Sr.No</th>
                            <th class="border-0">Name</th>
                            <th class="border-0">Member id</th>
                            <th class="border-0">Joining Date</th>
                            <th class="border-0">Membership</th>
                            <th class="border-0">Expire Date</th>
                            <th class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($members as $index => $member)
                            <tr>
                                <td class="rounded-start">
                                    <span class="fw-bold text-primary">{{ ++$index }}</span>
                                </td>
                                <td>
                                    <a href={{ route('members.show', ['id' => $member->id]) }}><b>{{ $member->name }}</b></a>
                                </td>
                                <td> {{ $member->member_id }} </td>
                                <td> {{ date('d F Y', strtotime($member->membership_start_date)) }} </td>
                                <td> {{ $member->membershipPlan->name }} </td>
                                <td> {{ date('d F Y', strtotime($member->membership_end_date)) }} </td>
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
                                                href={{ route('members.show', ['id' => $member->id]) }}>
                                                <span class="fas fa-eye"></span>
                                                <span class="fw-bold">View Details</span>
                                            </a>
                                            <a class="dropdown-item"
                                                href={{ route('members.edit', ['id' => $member->id]) }}>
                                                <span class="fas fa-edit"></span>
                                                <span class="fw-bold">Edit</span>
                                            </a>
                                            <form action="{{ route('members.destroy', ['id' => $member->id]) }}"
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
                            <p>No members found.</p>
                        @endforelse
                    </tbody>
                </table>
            </section>
        </section>

        <section class="card-footer">
            <section class="ps-0 px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                <nav aria-label="Page navigation example">
                    {{ $members->appends(['search' => $search,'limit'=> $limit])->links('pagination') }}
                </nav>
                <div class="fw-normal small mt-4 mt-lg-0">
                    Showing <b>{{ $members->firstItem() }}</b> out of <b>{{ $members->total() }}</b> entries
                </div>
            </section>
        </section>
    </div>
</x-layouts.admin>
