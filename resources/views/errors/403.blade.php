<x-layouts.app>
    <title>403</title>
    <div class="container bg-transparent">
        <div class="card mt-5">
            <div class="card-body">
                <h2>Account Locked Due to Unsettled Payment</h2>
                <p>Dear {{ $user->first_name }},</p>
                <p>We regret to inform you that your account has been temporarily locked due to unresolved payment
                    issues. Our
                    records indicate that there are outstanding payments associated with your account, which need to be
                    addressed to restore full access.</p>
                <h3>Details of Outstanding Payments:</h3>
                <ul>
                    <li>Invoice ID: 2023-IN-07</li>
                    <li>Amount Due: 8500</li>
                    <li>Due Date: 30th December 2023</li>
                </ul>
                <p>To regain access to your account and enjoy uninterrupted services, please take the following steps:
                </p>
                <ol>
                    <li><strong>Clear Outstanding Payments:</strong> Make a payment for the outstanding amount using the
                        provided invoice details.</li>
                    <li><strong>Payment Confirmation:</strong> After making the payment, please allow some time for our
                        system
                        to process the update. You will receive a confirmation email once the payment has been
                        successfully
                        processed.</li>
                    <li><strong>Account Unlock:</strong> Once the payment is confirmed, your account will be
                        automatically
                        unlocked, and you can resume normal use.</li>
                </ol>
                <p>If you have any questions or concerns regarding the outstanding payment, feel free to contact our
                    support
                    team at [Support Email or Phone Number]. We are here to assist you in resolving this matter
                    promptly.</p>
                <p>Thank you for your understanding and cooperation.</p>
                <p>Best regards,<br>ArrayBid Software</p>
            </div>
        </div>

    </div>

</x-layouts.app>
