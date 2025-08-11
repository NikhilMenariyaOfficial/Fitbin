<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('personal-training.index') }}">Personal Training</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Update</li>
        </li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>


    <div class="card border-0 shadow components-section">
        <div class="card-header ps-4 pt-3 pb-1">
            <h6>Personal Training</h6>
        </div>
        <form method="post" action="{{ route('personal-training.update', ['id' => $plan->id]) }}"
            class="card-body pt-3 ps-3" enctype="multipart/form-data">
            @csrf @method('PUT')
            <fieldset style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                <legend style="all: revert; font-validity:500">Details:</legend>
                <section class="row mt-2 ms-1">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="name" label="Name" type="text" placeholder="Enter Plan Name"
                                :details="$plan" required={{ true }}></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="rate" label="Rate" type="number" placeholder="Enter Rate"
                                :details="$plan" required={{ true }}></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="validity" label="Validity (Days)" type="number"
                                placeholder="Enter Validity" :details="$plan"
                                required={{ true }}></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="details" label="Details" type="textarea" placeholder="Plan Details"
                                :details="$plan"></x-generic-field>
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
