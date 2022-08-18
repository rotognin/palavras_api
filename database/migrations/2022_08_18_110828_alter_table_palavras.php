<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePalavras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('palavras', function(Blueprint $table){
            $table->integer('letras'); // Número de letras da palavra
            $table->unique('palavra', 'unica_palavra');
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
            $table->dropColumn('letras');
            $table->dropIndex('unica_palavra');
        });
    }
}
