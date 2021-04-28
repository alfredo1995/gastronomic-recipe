<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceitasTable extends Migration
{
    /**
     * Run the migrations.
     *  
     * @return void
     */
    public function up()
    {
        //nome das respectivas tabelas no banco
        Schema::create('receitas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id'); 
            $table->string('receita', 200);
            $table->string('Cadastrar_Receita', 500);
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
        Schema::dropIfExists('receitas');
    }
}
