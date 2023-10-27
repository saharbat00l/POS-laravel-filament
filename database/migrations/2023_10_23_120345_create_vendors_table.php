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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->foreignId('parent_id')
            ->nullable() ->constrained('vendors') ->cascadeOnDelete();
            $table->string('person_name');
            $table->string('address1');
            $table->string('address2');
            $table->string('contact1');
            $table->string('contact2');
            $table->string('business_email');
            $table->string('personal_email');
            $table->longText('description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
