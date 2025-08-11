<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page">Reports</li>
        <li class="breadcrumb-item active" aria-current="page">Members</li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="card shadow mt-4">
        <div class="card-header pt-0 pb-2 d-flex justify-content-between">
            <section class="d-flex mt-3">
                <span><i class="fas fa-table me-2"></i></span>
                <p class="m-0 bg-transparent"><b>Attendance of {{ date('M') }} </b></p> 
            </section>
            <section>
                <x-table-limit-button :limit="@$limit" route="reports.attendance-reports"></x-table-limit-button>
            </section>
        </div>

        <div class="card-body border-0 table-wrapper table-responsive">
            <table class="table table-hover mt-2 bg-transparent">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start">Sr.No</th>
                        <th class="border-0">Member Name</th>
                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            @php $isSunday = date('N', strtotime(date('Y-m') . '-' . $day)) == 7; @endphp

                            @if ($day == $daysInMonth)
                                <th class="border-0 rounded-end">{{ $isSunday ? 'sunday' : $day }} </th>
                            @else
                                <th class="border-0">{{ $isSunday ? 'sunday' : $day }}</th>
                            @endif
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $index => $member)
                        <tr>
                            <td>{{ ++$index }} </td>
                            <td>{{ $member->name }}</td>
                            @foreach ($member->attendance as $attendance)
                                <td>{{ $attendance['status'] }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <section class="mt-3 ps-0 px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                {{-- <nav aria-label="Page navigation example">
                    {{ $members->links('pagination') }}
                </nav>
                <div class="fw-normal small mt-4 mt-lg-0">
                    Showing <b>{{ $members->firstItem() }}</b> out of <b>{{ $members->total() }}</b> entries
                </div> --}}
            </section>
        </div>
    </div>
</x-layouts.admin>
