<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="row">
        <div class="col-12 col-xl-8">
            <div class="card  border-0 shadow mb-4">
                <div class="card-header ps-4 pt-2 pb-0 bg-transparent">
                    <h6>General information </h6>
                </div>
                <div class="card-body p-2">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf @method('POST')
                        <fieldset style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                            <legend style="all: revert; font-weight:500">Details:</legend>
                            <div class="row mt-2 ps-2 pe-2 mb-3">

                                <div class="col-md-6 mb-1">
                                    <div class="form-group">
                                        <x-generic-field name="first_name" class="form-control" label="First Name"
                                            type="text" placeholder="Enter your first name" :details="$userDetails"
                                            required={{ true }} />
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <x-generic-field name="last_name" class="form-control" label="Last Name"
                                            type="text" placeholder="Also your last name" :details="$userDetails"
                                            required={{ true }} />
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <x-generic-field name="email" class="form-control " label="Email"
                                            type="email" placeholder="name@company.com" :details="$userDetails"
                                            required={{ true }} />
                                    </div>
                                </div>

                                <div class="col-md-6 mb-1">
                                    <div class="form-group">
                                        <x-generic-field name="gender" class="form-select" label="Gender"
                                            type="select" :details="$userDetails" required={{ true }}>
                                            <option {{ $userDetails->gender == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                                            <option {{ $userDetails->gender == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                        </x-generic-field>
                                    </div>
                                </div>
                                <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <x-generic-field name="address" class="form-control" label="Address"
                                            type="text" placeholder="Enter your home address" :details="$userDetails"
                                            required={{ false }} />
                                    </div>
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <div class="form-group">
                                        <x-generic-field name="number" class="form-control" label="Number"
                                            :details="$userDetails" type="number" placeholder="No."
                                            required={{ false }} />
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <div class="form-group">
                                        <x-generic-field name="city" class="form-control " label="City"
                                            :details="$userDetails" type="text" placeholder="City"
                                            required={{ false }} />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-generic-field name="ZIP" class="form-control " label="ZIP"
                                            :details="$userDetails" type="tel" placeholder="Enter your ZIP code."
                                            required={{ false }} />
                                    </div>
                                </div>
                            </div>


                        </fieldset>
                        <section class="text-left mb-3 mt-2">
                            <button class="btn btn-gray-800 mt-2 animate-up-2 w-25 btn-sm" type="submit">Update
                                Profile</button>
                        </section>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card shadow border-0 p-0">
                        <div class="card-header ps-4 pt-2 pb-0 bg-transparent">
                            <h6>General information </h6>
                        </div>
                        <div class="card-body p-2">
                            <form method="POST" action="{{ route('profile.password') }}"
                                class="w-100 bg-transparent m-0">
                                @csrf @method('PATCH')
                                <fieldset style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                                    <legend style="all: revert; font-weight:500">Details:</legend>

                                    <section class="row ps-1 pe-1 pt-2">

                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <x-generic-field type="password" name="current_password"
                                                    label="Current Password"
                                                    placeholder="Enter your current password"
                                                    required={{ true }} />
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <x-generic-field type="password" name="new_password"
                                                    label="New Password" placeholder="Enter a new password"
                                                    required={{ true }} />
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <x-generic-field type="password" name="new_password_confirmation"
                                                    label="Confirm New Password"
                                                    placeholder="Confirm your new password"
                                                    required={{ true }} />
                                            </div>
                                        </div>
                                    </section>
                                </fieldset>
                                <section class="text-center mb-2 mt-2">
                                    <button class="btn mt-2 animate-up-2 btn-primary btn-sm w-50" type="submit">
                                        Update Password
                                    </button>
                                </section>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layouts.admin>
