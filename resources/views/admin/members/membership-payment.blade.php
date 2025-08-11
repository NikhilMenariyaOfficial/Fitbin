<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('members.index') }}">Members</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Membership Payment</li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <section class="row">
        <div class="col-12 col-xl-8">
            <div class="card card-body border-0 shadow mb-4 bg-white ps-3 pe-3">
                <h2 class="h5 mb-4">Pay Pending Membership Fees</h2>
                <form action="{{ route('members.membership.payment.store', ['id' => $member->id]) }}" method="post">
                    @csrf @method('PUT')
                    <fieldset style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                        <legend style="all: revert; font-weight:500">General Information:</legend>
                        <section class="row ps-3">
                            <section class="col-6 bg-transparent">
                                <section class="row">
                                    <div class="col-12 mb-3">
                                        <div class="form-group">
                                            <x-generic-field name="membership_plan_id" label="Membership Plan"
                                                type="select" placeholder="Select Membership Plan" :details="$member">
                                                <option value="" selected disabled> --Select-- </option>
                                                @foreach ($membershipPlans as $index => $plan)
                                                    <option value="{{ $plan->id }}"
                                                        {{ old('membership_plan_id', $member->membership_plan_id) == $plan->id ? 'selected' : '' }}>
                                                        {{ $plan->name }} ({{ $plan->rate }})
                                                    </option>
                                                @endforeach
                                            </x-generic-field>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="form-group">
                                            <x-generic-field type="number" label="Amount" name="amount"
                                                placeholder="Enter Amount"></x-generic-field>
                                        </div>
                                    </div>
                                </section>
                            </section>
                            <section class="col-6 bg-transparent">
                                <section class="h-100 d-flex align-items-center"
                                    style="border-left: dashed 2px rgb(95, 93, 93)">
                                    <section class="ms-2">
                                        <div class="mb-2">
                                            <strong>Total Amount : </strong>
                                            <b>
                                                <span class="fas fa-inr"></span>
                                                <span>{{ $member->membership_fee }}</span>
                                            </b>
                                        </div>
                                        <div class="mb-2">
                                            <strong>Paid Amount : </strong>
                                            <b>
                                                <span class="fas fa-inr"></span>
                                                <span>{{ $member->amount_paid }}</span>
                                            </b>
                                        </div>
                                        <div class="mb-2">
                                            <strong>Due Amount : </strong>
                                            <b>
                                                <span class="fas fa-inr"></span>
                                                <span>{{ $member->pending_amount }}</span>
                                            </b>
                                        </div>
                                    </section>
                                </section>
                            </section>

                            <div class="col-md-8">
                                <button type="submit" class="btn btn-sm btn-gray-800 mt-2 animate-up-2 w-50">
                                    <span class="fa fa-inr me-1"></span>
                                    <span>Submit</span>
                                </button>
                            </div>
                        </section>
                    </fieldset>
                </form>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card shadow border-0 text-center p-0">
                <div class="rounded-top bg-size-cover" style="background-size:100% 100% !important;"
                    data-background="{{ asset('assets/img/gym-black-wallpapers.jpg') }}"></div>
                <div class="card-body pb-5">
                    <img src="{{ asset('assets/img/bodybuilder.gym-black-wallpapers.jpg') }}"
                        class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" alt="Neil Portrait">
                    <h4 class="h3"> {{ $member->name }} </h4>
                    <h5 class="fw-normal"> {{ $member->address }} </h5>
                </div>
            </div>
        </div>

    </section>
</x-layouts.admin>
