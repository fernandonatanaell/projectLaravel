<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable("customers")){
            Schema::create('customers', function (Blueprint $table) {
                $table->id("customer_id");
                $table->string("customer_name", 255);
                $table->string("customer_email", 255);
                $table->string("customer_address", 255);
                $table->string("customer_phone_number", 255);
                $table->string("customer_jk", 1)->comment("L laki, P perempuan");
                $table->timestamps(); // created_at dan updated_at
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
