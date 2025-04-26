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
        Schema::table('obat', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_obat_id')->after('id')->nullable();
            $table->foreign('kategori_obat_id')->references('id')->on('kategori_obat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('obat', function (Blueprint $table) {
            $table->dropForeign(['kategori_obat_id']);
            $table->dropColumn('kategori_obat_id');
        });
    }
};
