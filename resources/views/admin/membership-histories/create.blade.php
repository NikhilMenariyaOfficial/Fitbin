 <x-layouts.admin>
     <x-breadcrumb :title="''">
         <li class="breadcrumb-item active" aria-current="page">
             <a href="{{ route('membership-histories.index') }}">Membership Histories</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">
             <a href="{{ route('membership-histories.create') }}">Create</a>
         </li>
     </x-breadcrumb>

     <x-errors :errors="$errors"></x-errors>
     <x-session></x-session>

     <div class="card border-0 shadow components-section">
         <div class="card-header ps-4 pt-3 pb-1">
             <h6>Create New Membership History</h6>
         </div>
         <form method="post" action="{{ route('membership-histories.store') }}" class="card-body pt-3 ps-3"
             enctype="multipart/form-data">
             @csrf @method('POST')

             <fieldset class="mt-3" style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                 <legend style="all: revert; font-weight:500">More Information:</legend>
                 <section class="row mt-2 ms-1">
                     <div class="col-md-3 mb-1">
                         <div class="form-group">
                             <x-generic-field name="member_id" label="Member" type="select" placeholder=""
                                 required={{ true }}>
                                 <option value="" selected disabled> --Select Member-- </option>
                                 @foreach ($members as $member)
                                     <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }} >{{ $member->name }} ({{ $member->member_id }})</option>
                                 @endforeach
                             </x-generic-field>
                         </div>
                     </div>

                     <div class="col-md-3 mb-1">
                         <div class="form-group">
                             <x-generic-field name="membership_plan_id" label="Membership Plan " type="select"
                                 placeholder="" required={{ true }}>
                                 <option value="" selected disabled> --Select Membership Plan-- </option>
                                 @foreach ($membershipPlans as $plan)
                                     <option value="{{ $plan->id }}" {{ old('membership_plan_id') == $plan->id ? 'selected' : '' }} >{{ $plan->name }}</option>
                                 @endforeach
                             </x-generic-field>
                         </div>
                     </div>

                    <div class="col-md-3 mb-1"><div class="form-group">
                        <x-generic-field type="date" label="Joining Date" name="joining_date" placeholder="" required={{ true }}></x-generic-field>
                    </div></div>

                    <div class="col-md-3 mb-3"><div class="form-group">
                        <x-generic-field type="date" label="End Date" name="end_date" placeholder="" required={{ true }}></x-generic-field>
                    </div></div>

                    <div class="col-md-3 mb-1"><div class="form-group">
                        <x-generic-field type="number" label="Paid Amount" name="amount" placeholder="Enter Paid Amount" required={{ true }}></x-generic-field>
                    </div></div>

                    <div class="col-md-3 mb-1"><div class="form-group">
                        <x-generic-field type="number" label="Due Amount" name="due_amount" placeholder="Enter Due Amount"></x-generic-field>
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
