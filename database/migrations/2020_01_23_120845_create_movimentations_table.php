<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('solicitation_id')->index();
            $table->foreign('solicitation_id')->references('id')->on('solicitations');

            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');

            $table->enum('status', ['ABERTO', 'PROCESSANDO', 'FINALIZADO'])->nullable();

            $table->text('observation')->nullable();
            $table->text('annotation')->nullable();
            $table->boolean('is_public')->nullable();

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
        Schema::dropIfExists('movimentations');
    }
}
