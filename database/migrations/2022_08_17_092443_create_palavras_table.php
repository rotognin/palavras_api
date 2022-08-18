<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePalavrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palavras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('palavra', 40);
            $table->boolean('status'); // True se a palavra estiver ativa, False caso inativa
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('palavras');
    }
}
