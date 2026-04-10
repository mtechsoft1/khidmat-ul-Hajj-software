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
        Schema::table('products', function (Blueprint $table) {
            $table->string('room_type')->nullable()->after('description');
            $table->unsignedInteger('default_no_of_pax')->nullable()->after('room_type');
            $table->string('meal_plan')->nullable()->after('default_no_of_pax');
            $table->string('special_remarks')->nullable()->after('meal_plan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'room_type',
                'default_no_of_pax',
                'meal_plan',
                'special_remarks',
            ]);
        });
    }
};
