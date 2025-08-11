<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('members.index') }}">Members</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Member Details</li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="card border-0 shadow components-section">
        <div class="card-header ps-4 pt-3 pb-1">
            <h6>Member Details</h6>
        </div>
        <div class="card-body pt-3 ps-3">
            <div>
                <p><strong class="text-primary">Member ID:</strong> {{ $member->member_id }}</p>
                <p><strong class="text-primary">Name:</strong> {{ $member->name }}</p>
                <p><strong class="text-primary">Gender:</strong> {{ $member->gender }}</p>
                <p><strong class="text-primary">Age:</strong> {{ $member->age }}</p>
                <p><strong class="text-primary">Contact Number:</strong> {{ $member->contact_number }}</p>
                <p><strong class="text-primary">Email:</strong> {{ $member->email }}</p>
                <p><strong class="text-primary">Joining Date:</strong> {{ $member->joining_date }}</p>
                <p><strong class="text-primary">Personal Training:</strong> {{ $member->is_personal_training }}</p>
                <p><strong class="text-primary">Address:</strong> {{ $member->address }}</p>
            </div>

            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">#</th>
                            <th class="border-0">Plan Name</th>
                            <th class="border-0">Amount</th>
                            <th class="border-0">Paid Amount</th>
                            <th class="border-0">Due Amount</th>
                            <th class="border-0 rounded-end">Payment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($member->payments as $index => $payment)
                            <tr>
                                <td class="rounded-start"> {{ ++$index }} </td>
                                <td> {{ $payment->membershipPlan->name }} </td>
                                <td> {{ $payment->membershipPlan->rate }} </td>
                                <td> {{ $payment->amount }} </td>
                                <td> {{ $payment->membershipPlan->rate - $payment->amount }} </td>
                                <td class="rounded-end">{{ $payment->payment_date }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="7">No Records Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex bg-transparent">
                <a href="{{ route('members.index') }}" class="btn btn-sm btn-primary ps-4 pe-4 me-2">
                    <span class="fa fa-arrow-left me-2"></span>
                    <span class="fw-bold">Back</span>
                </a>
                <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm btn-primary ps-4 pe-4 me-2">
                    <span class="fas fa-edit me-2"></span>
                    <span class="fw-bold">Edit</span>
                </a>
                <form action="{{ route('members.destroy', ['id' => $member->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger ps-4 pe-4 me-2" type="submit">
                        <span class="fas fa-trash me-2"></span>
                        <span class="fw-bold">Delete</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
