<x-layouts.admin>
    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page">Settings</li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="pt-2"><div class="row">

        <div class="col-12 col-xl-8"><div class="card border-0 shadow mb-4"><div class="tab-content" id="tab-content">
                    
            <div class="tab-pane fade show active" id="tab-14" role="tabPanel" aria-labelledby="tab-14">
                <div class="card-header pt-3 pb-2 d-flex">
                    <p class="m-0 bg-transparent text-primary"><b>Logo & Favicon Settings</b></p>
                </div>
                
                <div class="card-body"><div class="row">
                    <div class="col-md-4"><div class="card shadow"><div class="card-body ps-2 pe-2 pt-3 text-center">
                        <form action="{{ route('settings.upload') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            @csrf @method('POST')
                            @if (!empty($settings))
                                <input type="hidden" name="id" value="{{ $settings->id }}">
                            @else 
                                <input type="hidden" name="id" value="">
                            @endif
                            @php
                                $softwareLogo = asset("assets/img/bodybuilder.gym-black-wallpapers.jpg");
                                if(!empty($settings)){ $softwareLogo = asset("assets/img/".$settings->software_logo); }
                            @endphp
                            <img src="{{ $softwareLogo }}" class="card-img" style="height: 125px" 
                                alt="Background Image" id="software_logo_img_preview">
                            <div class="image-upload-container">
                                <span class="mt-1 image-upload-handler">
                                    <i class="fas fa-camera color-secondary"></i>
                                    <input type="file" name="software_logo" id="software-logo" accept="image/*">
                                </span>
                                <p class="m-0">Upload Logo</p>
                            </div>
                            <button class="btn btn-sm btn-primary w-75" type="submit">Upload</button>
                        </form>
                    </div></div></div>
                    <div class="col-md-4"><div class="card shadow"><div class="card-body ps-2 pe-2 pt-3 text-center">
                        <form action="{{ route('settings.upload') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            @csrf @method('POST')
                            @if (!empty($settings))
                                <input type="hidden" name="id" value="{{ $settings->id }}">
                            @else 
                                <input type="hidden" name="id" value="">
                            @endif

                            @php
                                $softwareFavicon = asset("assets/img/bodybuilder.gym-black-wallpapers.jpg");
                                if(!empty($settings)){ $softwareFavicon = asset("assets/img/".$settings->software_favicon); }
                            @endphp
                            
                            <img src="{{ $softwareFavicon }}" id="software_favicon_img_preview" class="card-img" style="height: 125px" alt="Background Image">

                            <div class="image-upload-container">
                                <span class="mt-1 image-upload-handler">
                                    <i class="fas fa-camera color-secondary"></i>
                                    <input type="file" name="software_favicon" id="software-favicon" accept=".ico" />
                                </span>
                                <p class="m-0">Upload Favicon</p>
                            </div>
                            <button class="btn btn-sm btn-primary w-75">Upload</button>
                    </div></div></div>
                </div></div>
                <div class="col-md-12 text-primary ms-4 mb-3 ">
                    <small><strong>Click on the camera icon to select image.</strong></small>
                </div>
            </div><!-- logo & favicon settings -->

            <div class="tab-pane fade" id="tab-15" role="tabPanel" aria-labelledby="tab-15">
                <div class="card-header pt-3 pb-2 d-flex">
                    <p class="m-0 bg-transparent"><b>Logo & Favicon Settings</b></p>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.store') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="row">
                        @csrf @method('POST')

                        @if (!empty($settings))
                            <input type="hidden" name="id" value="{{ $settings->id }}">
                        @else 
                            <input type="hidden" name="id" value="">
                        @endif

                        <div class="col-md-7 mb-3"><div class="form-group">
                            <x-generic-field :details="$settings"  name="brand_name" label="Brand Name" type="text" placeholder="Enter brand name"></x-generic-field>
                        </div></div>

                        <div class="col-md-7 mb-3"><div class="form-group">
                            <x-generic-field :details="$settings"  name="brand_description" label="Brand Description" type="textarea" placeholder="..."></x-generic-field>
                        </div></div>

                        <div class="col-md-7 mb-3"><div class="form-group">
                            <x-generic-field :details="$settings"  name="currency" label="Currency" type="text" placeholder="..."></x-generic-field>
                        </div></div>

                        <div class="col-md-7 mb-3"><div class="form-group">
                            <x-generic-field :details="$settings"  name="country" label="Country" type="text" placeholder="..."></x-generic-field>
                        </div></div>

                        <div class="col-md-7 mb-3"><div class="form-group">
                            <x-generic-field :details="$settings"  name="city" label="City" type="text" placeholder="..."></x-generic-field>
                        </div></div>

                        <div class="col-md-7 mb-3"><div class="form-group">
                            <x-generic-field :details="$settings"  name="contact_number" label="Contact Number" type="text" placeholder="..."></x-generic-field>
                        </div></div>

                        <div class="col-md-7 mb-3"><div class="form-group">
                            <x-generic-field name="image" label="Upload Image" type="file" placeholder="..."></x-generic-field>
                        </div></div>
        
                        <div class="form-group row"><div class="col-sm-10"> 
                            <input type="submit" name="update_brand" value="Save Settings" class="btn btn-primary rounded-0">
                        </div></div>
                    </form>
                </div>
            </div>


            <div class="tab-pane fade" id="tab-16" role="tabPanel" aria-labelledby="tab-16">
                <div class="card-header pt-3 pb-2 d-flex">
                    <p class="m-0 bg-transparent"><b>Rules & Regulations</b></p>
                </div>
                <div class="card-body">
                    <form action="https://casualfitness.spantiklab.com/setting/update_rules" method="post" accept-charset="utf-8">
                        
                        @if (!empty($settings))
                            <input type="hidden" name="id" value="{{ $settings->id }}">
                        @else 
                            <input type="hidden" name="id" value="">
                        @endif
                        
                        <div class="form-group row">
                          <div class="col-md-2 col-form-label">
                            <label for="rule1">Rule # 1</label>                  </div>
                          <div class="col-md-4 col-md-offset-4">
                            <textarea name="rule1" cols="40" rows="3" class="form-control  rounded-0" id="rule1" placeholder="">rand</textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-2 col-form-label">
                            <label for="rule2">Rule # 2</label>                  </div>
                          <div class="col-md-4 col-md-offset-4">
                            <textarea name="rule2" cols="40" rows="3" class="form-control  rounded-0" id="rule2" placeholder="">loc</textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-2 col-form-label">
                            <label for="rule3">Rule # 3</label>                  </div>
                          <div class="col-md-4 col-md-offset-4">
                            <textarea name="rule3" cols="40" rows="3" class="form-control  rounded-0" id="rule3" placeholder="">sector</textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-2 col-form-label">
                            <label for="rule4">Rule # 4</label>                  </div>
                          <div class="col-md-4 col-md-offset-4">
                            <textarea name="rule4" cols="40" rows="3" class="form-control  rounded-0" id="rule4" placeholder="">Categorie</textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-2 col-form-label">
                            <label for="rule5">Rule # 5</label>                  </div>
                          <div class="col-md-4 col-md-offset-4">
                            <textarea name="rule5" cols="40" rows="3" class="form-control  rounded-0" id="rule5" placeholder=""></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-2 col-form-label">
                            <label for="rule6">Rule # 6</label>                  </div>
                          <div class="col-md-4 col-md-offset-4">
                            <textarea name="rule6" cols="40" rows="3" class="form-control rounded-0" id="rule6" placeholder=""></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-10"> 
                            <input type="submit" name="update_rules" value="Save Rules" class="btn btn-primary rounded-0">
                          </div>
                        </div>
                    </form>
                </div>
            </div>
                
        </div></div></div>

        <div class="col-12 col-xl-4"><div class="card shadow-sm border-0 text-center p-0">
            <img src="../assets/img/gym-black-wallpapers.jpg" class="card-img" alt="Background Image">
            <div class="card-body pb-4 bg-transparent">
                {{-- <button class="btn btn-sm btn-primary w-100 m-2">Logo & Favicon Settings</button> --}}
                {{-- <button class="btn btn-sm btn-primary w-100 m-2">Gym Settings</button> --}}
                {{-- <button class="btn btn-sm btn-primary w-100 m-2">Rules & Regulations</button> --}}

                <ul class="nav nav-pills square nav-fill flex-column vertical-tab mb-3 mb-lg-0" id="tab12" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab-3" data-bs-toggle="tab" href="#tab-14" role="tab" aria-controls="tab-14" aria-selected="true">
                            Logo & Favicon Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab-3" data-bs-toggle="tab" href="#tab-15" role="tab" aria-controls="tab-15" aria-selected="false">
                                Gym Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab-3" data-bs-toggle="tab" href="#tab-16" role="tab" aria-controls="tab-16" aria-selected="false">
                            Rules & Regulations
                        </a>
                    </li>
                </ul>

            </div>
        </div></div>

    </div></div>
</x-layouts.admin>

<script>
    const softwareFavicon = document.querySelector("#software-favicon");
    const softwareLogo = document.querySelector("#software-logo");


    softwareFavicon.addEventListener("change", function(event) {
        const image = URL.createObjectURL(event.target.files[0]);
        const imageTag = document.querySelector("#software_favicon_img_preview");
        
        imageTag.setAttribute('src',image)
    });

    softwareLogo.addEventListener("change", function(event) {
        const image = URL.createObjectURL(event.target.files[0]);
        const imageTag = document.querySelector("#software_logo_img_preview");
        
        imageTag.setAttribute('src',image)
    });
</script>