<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->decimal('quantity', 12, 3)->default(1)->change();
        });
    }

    public function down()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->change();
        });
    }
};