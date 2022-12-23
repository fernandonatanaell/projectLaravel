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
        if (!Schema::hasTable("dtrans")){
            Schema::create('dtrans', function (Blueprint $table) {
                $table->unsignedBigInteger("htrans_id");
                $table->foreign("htrans_id")->references("htrans_id")->on("htrans")->onDelete("cascade");
                $table->unsignedBigInteger("item_id");
                $table->foreign("item_id")->references("item_id")->on("items")->onDelete("cascade");
                $table->integer("dtrans_quantity");
                $table->decimal("dtrans_subtotal", 65, 2);
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
        Schema::dropIfExists('dtrans');
    }
};
