<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('solicitation_id')->index();
            $table->foreign('solicitation_id')->references('id')->on('solicitations');

            $table->string('file_name')->nullable();
            $table->string('description')->nullable();

            $table->unsignedBigInteger('user_id')->index()->comment('Usuário que visualizou o arquivo por primeiro')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('downloaded')->default(false)->comment('O dia que foi baixado o arquivo');
            $table->dateTime('download_date')->nullable()->comment("dia que o arquivo foi baixado");
            $table->boolean('approved')->nullable()->comment('Se o documento foi aprovado');

            $table->text('observation')->nullable();
            $table->text('annotation')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
