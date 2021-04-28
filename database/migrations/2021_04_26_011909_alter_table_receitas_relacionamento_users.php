<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableReceitasRelacionamentoUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // class shema executando o metodo estatico table passando a tabela e a função de callback por paramentro $table
        schema::table('receitas', function(Blueprint $table) { 
            // executar o metodo UnsignedBigInteger user id q vai receber a chave estrageira da tabela user
             $table->UnsignedBigInteger('user_id')->nullable()->after('id');
             //adicicionar a foreign aplicada na coluna user id, referencia vem do id da tabela users
             $table->foreign('user_id')->references('id')->on('users');
    });


    public function down()
    {
        Schema::dropIfExists('receitas');
    }
}
