<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use DB as Database;


class TableSocks extends Migration {

    public function up(): void {

        Schema::create('socks', function (Blueprint $table) {
            $table->uuid('sku_id')->primary();
            $table->string('sku_name');
            $table->string('color');
            $table->integer('cotton_part');
        });

        Database::statement('
            alter table "socks" 
            add constraint "socks_cotton_part_check" 
            check ((("cotton_part" >= 0) and ("cotton_part" <= 100)));
        ');

    }

    public function down(): void {

        Schema::dropIfExists('socks');

    }
};
