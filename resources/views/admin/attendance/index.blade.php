<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('attendance.index') }}">Attendance</a>
        </li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="card border-0 shadow table-wrapper table-responsive">
        <div class="card-header ps-4 pt-3 pb-1 bg-transparent">
            <h6>
                <span class="fas fa-clipboard-list"></span>
                <span>&nbsp;&nbsp;Take Attendance</span>
            </h6>
        </div>

        <div class="card-body pt-3 ps-3 ms-1 me-1">
            <form method="get" action="{{ route('attendance.index') }}">
                <fieldset style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                    <legend style="all: revert; font-weight:500">General Information:</legend>
                    <section class="row mt-2 ms-1">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="mb-3">
                                <label for="attendance_date">Choose Date</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                    <input class="form-control datepicker-input" value="{{ $date }}"
                                        id="attendance_date" name="attendance_date" type="date"
                                        placeholder="dd/mm/yyyy" required="">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="mb-3">
                                <label for="member_search">Member Name</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2">
                                        <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" id="member_search" name="member_search"
                                        placeholder="Search" aria-label="Search">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-block btn-sm btn-gray-800"
                                    style="margin-top:30px">
                                    <span class="fas fa-search me-2"></span>
                                    <span class="me-2">Search</span>
                                </button>
                            </div>
                        </div>
                    </section>
                </fieldset>
            </form>
            <form method="post" action="{{ route('attendance.store') }}">
                @csrf @method('POST')
                <fieldset class="mt-3" style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                    <legend style="all: revert; font-weight:500">Members List:</legend>
                    <input type="hidden" name="attendance_date" value="{{ $date }}">
                    <table class="table table-hover mt-2">
                        <thead class="thead-light">
                            <th class="border-0 rounded-start">Attendance Status</th>
                            <th class="border-0">Name</th>
                            <th class="border-0">Member Id</th>
                            <th class="border-0">Membership Start Date</th>
                            <th class="border-0 rounded-end">Membership End Date</th>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td class="rounded-start">
                                        <div class="d-flex justify-content-between">
                                            <div class="form-check me-2">
                                                <input name="attendance[{{ $member->id }}]" class="form-check-input"
                                                    type="radio" name="exampleRadios" id="exampleRadios1"
                                                    value="PRESENT" checked>
                                                <label class="form-check-label" for="exampleRadios1">Present</label>
                                            </div>
                                            <div class="form-check ms-2">
                                                <input name="attendance[{{ $member->id }}]" class="form-check-input"
                                                    type="radio" name="exampleRadios" id="exampleRadios2"
                                                    value="ABSENT">
                                                <label class="form-check-label" for="exampleRadios2">Absent</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->id }}</td>
                                    <td>{{ $member->membership_start_date }}</td>
                                    <td class="rounded-end">{{ $member->membership_end_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </fieldset>

                <div class="col-md-3 mt-1">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-sm btn-gray-800 w-100 ps-5 pe-5"
                            style="margin-top:30px">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
