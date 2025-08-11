<x-layouts.app>
    <div class="flex justify-center items-center min-h-screen bg-gray-100  p-4">
    <div class="card border-0 shadow components-section w-full max-w-4xl bg-white"><div class="card-body pt-3 ps-3">
        <fieldset style="all: revert; border-radius: 5px; border: 1px solid #ddd;">
            <legend style="all: revert; font-weight:500">Terms and Conditions:</legend>
            <div class="overflow-y-auto max-h-screen p-2 scroll-container">
                {!! $terms->content ?? '' !!}
            </div>
        </fieldset>
    </div></div>
    </div>
</x-layouts.app>
