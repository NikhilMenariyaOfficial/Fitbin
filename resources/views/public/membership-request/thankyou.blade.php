<!-- resources/views/thankyou.blade.php -->

<x-layouts.app>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-4">
            <div class="flex items-center justify-center mb-6">
                <h1 class="text-3xl font-semibold text-gray-800">Thank You!</h1>
            </div>
            <p class="text-lg text-gray-600 mb-4">
                Your membership request has been submitted successfully.
                We will review your information and notify you once your membership is approved.
            </p>
            <div class="flex justify-between items-center">
                <a href="{{ route('login') }}"
                    class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                    Go to Home
                </a>
                <div class="text-gray-500 text-sm mb-8">
                    <p class="mb-1">Need Help?</p>
                    <p>Contact us at <a href="mailto:support@example.com" class="text-blue-500">support@example.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
