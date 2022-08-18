<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePalavras20220818002 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('palavras', function(Blueprint $table){
            $table->string('tipo', 40);
            $table->string('local', 40);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('palavras', function(Blueprint $table){
            $table->dropColumn('tipo');
            $table->dropColumn('local');
        });
    }
}
