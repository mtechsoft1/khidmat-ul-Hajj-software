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
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('client_id');
            $table->string('reservation_number')->nullable()->after('invoice_id');
            $table->date('reservation_date')->nullable()->after('reservation_number');
            $table->string('reservation_reference')->nullable()->after('reservation_date');
            $table->string('reservation_user_id')->nullable()->after('reservation_reference');
            $table->string('reservation_email')->nullable()->after('reservation_user_id');
            $table->string('lead_pax')->nullable()->after('reservation_email');
            $table->string('nationality')->nullable()->after('lead_pax');
            $table->string('hotel_name')->nullable()->after('nationality');
            $table->date('hotel_check_in')->nullable()->after('hotel_name');
            $table->date('hotel_check_out')->nullable()->after('hotel_check_in');
            $table->unsignedInteger('no_of_nights')->nullable()->after('hotel_check_out');
            $table->string('meal_type')->nullable()->after('no_of_nights');
            $table->string('special_remarks')->nullable()->after('meal_type');
            $table->decimal('meal_per_pax', 12, 2)->nullable()->after('special_remarks');
            $table->decimal('municipality_tax', 12, 2)->nullable()->after('meal_per_pax');
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn([
                'category_id',
                'reservation_number',
                'reservation_date',
                'reservation_reference',
                'reservation_user_id',
                'reservation_email',
                'lead_pax',
                'nationality',
                'hotel_name',
                'hotel_check_in',
                'hotel_check_out',
                'no_of_nights',
                'meal_type',
                'special_remarks',
                'meal_per_pax',
                'municipality_tax',
            ]);
        });
    }
};
