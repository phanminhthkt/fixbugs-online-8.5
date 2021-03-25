<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('photo',255)->nullable();
            $table->string('contract_code',50)->nullable();
            $table->string('file',255)->nullable();
            $table->integer('is_priority')->default(0);
            $table->integer('is_status')->default(1);
            $table->integer('is_active')->default(0);
            $table->integer('note')->nullable();
            $table->integer('link_design')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
