<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('membership_plans', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->string('name');
            $table->decimal('rate', 10, 2);
            $table->integer('validity'); // Assuming validity is in days
            $table->text('details')->nullable();
            $table->enum('type', ['NORMAL', 'PERSONAL_TRAINING'])->default('NORMAL');
            $table->timestamps();
        });

        Schema::create('temporary_members', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->uuid('membership_plan_id')->nullable();
            $table->enum('is_personal_training',['YES', 'NO'])->default('NO');

            $table->string('name');
            $table->string('email')->nullable();
            $table->enum('gender', ['MALE', 'FEMALE'])->default('FEMALE');
            $table->integer('age');
            $table->string('contact_number')->nullable();
            $table->text('address')->nullable();
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->longText('image')->nullable();
            $table->timestamps();
        });

        Schema::create('members', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->string('member_id');
            $table->string('name');
            $table->string('proof_given')->nullable();
            $table->enum('gender', ['MALE', 'FEMALE'])->default('FEMALE');
            $table->integer('age');
            $table->string('contact_number');
            $table->text('address')->nullable();
            $table->string('email')->unique()->nullable();
            $table->decimal('height', 5, 2); // Assuming height is stored as a decimal
            $table->decimal('weight', 5, 2); // Assuming weight is stored as a decimal
            $table->decimal('amount', 10, 2); // Assuming amount is stored as a decimal
            $table->decimal('membership_fee', 10, 2)->default(0.00);
            $table->decimal('amount_paid', 10, 2)->default(0.00);
            $table->decimal('pending_amount', 10, 2)->default(0.00);
            $table->date('joining_date')->nullable();
            $table->enum('is_personal_training',['YES', 'NO'])->default('NO');
            $table->date('membership_start_date')->nullable();
            $table->date('membership_end_date')->nullable();
            $table->date('last_payment_date')->nullable();
            $table->uuid('membership_plan_id')->nullable();
            $table->foreign('membership_plan_id')->references('id')->on('membership_plans')->onDelete('set null');
            $table->longText('image')->nullable(); // Use long text for image, can be nullable

            $table->date('date_of_birth')->nullable(false); // Date of Birth
            $table->string('occupation')->nullable(false); // Occupation
            $table->string('how_did_you_find_about_the_gym')->nullable(false); // How Did You Find About The Gym

            $table->enum('has_medical_conditions', ['YES', 'NO'])->default('NO'); // Whether the member has medical conditions
            $table->enum('medical_conditions', ['NONE', 'HEART_DISEASE', 'ASTHMA', 'DIABETES', 'CARDIOVASCULAR_CONDITION'])->nullable()->default('NONE'); // Specific medical conditions

            $table->enum('has_body_part_issues', ['YES', 'NO'])->default('NO'); // Whether the member has body part issues
            $table->enum('body_part_issues', ['NONE', 'KNEES', 'LOWER_BACK', 'NECK_SHOULDER', 'OTHER'])->nullable()->default('NONE'); // Specific body part issues
            $table->text('other_medical_info')->nullable(); // Anything else we should know

            $table->timestamps(); // Created at and Updated at timestamps
        });

        Schema::create('membership_histories', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->uuid('member_id');
            $table->uuid('membership_plan_id');
            $table->decimal('amount', 10, 2);
            $table->decimal('due_amount', 10, 2)->default(0);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['ACTIVE', 'EXPIRED', 'CANCELLED'])->default('EXPIRED');
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('membership_plan_id')->references('id')->on('membership_plans')->onDelete('cascade');
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->uuid('member_id');
            $table->uuid('membership_plan_id');
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('membership_plan_id')->references('id')->on('membership_plans')->onDelete('cascade');
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->string('software_logo')->nullable();
            $table->string('software_favicon')->nullable();
            $table->string('brand_name')->nullable();
            $table->text('brand_description')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('currency')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('attendances', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->uuid('member_id')->nullable();
            $table->date('attendance_date');
            $table->enum('status', ['PRESENT', 'ABSENT', 'LATE'])->default('PRESENT');
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });

        Schema::create('enquiries', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->string('name')->nullable();
            $table->enum('gender', ['MALE', 'FEMALE', 'OTHER'])->nullable();
            $table->integer('age')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->enum('enquiry_training_type', ['GENERAL', 'PERSONAL', 'YOGA' , 'CARDIO' , 'CROSSFIT'], 255)->nullable();
            $table->enum('about_joining', ['JOINING_NEXT_WEEK', 'JOINING_NEXT_MONTH', 'WILL_CONFIRM_IN_FEE_DAYS'])->nullable();
            $table->date('follow_up_date')->nullable();
            $table->enum('source', ['REFERRAL', 'ONLINE', 'OFFLINE'])->nullable();
            $table->enum('online_source', ['GOOGLE', 'FACEBOOK', 'INSTAGRAM', 'WEBSITE', 'JUSTDIAL'])->nullable();
            $table->enum('offline_source', ['FLEX','PEMPLATE', 'NEWS_PAPER_AD', 'OFFLINE_CAMPAIGN'])->nullable();
            $table->enum('join_status', ['JOINED','NOT_JOIN', 'JOINING_SOON', 'NOT_INTERESTED'])->nullable();
            $table->enum('enquiry_status', ['ENQUIRY_CLOSED','ENQUIRY_OPEN'])->nullable();
            $table->date('last_follow_up_date')->nullable();
            $table->string('referral_name')->nullable(); // Only if the source is 'Referral Name'
            $table->timestamps();
        });

        Schema::create('terms_and_conditions', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('membership_plans');
        Schema::dropIfExists('members');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('enquiries');
    }
};
