<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('enquiry.index') }}">Enquiries</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="card border-0 shadow components-section">
        <div class="card-header ps-4 pt-3 pb-1">
            <h6>New Enquiry</h6>
        </div>
        <form method="post" action="{{ route('enquiry.store') }}" class="card-body pt-3 ps-3"
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
                            <x-generic-field name="gender" label="Gender" type="select" placeholder="Select Gender"
                                required={{ true }}>
                                <option value=""> --Select--</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>MALE</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>FEMALE</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>OTHER</option>
                            </x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="age" label="Age" type="number" placeholder="Enter Age"
                                required={{ true }} />
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
                <legend style="all: revert; font-weight:500">Training Information:</legend>
                <section class="row mt-2 ms-1">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="trainingtype" label="Enquiry Training Type" type="select"
                                placeholder="Select Enquiry Training Type" required={{ true }}>
                                <option value="" selected disabled> --Select--</option>
                                <option value="GENERAL" {{ old('trainingtype') == 'GENERAL' ? 'selected' : '' }}>
                                    GENERAL TRAINING</option>
                                <option value="PERSONAL" {{ old('trainingtype') == 'PERSONAL' ? 'selected' : '' }}>
                                    PERSONAL TRAINING</option>
                                <option value="YOGA" {{ old('trainingtype') == 'YOGA' ? 'selected' : '' }}>YOGA
                                    TRAINING</option>
                                <option value="CARDIO" {{ old('trainingtype') == 'CARDIO' ? 'selected' : '' }}>CARDIO
                                    TRAINING</option>
                                <option value="CROSSFIT" {{ old('trainingtype') == 'CROSSFIT' ? 'selected' : '' }}>
                                    CROSSFIT TRAINING</option>
                            </x-generic-field>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="aboutjoining" label="Select About Joining" type="select"
                                placeholder="Select About Joining" required={{ true }}>
                                <option value="" selected disabled> --Select--</option>
                                <option value="Joining Next Week"
                                    {{ old('aboutjoining') == 'Joining Next Week' ? 'selected' : '' }}>Joining Next
                                    Week</option>
                                <option value="Joining Next Month"
                                    {{ old('aboutjoining') == 'Joining Next Month' ? 'selected' : '' }}>Joining Next
                                    Month</option>
                                <option value="Will Inform in a Few Days"
                                    {{ old('aboutjoining') == 'Will Inform in a Few Days' ? 'selected' : '' }}>Will
                                    Inform in a Few Days</option>
                            </x-generic-field>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="follow_up_date" label="Follow-up Date:" type="date"
                                placeholder="Enter Follow-Up Date" required={{ true }}></x-generic-field>
                        </div>
                    </div>

                </section>
            </fieldset>

            <fieldset class="mt-3" style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                <legend style="all: revert; font-weight:500" for="source">Enquiry Form:</legend>
                <section class="row mt-2 ms-1">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="source" label="Source" type="select" placeholder="Source:"
                                id="source" required={{ true }}>
                                <option value="" selected disabled> --Select--</option>
                                <option value="Online" {{ old('trainingtype') == 'Online' ? 'selected' : '' }}>Online
                                </option>
                                <option value="Offline" {{ old('trainingtype') == 'Offline' ? 'selected' : '' }}>
                                    Offline</option>
                                <option value="Referral" {{ old('trainingtype') == 'referral"' ? 'selected' : '' }}>
                                    Referral</option>
                            </x-generic-field>
                        </div>
                    </div>

                    <div id="referralNameField" style="display:none;" class="col-md-3 mb-3">
                        <div class="form-group" for="referralName">
                            <x-generic-field id="referralName" name="referralName" label="Referral Name"
                                type="text" placeholder="Referral Name"></x-generic-field>
                        </div>
                    </div>

                    <div id="onlineEnquiryField" style="display:none;" class="col-md-3 mb-3">
                        <div class="form-group" for="onlineEnquiry">
                            <x-generic-field name="onlineSource" label="Select Online Source" type="select"
                                placeholder="Select Online Source">
                                <option value="" selected disabled> --Select--</option>
                                <option value="Google"
                                    {{ old('aboutjoining') == 'Joining Next Week' ? 'selected' : '' }}>Google</option>
                                <option value="Facebook"
                                    {{ old('aboutjoining') == 'Joining Next Month' ? 'selected' : '' }}>Facebook
                                </option>
                                <option value="Instagram"
                                    {{ old('aboutjoining') == 'Will Inform in a Few Days' ? 'selected' : '' }}>
                                    Instagram</option>
                                <option value="Website"
                                    {{ old('aboutjoining') == 'Will Inform in a Few Days' ? 'selected' : '' }}>Website
                                </option>
                                <option value="Justdial"
                                    {{ old('aboutjoining') == 'Will Inform in a Few Days' ? 'selected' : '' }}>Justdial
                                </option>
                            </x-generic-field>
                        </div>
                    </div>

                    <div id="offlineEnquiryField" style="display:none;" class="col-md-3 mb-3">
                        <div class="form-group" for="offlineEnquiry">
                            <x-generic-field name="offlineSource" label="Select Offline Source" type="select"
                                placeholder="Select Offline Source">
                                <option value="" selected disabled> --Select--</option>
                                <option value="Flex" {{ old('aboutjoining') == 'Flex' ? 'selected' : '' }}>Flex
                                </option>
                                <option value="Pamplates" {{ old('aboutjoining') == 'Pamplates' ? 'selected' : '' }}>
                                    Pamplates</option>
                                <option value="News Paper Ads" {{ old('aboutjoining') == 'News' ? 'selected' : '' }}>
                                    News Paper Ads</option>
                                <option value="offline Campaign"
                                    {{ old('aboutjoining') == 'Offline' ? 'selected' : '' }}>Offline Campaign</option>
                            </x-generic-field>
                        </div>
                    </div>

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
    </div>
</x-layouts.admin>

<script>
    $(document).ready(function() {
        // Handler for source select change event
        $("#source").change(function() {
            var selectedOption = $(this).val();

            // Toggle visibility of referralNameField based on the selected option
            if (selectedOption === 'Referral') {
                $("#referralNameField").show();
            } else {
                $("#referralNameField").hide();
            }
        });

        $("#source").change(function() {
            var selectedOption = $(this).val();

            // Toggle visibility of referralNameField based on the selected option
            if (selectedOption === 'Online') {
                $("#onlineEnquiryField").show();
            } else {
                $("#onlineEnquiryField").hide();
            }
        });

        $("#source").change(function() {
            var selectedOption = $(this).val();

            // Toggle visibility of referralNameField based on the selected option
            if (selectedOption === 'Offline') {
                $("#offlineEnquiryField").show();
            } else {
                $("#offlineEnquiryField").hide();
            }
        });

    });
</script>
