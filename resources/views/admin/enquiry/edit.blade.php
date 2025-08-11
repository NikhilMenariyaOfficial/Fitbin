<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('enquiry.index') }}">Enquiries</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update</li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="card border-0 shadow components-section">
        <div class="card-header ps-4 pt-3 pb-1">
            <h6>Edit Enquiry</h6>
        </div>
        <form method="post" action="{{ route('enquiry.update', ['id' => $data->id]) }}" class="card-body pt-3 ps-3"
            enctype="multipart/form-data">
            @csrf @method('PUT')
            <fieldset style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                <legend style="all: revert; font-weight:500">Personal Information:</legend>
                <section class="row mt-2 ms-1">

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field value="{{ $data->name }}" name="name" label="Name" type="text"
                                placeholder="Enter Name" required={{ true }}
                                :details="$data"></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="gender" label="Gender" type="select" placeholder="Select Gender"
                                required={{ true }}>
                                <option value="" selected disabled> --Select--</option>
                                <option value="Male" {{ $data->gender == 'Male' ? 'selected' : '' }}>MALE</option>
                                <option value="Female" {{ $data->gender == 'Female' ? 'selected' : '' }}>FEMALE</option>
                                <option value="Other" {{ $data->gender == 'Other' ? 'selected' : '' }}>OTHER</option>
                            </x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="age" label="Age" type="number" placeholder="Enter Age"
                                required={{ true }} :details="$data" />
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="contact_number" label="Contact Number" type="number"
                                placeholder="Enter contact number" required={{ true }}
                                :details="$data"></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="email" label="Email" type="email" placeholder="Enter Email"
                                :details="$data"></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="address" label="Address" type="textarea" rows="3"
                                placeholder="Enter your message..." :details="$data"></x-generic-field>
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
                                <option value="GENERAL"
                                    {{ $data->enquiry_training_type == 'GENERAL' ? 'selected' : '' }}>GENERAL TRAINING
                                </option>
                                <option value="PERSONAL"
                                    {{ $data->enquiry_training_type == 'PERSONAL' ? 'selected' : '' }}>PERSONAL
                                    TRAINING</option>
                                <option value="YOGA" {{ $data->enquiry_training_type == 'YOGA' ? 'selected' : '' }}>
                                    YOGA TRAINING</option>
                                <option value="CARDIO"
                                    {{ $data->enquiry_training_type == 'CARDIO' ? 'selected' : '' }}>CARDIO TRAINING
                                    <CARDIO /option>
                                <option value="CROSSFIT"
                                    {{ $data->enquiry_training_type == 'CROSSFIT' ? 'selected' : '' }}>CROSSFIT
                                    TRAINING</option>
                            </x-generic-field>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="aboutjoining" label="Select About Joining" type="select"
                                placeholder="Select About Joining" required={{ true }}>
                                <option value="" selected disabled> --Select--</option>
                                <option value="Joining Next Week"
                                    {{ $data->about_joining == 'Joining Next Week' ? 'selected' : '' }}>Joining Next
                                    Week</option>
                                <option value="Joining Next Month"
                                    {{ $data->about_joining == 'Joining Next Month' ? 'selected' : '' }}>Joining Next
                                    Month</option>
                                <option value="Will Inform in a Few Days"
                                    {{ $data->about_joining == 'Will Inform in a Few Days' ? 'selected' : '' }}>Will
                                    Inform in a Few Days</option>
                            </x-generic-field>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field value="{{ $data->follow_up_date }}" name="follow_up_date"
                                label="Follow-up Date:" type="date" placeholder=""
                                required={{ true }}></x-generic-field>
                        </div>
                    </div>
                    <!-- <label for="follow_up_date">Follow-up Date:</label>
                    <input type="date" id="follow_up_date" name="follow_up_date"> -->
                </section>
            </fieldset>

            <fieldset class="mt-3" style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                <legend style="all: revert; font-weight:500" for="source">Enquiry Form:</legend>
                <section class="row mt-2 ms-1">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="source" label="Source" type="select" placeholder="Source:"
                                id="source">
                                <option value="" selected disabled> --Select--</option>
                                <option value="Online">Online</option>
                                <option value="Offline">Offline</option>
                                <option value="referral">Referral</option>
                            </x-generic-field>
                        </div>
                    </div>

                    <div id="referralNameField" style="display:none;" class="col-md-3 mb-3">
                        <div class="form-group" for="referralName">
                            <x-generic-field :details=$data required={{ true }} id="referralName"
                                name="referralName" label="Referral Name" type="text"
                                placeholder="Referral Name"></x-generic-field>
                        </div>
                    </div>

                    <div id="onlineEnquiryField" style="display:none;" class="col-md-3 mb-3">
                        <div class="form-group" for="onlineEnquiry">
                            <x-generic-field :details=$data required={{ true }} name="onlineSource"
                                label="Select Online Source" type="select" placeholder="Select Online Source">
                                <option value="" selected disabled> --Select--</option>
                                <option value="GOOGLE">Google</option>
                                <option value="FACEBOOK">Facebook</option>
                                <option value="INSTAGRAM">Instagram</option>
                                <option value="WEBSITE">Website</option>
                                <option value="JUSTDIAL">Justdial</option>
                            </x-generic-field>
                        </div>
                    </div>

                    <div id="offlineEnquiryField" style="display:none;" class="col-md-3 mb-3">
                        <div class="form-group" for="offlineEnquiry">
                            <x-generic-field :details=$data required={{ true }} name="offlineSource"
                                label="Select Offline Source" type="select" placeholder="Select Offline Source">
                                <option value="" selected disabled> --Select--</option>
                                <option value="Flex" {{ $data->offline_source == 'Flex' ? 'selected' : '' }}>Flex
                                </option>
                                <option value="Pamphlets"
                                    {{ $data->offline_source == 'Pamplates' ? 'selected' : '' }}>Pamplates</option>
                                <option value="News" {{ $data->offline_source == 'News' ? 'selected' : '' }}>News
                                    Paper Ads</option>
                                <option value="offline" {{ $data->offline_source == 'Offline' ? 'selected' : '' }}>
                                    Offline Campaign</option>
                            </x-generic-field>
                        </div>
                    </div>

                </section>
            </fieldset>

            <fieldset class="mt-3" style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                <legend style="all: revert; font-weight:500" for="source">Follow-Up Status</legend>
                <section class="row mt-2 ms-1">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field :details=$data required={{ true }} name="join_status"
                                label="join_status" type="select" placeholder="Joining Status" id="join_status">
                                <option value="" disabled> --Select--</option>
                                <option value="joined">Joined</option>
                                <option value="not_join">Not Joined</option>
                                <option value="joining_soon">Joining Soon</option>
                                <option value="not_interested">Not Interested</option>
                            </x-generic-field>
                        </div>
                    </div>


                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field :details=$data required={{ true }} name="enquiryStatus"
                                label="Enquiry Status" type="select" placeholder="Enquiry Status">
                                <option value="" disabled> --Select--</option>
                                <option value="Enquiry_Closed">Enquiry Closed</option>
                                <option value="Enquiry_Open">Enquiry Opened</option>
                            </x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field :details=$data required={{ true }} name="follow_up_date"
                                label="Last Follow-up Date:" type="date" placeholder=""></x-generic-field>
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
        onlineEnquiryField
        // Handler for source select change event
        $("#source").change(function() {
            var selectedOption = $(this).val();

            // Toggle visibility of referralNameField based on the selected option
            if (selectedOption === 'referral') {
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
