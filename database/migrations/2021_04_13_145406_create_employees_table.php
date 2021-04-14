<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');//obli
            $table->string('lastname');//obli
            $table->string('slug');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');//obli
            $table->string('email')->nullable();//Parece que no son obligatorios
            $table->string('phone')->nullable();//Parece que no son obligatorios
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
