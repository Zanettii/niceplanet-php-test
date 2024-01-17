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
        //SoftDeletes servem para colocar na tabela um campo que diz que aquele objeto na tabela foi deletado
        Schema::create('produtors', function (Blueprint $table) {
            $table->uuid('idProdutor')->primary();
            $table->string('nomeProdutor');
            $table->string('cpfProdutor');
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('produtors');
    }
};
