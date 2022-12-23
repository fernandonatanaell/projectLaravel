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
        if (!Schema::hasTable("services_items")){
            Schema::create('services_items', function (Blueprint $table) {
                $table->unsignedBigInteger("service_id");
                // saya        mem-FK field ini  refer ke    field ini      dari table ini
                $table->foreign("service_id")->references("service_id")->on("services")->onDelete("cascade");

                $table->unsignedBigInteger("item_id");
                // saya        mem-FK field ini  refer ke    field ini      dari table ini
                $table->foreign("item_id")->references("item_id")->on("items")->onDelete("cascade");

                $table->integer("si_amount");
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
        Schema::dropIfExists('services_items');
    }
};
