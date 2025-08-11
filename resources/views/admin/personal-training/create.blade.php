<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('personal-training.index') }}">Personal Training</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
        </li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="card border-0 shadow components-section">
        <div class="card-header ps-4 pt-3 pb-1">
            <h6>Personal Training</h6>
        </div>
        <form method="post" action="{{ route('personal-training.store') }}" class="card-body pt-3 ps-3">
            @csrf @method('POST')
            <fieldset style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                <legend style="all: revert; font-validity:500">Details:</legend>
                <section class="row mt-2 ms-1">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="name" label="Name" type="text" placeholder="Enter Plan Name"
                                required={{ true }}></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="rate" label="Rate" type="number" placeholder="Enter Rate"
                                required={{ true }}></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="validity" label="Validity (Days)" type="number"
                                placeholder="Enter Validity" required={{ true }}></x-generic-field>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <x-generic-field name="details" label="Details" type="textarea"
                                placeholder="Plan Details"></x-generic-field>
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
