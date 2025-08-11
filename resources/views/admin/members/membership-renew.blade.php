<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('members.index') }}">Members</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Membership Renewal</li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <section class="row">
        <div class="col-12 col-xl-8">
            <div class="card shadow mt-4">
                <div class="card-header pt-3 pb-2 d-flex">
                    <span><i class="fas fa-sync me-2"></i></span>
                    <p class="m-0 bg-transparent"><b>Renew Membership</b></p>
                </div>
                <div class="card-body bg-transparent ps-3 pe-3">
                    <form action="{{ route('members.membership.renew.store', ['id' => $member->id]) }}" method="post">
                        @csrf @method('PUT')
                        <fieldset style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                            <legend style="all: revert; font-weight:500">General Information:</legend>
                            <section class="row ps-3">

                                <div class="col-md-7 mb-3">
                                    <div class="form-group">
                                        <x-generic-field type="date" label="Renewal Date" name="renewal_date"
                                            placeholder="Select Date" required={{ true }}></x-generic-field>
                                    </div>
                                </div>

                                <div class="col-md-7 mb-3">
                                    <div class="form-group">
                                        <x-generic-field name="membership_plan_id" label="Membership Plan"
                                            type="select" placeholder="Select Membership Plan" :details="$member"
                                            required={{ true }}>
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

                                <div class="col-md-7 mb-3">
                                    <div class="form-group">
                                        <x-generic-field type="number" label="Paid Amount" name="amount"
                                            placeholder="Enter Paid Amount"
                                            required={{ true }}></x-generic-field>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2 w-50">
                                        <span class="fa fa-inr me-1"></span>
                                        <span>Submit</span>
                                    </button>
                                </div>
                            </section>
                        </fieldset>
                    </form>
                </div>
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
