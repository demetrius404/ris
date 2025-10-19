<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use DB as Database;


class TableOperations extends Migration {

    protected $primaryKey = 'operation_id';

    public function up(): void {
        Schema::create('operations', function (Blueprint $table) {
            $table->uuid('operation_id')->primary();
            $table->enum('operation_type', ['income', 'outcome']);
            $table->uuid('sku_id');
            $table->index('sku_id');
            $table->foreign('sku_id')->references('sku_id')->on('socks');
            $table->integer('quantity');
        });

        Database::statement('
            alter table "operations"
            add constraint "operations_quantity_check"
            check (("quantity" > 0));
        ');

    }

    public function down(): void {
        Schema::dropIfExists('operations');
    }
    
};
