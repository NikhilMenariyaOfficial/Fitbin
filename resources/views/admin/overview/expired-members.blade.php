<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page">Alert</li>
        <li class="breadcrumb-item active" aria-current="page">Expired Membership</li>

    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <title>Casual Fitness</title>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-0">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Expired Membership</h2>
        </div>
    </div>

    <div class="table-settings mt-0 mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-8 d-md-flex">
                <div class="d-flex">
                    <form method="get" action="{{ route('alert.expired-members') }}"
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
                        <a href="{{ route('alert.expired-members') }}"
                            class="btn btn-sm btn-gray-800 d-inline-flex align-items-center ps-4 pe-4">
                            <i class="fas fa-times me-2"></i>
                            <span>Clear</span>
                        </a>
                    @endif
                </div>
            </div>

            <div class="col-3 col-lg-4 d-flex justify-content-end">
                <div class="btn-group">
                    <x-table-limit-button :limit="$limit" route="alert.expired-members"></x-table-limit-button>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mt-4">
        <div class="card-header pt-3 pb-2 d-flex">
            <span><i class="fas fa-table me-2"></i></span>
            <p class="m-0 bg-transparent"><b>Members List</b></p>
        </div>
        <div class="card-body border-0 table-wrapper table-responsive">
            <table class="table table-hover mt-2 bg-transparent">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start">Sr.No</th>
                        <th class="border-0">Name</th>
                        <th class="border-0">Plan Name</th>
                        <th class="border-0">Amount</th>
                        <th class="border-0">Due Amount</th>
                        <th class="border-0">Membership Expire</th>
                        <th class="border-0 rounded-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $index => $member)
                        <tr>
                            <td class="rounded-start">{{ ++$index }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->membershipPlan->name }}</td>
                            <td>{{ $member->membershipPlan->rate }}</td>
                            <td>{{ $member->pending_amount }}</td>
                            <td>{{ $member->membership_end_date }}</td>
                            <td class="rounded-end">
                                <a href="{{ route('members.membership.renew', ['id' => $member->id]) }}"
                                    class="btn btn-sm btn-primary pe-3 ps-3">
                                    <span class="fa fa-inr me-1" aria-hidden="true"></span>
                                    <span>Renew Membership</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center"><b>No member found.</b></td>
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
