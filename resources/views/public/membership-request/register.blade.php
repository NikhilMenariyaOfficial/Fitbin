<x-layouts.app>
    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="flex justify-center items-center min-h-screen bg-gray-100  p-4">
        <div class="card border-0 shadow components-section w-full max-w-4xl bg-white">
            <div class="card-header ps-4 pt-3 pb-1">
                <h6>Membership Request</h6>
            </div>
            <form method="post" action="{{ route('membership-request.store') }}" class="card-body pt-3 ps-3  "
                enctype="multipart/form-data">
                @csrf @method('POST')

                <fieldset style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                    <legend style="all: revert; font-weight:500">Personal Information:</legend>
                    <section class="row mt-2 ms-1">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <x-generic-field name="name" label="Name" type="text" placeholder="Enter Name"
                                    required={{ true }}></x-generic-field>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <x-generic-field name="gender" label="Gender" type="select"
                                    placeholder="Select Gender" required={{ true }}>
                                    <option value="" selected disabled> --Select--</option>
                                    <option value="MALE" {{ old('gender') == 'MALE' ? 'selected' : '' }}>MALE
                                    </option>
                                    <option value="FEMALE" {{ old('gender') == 'FEMALE' ? 'selected' : '' }}>FEMALE
                                    </option>
                                </x-generic-field>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <x-generic-field name="age" label="Age" type="number" placeholder="Enter Age"
                                    required={{ true }} />
                            </div>
                        </div>

                        <div class="col-md-3 mb-1">
                            <div class="form-group">
                                <label for="image" class="form-label">
                                    <span>Upload Image:</span>
                                    <sup><i class="fas fa-star text-danger" style="font-size:7px;"></i></sup>
                                </label>
                                <input class="form-control" type="file" id="image" name="image">
                                <small id="imageHelp" class="form-text text-muted">Max size 2MB (600x600)</small>
                                @error('image')
                                    <span class="form-text text-muted text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <x-generic-field name="contact_number" label="Contact Number" type="number"
                                    placeholder="Enter contact number" required={{ true }}></x-generic-field>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <x-generic-field name="email" label="Email" type="email"
                                    placeholder="Enter Email"></x-generic-field>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <x-generic-field name="address" label="Address" type="textarea" rows="3"
                                    placeholder="Enter your message..."></x-generic-field>
                            </div>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="mt-3" style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                    <legend style="all: revert; font-weight:500">Physical Information:</legend>
                    <section class="row mt-2 ms-1">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <x-generic-field name="height" label="Height" type="number" placeholder="Enter height"
                                    required={{ true }}>
                                </x-generic-field>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <x-generic-field name="weight" label="Weight" type="number" placeholder="Enter weight"
                                    required={{ true }}>
                                </x-generic-field>
                            </div>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="mt-3" style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                    <legend style="all: revert; font-weight:500">More Information:</legend>
                    <section class="row mt-2 ms-1">

                        <div class="col-md-auto mb-1">
                            <div class="form-group">
                                <label for="is_personal_training">
                                    <span>Personal Training</span>
                                    <sup><i class="fas fa-star text-danger" style="font-size:7px;"></i></sup>
                                </label><br>

                                <input type="radio" id="personal_training_yes" name="is_personal_training"
                                    value="YES" {{ old('is_personal_training') == 'YES' ? 'checked' : '' }}>
                                <label for="personal_training_yes">YES</label>

                                <input type="radio" id="personal_training_no" name="is_personal_training"
                                    value="NO" {{ old('is_personal_training') == 'NO' ? 'checked' : '' }}>
                                <label for="personal_training_no">NO</label>

                                @error('is_personal_training')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 mb-1" id="source-membership-plan" style="display: none;">
                            <div class="form-group">
                                <x-generic-field name="membership_plan_id" label="Membership Plan" type="select"
                                    placeholder="Select Membership Plan" required={{ true }}>
                                    <option value="" selected disabled> --Select-- </option>
                                    @foreach ($membershipPlans as $index => $plan)
                                        <option value="{{ $plan->id }}"
                                            {{ old('membership_plan_id') == $plan->id ? 'selected' : '' }}>
                                            {{ $plan->name }}
                                        </option>
                                    @endforeach
                                </x-generic-field>
                            </div>
                        </div>

                        <div class="col-md-3 mb-1" id="source-personal-training-plan" style="display: none;">
                            <div class="form-group">
                                <x-generic-field name="membership_plan_id" label="Personal Training Plan"
                                    type="select" placeholder="Select Membership Plan" required={{ true }}>
                                    <option value="" selected disabled> --Select-- </option>
                                    @foreach ($personalTrainingPlans as $index => $plan)
                                        <option value="{{ $plan->id }}"
                                            {{ old('membership_plan_id') == $plan->id ? 'selected' : '' }}>
                                            {{ $plan->name }}
                                        </option>
                                    @endforeach
                                </x-generic-field>
                            </div>
                        </div>
                    </section>
                </fieldset>

                <div class="mt-3 ms-1">
                    <input type="checkbox" id="agree" name="agree" class="mr-2">
                    <label for="agree">
                        <span>I agree to the  <a href="{{ route('terms-and-conditions.show') }}">terms & conditions</a> </span>
                        <sup><i class="fas fa-star text-danger" style="font-size:7px;"></i></sup>
                    </label>
                </div>

                <div class="col-md-3 mt-1">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary w-100">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
