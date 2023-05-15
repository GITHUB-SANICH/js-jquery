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
        Schema::create('dzmodels', function (Blueprint $table) {
            $table->id();						//id
				$table->string('title');		//название - max (170)
				$table->mediumText('anons');	//анонс
				$table->integer('price');		//цена
				$table->string('category');	//категория
            //$table->timestamps(); метод, создающий в таблице дату создания и последнего редактирования...бвшее название таблици ("dzmodels")
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dzmodels');
    }
};
