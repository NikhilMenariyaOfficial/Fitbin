<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page">Overview</li>
        <li class="breadcrumb-item active" aria-current="page">Members</li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="card border-0 shadow mt-0">
        <div class="card-header pt-3 pb-2 d-flex">
            <span><i class="fas fa-table me-2"></i></span>
            <p class="m-0 bg-transparent"><b>&nbsp;Members Overview</b></p>
        </div>
        <form action="{{ route('overview.members') }}" method="GET" class="card-body pt-3 ps-3 row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="mb-3">
                    <label for="fromDate">Date From:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <input class="form-control datepicker-input" id="fromDate" name="fromDate"
                            value="{{ $fromDate }}" type="date" placeholder="dd/mm/yyyy" required="">
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="mb-3">
                    <label for="toDate">Date To:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <input class="form-control datepicker-input" id="toDate" name="toDate"
                            value="{{ $toDate }}" type="date" placeholder="dd/mm/yyyy" required="">
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="mb-3">
                    <label for="exampleInputIconRight">Member Name</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon2">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <input type="text" class="form-control" name="search" value="{{ $search }}"
                            id="exampleInputIconRight" placeholder="Search" aria-label="Search">
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="mb-3">
                    <button type="submit" class="btn btn-block btn-sm btn-gray-800" style="margin-top:30px">
                        <span class="fas fa-search me-2"></span>
                        <span class="me-2">Search</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="card shadow mt-4">
        <div class="card-header pt-0 pb-2 d-flex justify-content-between">
            <section class="d-flex mt-3">
                <span><i class="fas fa-table me-2"></i></span>
                <p class="m-0 bg-transparent">
                    <b>New members joined between {{ $fromDate }} To {{ $toDate }}</b>
                </p>
            </section>
            <section>
                <x-table-limit-button :limit="$limit" route="overview.members"></x-table-limit-button>
            </section>
        </div>
        <div class="card-body border-0 table-wrapper table-responsive">
            <table class="table table-hover mt-2 bg-transparent">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start">Sr.No</th>
                        <th class="border-0">Name</th>
                        <th class="border-0">Member Id</th>
                        <th class="border-0">Age</th>
                        <th class="border-0">Gender</th>
                        <th class="border-0 rounded-end">Joined On</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $index => $member)
                        <tr>
                            <td class="rounded-start">{{ ++$index }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->member_id }}</td>
                            <td>{{ $member->age }}</td>
                            <td>{{ $member->gender }}</td>
                            <td class="rounded-end">{{ $member->membership_end_date }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center"><b>No member found.</b></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <section
                class="mt-3 ps-0 px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                <nav aria-label="Page navigation example">
                    {{ $members->links('pagination') }}
                </nav>
                <div class="fw-normal small mt-4 mt-lg-0">
                    Showing <b>{{ $members->firstItem() }}</b> out of <b>{{ $members->total() }}</b> entries
                </div>
            </section>
        </div>
    </div>
</x-layouts.admin>
