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
        if (!Schema::hasTable("items")){
            Schema::create('items', function (Blueprint $table) {
                $table->id("item_id");
                $table->string("item_name", 255);
                $table->string("item_brand");
                $table->integer("item_price");
                $table->integer("item_stock");
                $table->string("item_image_name");
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
        Schema::dropIfExists('items');
    }
};
