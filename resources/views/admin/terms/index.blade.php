<x-layouts.admin>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>

    <x-breadcrumb :title="''">
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('terms.index') }}">Terms and Conditions</a></li>
    </x-breadcrumb>

    <x-errors :errors="$errors"></x-errors>
    <x-session></x-session>

    <div class="card border-0 shadow components-section">
        <div class="card-header ps-4 pt-3 pb-1">
            <h6>Terms and Conditions</h6>
        </div>
        <form action="{{ route('terms.store') }}" method="POST" class="card-body pt-3 ps-3">
            @csrf @method('POST')
            <fieldset class="mt-3" style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
                <legend style="all: revert; font-weight:500">More Information:</legend>
                <section class="row mt-2 ms-1">
                    <x-generic-field name="content" label="Content" type="textarea" id="editor" placeholder="/** Terms and conditions **/" :details="$terms" required={{ true }}>
                    </x-generic-field>
                </section>
            </fieldset>

            <div class="col-md-3 mt-1"><div class="form-group">
                <button type="submit" class="btn btn-block btn-sm btn-gray-800 w-100 ps-5 pe-5" style="margin-top:30px">Submit</button>
            </div></div>
        </form>
    </div>
    <script>
        ClassicEditor.create(document.querySelector('#content')).catch(error => {
            console.error(error);
        });
    </script>
</x-layouts.admin>
