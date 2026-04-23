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
        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('kwh_charged', 8, 3)->nullable()->after('ended_at');
            $table->decimal('amount_charged', 8, 2)->nullable()->after('kwh_charged');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['kwh_charged', 'amount_charged']);
        });
    }
};
