<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('employee_id');
            $table->string("first_name", 80);
            $table->string("last_name", 80);
            $table->integer("company_id")->unsigned();
            $table->foreign("company_id")
                ->references("company_id")
                ->on("companies")
                ->onCascade("delete");

            $table->string("email", 120)->nullable()->unique();
            $table->string("phone", 35)->nullable()->unique();

            /*
             * NOTE: I presume one person can be in one work place.
             * Otherwise I would make another table who links them.
             */

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
