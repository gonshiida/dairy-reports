<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatereportTypesTable extends Migration
{
   public function up()
    {
        Schema::create('report_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('amount')->nullable();
            $table->timestamps();
            
            $table->integer('report_id')->unsigned()->index();
            
            // 外部キー制約
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('report_types');
    }
}
