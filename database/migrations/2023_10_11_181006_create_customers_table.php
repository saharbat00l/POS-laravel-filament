<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('customer_name');
            $table->unique('customer_id');
            $table->text('address1');
            $table->text('address2');
            $table->integer('contact1');
            $table->integer('contact2')->nullable();
            $table->text('ref_name');
            $table->text('ref_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
