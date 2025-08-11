<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('members.index') }}">Members</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('members.create') }}">Create</a></li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="card border-0 shadow components-section">
        <div class="card-header ps-4 pt-3 pb-1">
            <h6>New Registration</h6>
        </div>
        <form method="post" action="{{ route('members.store') }}" class="card-body pt-3 ps-3"
            enctype="multipart/form-data">
            @csrf @method('POST')
            <fieldset style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                <legend style="all: revert; font-weight:500">Personal Information:</legend>
                <section class="row mt-2 ms-1">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="member_id" label="Member ID" type="text"
                                placeholder="Enter Member ID" required={{ true }}>
                            </x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="name" label="Name" type="text" placeholder="Enter Name"
                                required={{ true }}></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="gender" label="Gender" type="select" placeholder="Select Gender"
                                required={{ true }}>
                                <option value="" selected disabled> --Select--</option>
                                <option value="MALE" {{ old('gender') == 'MALE' ? 'selected' : '' }}>MALE</option>
                                <option value="FEMALE" {{ old('gender') == 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                            </x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="date_of_birth" label="Date of Birth" type="date"
                                placeholder="Enter Date of Birth" required={{ true }} />
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
                            <label for="image" class="form-label">Upload Image:</label>
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
                                placeholder="Enter your address..."></x-generic-field>
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
                <legend style="all: revert; font-weight:500">Medical Information:</legend>
                <section class="row mt-2 ms-1">
                    <div class="col-md-8 mb-3">
                        <div class="form-group">
                            <label for="has_medical_conditions">Have You Ever or Do You Have Following?</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="heart_disease"
                                    name="medical_conditions[]" value="Heart Disease"
                                    {{ in_array('Heart Disease', old('medical_conditions', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="heart_disease">Heart Disease</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="asthma"
                                    name="medical_conditions[]" value="Asthma"
                                    {{ in_array('Asthma', old('medical_conditions', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="asthma">Asthma</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="diabetes"
                                    name="medical_conditions[]" value="Diabetes"
                                    {{ in_array('Diabetes', old('medical_conditions', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="diabetes">Diabetes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="cardiovascular_condition"
                                    name="medical_conditions[]" value="Cardiovascular Condition"
                                    {{ in_array('Cardiovascular Condition', old('medical_conditions', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="cardiovascular_condition">Cardiovascular Condition</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 mb-3">
                        <div class="form-group">
                            <label for="has_body_part_issues">Any Issue In Any Of The Following Body Part:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="knees"
                                    name="body_part_issues[]" value="Knees"
                                    {{ in_array('Knees', old('body_part_issues', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="knees">Knees</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="lower_back"
                                    name="body_part_issues[]" value="Lower Back"
                                    {{ in_array('Lower Back', old('body_part_issues', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="lower_back">Lower Back</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="neck_shoulder"
                                    name="body_part_issues[]" value="Neck/Shoulder"
                                    {{ in_array('Neck/Shoulder', old('body_part_issues', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="neck_shoulder">Neck/Shoulder</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="other_issues"
                                    name="body_part_issues[]" value="Other"
                                    {{ in_array('Other', old('body_part_issues', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="other_issues">Other</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="no_issues"
                                    name="body_part_issues[]" value="None of These"
                                    {{ in_array('None of These', old('body_part_issues', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="no_issues">None of These</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <x-generic-field name="other_medical_info" label="Anything else we should know"
                                type="textarea" rows="3"
                                placeholder="Enter any additional information"></x-generic-field>
                        </div>
                    </div>
                </section>
            </fieldset>

            <fieldset class="mt-3" style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                <legend style="all: revert; font-weight:500">More Information:</legend>
                <section class="row mt-2 ms-1">
                    <div class="col-md-3 mb-1">
                        <div class="form-group">
                            <x-generic-field type="date" label="Joining Date" name="joining_date" placeholder=""
                                required={{ true }}></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="is_personal_training" label="Personal Training" type="select"
                                placeholder="" required={{ true }}>
                                <option value="" selected disabled> --Select-- </option>
                                <option value="YES" {{ old('is_personal_training') ? 'selected' : '' }}>YES
                                </option>
                                <option value="NO" {{ old('is_personal_training') ? 'selected' : '' }}>NO</option>
                            </x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3" id="source-membership-plan" style="display: none;">
                        <div class="form-group">
                            <x-generic-field name="membership_plan_id" label="Membership Plan" type="select"
                                placeholder="Select Membership Plan" required={{ true }}>
                                <option value="" selected disabled> --Select-- </option>
                                @foreach ($membershipPlans as $index => $plan)
                                    @if ($plan->type === 'NORMAL')
                                        <option value="{{ $plan->id }}"
                                            {{ old('membership_plan_id') == $plan->id ? 'selected' : '' }}>
                                            {{ $plan->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3" id="source-personal-training-plan" style="display: none;"><div class="form-group">
                            <x-generic-field name="membership_plan_id" label="Personal Training Plan" type="select"
                                placeholder="Select Membership Plan" required={{ true }}>
                                <option value="" selected disabled> --Select-- </option>
                                @foreach ($membershipPlans as $index => $plan)
                                    @if ($plan->type === 'PERSONAL_TRAINING')
                                        <option value="{{ $plan->id }}"
                                            {{ old('membership_plan_id') == $plan->id ? 'selected' : '' }}>
                                            {{ $plan->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </x-generic-field>
                    </div></div>

                    <div class="col-md-3 mb-3"><div class="form-group">
                        <x-generic-field type="number" label="Paid Amount" name="amount" placeholder="Enter Paid Amount"
                            required={{ true }}>
                        </x-generic-field>
                    </div></div>

                    <div class="col-md-3 mb-3"><div class="form-group">
                        <x-generic-field name="occupation" label="Occupation" type="text" placeholder="Enter Occupation"
                            required={{ true }}>
                        </x-generic-field>
                    </div></div>

                    <div class="col-md-4 mb-3"><div class="form-group">
                        <x-generic-field name="how_did_you_find_about_the_gym" type="text" required={{ true }}
                            label="How Did You Find About The Gym"  placeholder="Enter Information">
                        </x-generic-field>
                    </div></div>

                    <div class="col-md-4 mb-3"><div class="form-group">
                        <x-generic-field name="type_of_id_proof_with_number" label="Type of Id Proof with Number"
                            type="text" placeholder="Enter Type of Id Proof with Number" required={{ true }}>
                        </x-generic-field>
                    </div></div>
                </section>
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
</x-layouts.admin>

<script>
    $(document).ready(function() {
        $('select[name="is_personal_training"]').change(function() {
            if ($(this).val() === 'YES') {
                $('#source-membership-plan').hide();
                $('#source-personal-training-plan').show();
            } else if ($(this).val() === 'NO') {
                $('#source-membership-plan').show();
                $('#source-personal-training-plan').hide();
            }
        });
    });
</script>
