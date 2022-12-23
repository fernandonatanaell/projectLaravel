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
        if (!Schema::hasTable("services")){
            Schema::create('services', function (Blueprint $table) {
                $table->id("service_id");
                $table->text("service_description");
                $table->unsignedBigInteger("customer_id");
                $table->foreign("customer_id")->references("customer_id")->on("customers")->onDelete("cascade");
                $table->decimal("service_cost", 10, 2);
                $table->date("service_date");
                $table->integer("service_status")->comment("1 Done, 0 Undone");
                $table->tinyInteger("service_payment_status")->comment("1 Lunas, 0 Belum lunas");
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
        Schema::dropIfExists('services');
    }
};
