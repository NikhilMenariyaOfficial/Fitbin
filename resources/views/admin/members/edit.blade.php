<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('members.index') }}">Members</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update</li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="card border-0 shadow components-section">
        <div class="card-header ps-4 pt-3 pb-1">
            <h6>New Registration</h6>
        </div>
        <form method="post" action="{{ route('members.update', ['id' => $member->id]) }}" class="card-body pt-3 ps-3"
            enctype="multipart/form-data">
            @csrf @method('PUT')
            <fieldset style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                <legend style="all: revert; font-weight:500">Personal Information:</legend>
                <section class="row mt-2 ms-1">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="member_id" label="Member ID" type="text"
                                placeholder="Enter Member ID" :details="$member"
                                required={{ true }}>
                            </x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="name" label="Name" type="text" placeholder="Enter Name"
                                :details="$member" required={{ true }}></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="gender" label="Gender" type="select" placeholder="Select Gender"
                                :details="$member" required={{ true }}>
                                <option value="" selected disabled> --Select--</option>
                                <option value="MALE"
                                    {{ old('gender', $member->gender) === 'MALE' ? 'selected' : '' }}>MALE</option>
                                <option value="FEMALE"
                                    {{ old('gender', $member->gender) === 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                            </x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="age" label="Age" type="number" placeholder="Enter Age"
                                :details="$member" required={{ true }}></x-generic-field>
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
                                placeholder="Enter contact number" :details="$member"
                                required={{ true }}></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="email" label="Email" type="email" placeholder="Enter Email"
                                :details="$member"></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="address" label="Address" type="textarea" rows="3"
                                placeholder="Enter your message..." :details="$member"></x-generic-field>
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
                                :details="$member" required={{ true }}></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="weight" label="Weight" type="number" placeholder="Enter weight"
                                :details="$member" required={{ true }}></x-generic-field>
                        </div>
                    </div>
                </section>
            </fieldset>

            <div class="col-md-3 mt-1">
                <div class="form-group d-flex mt-3">
                    <a href="{{ url()->previous() }}" type="button"
                        class="btn btn-block btn-sm btn-danger ps-5 pe-5 me-1">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-block btn-sm btn-gray-800 ps-5 pe-5 ms-3">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
    </div>
</x-layouts.admin>
