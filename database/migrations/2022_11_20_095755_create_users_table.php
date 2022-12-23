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
        if (!Schema::hasTable("users")){
            Schema::create('users', function (Blueprint $table) {
                $table->id("user_id");
                $table->string("user_name", 255);
                $table->string("user_username", 255)->unique();
                $table->text("user_password")->comment("Sudah dalam bentuk enkripsi");
                $table->date("user_dob");
                $table->string("user_address", 255);
                $table->string("user_phone_number", 255);
                $table->string("user_jk", 1)->comment("L laki, P perempuan");
                $table->tinyInteger("user_status");
                $table->integer("user_role")->comment("0 owner, 1 manajer, 2 teknisi, 3 kasir");
                $table->integer("user_salary")->default(0);
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
        Schema::dropIfExists('users');
    }
};
