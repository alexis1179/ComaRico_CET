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
        Schema::create('orden_platillo', function (Blueprint $table) {
            $table->id();
        $table->foreignId('orden_id')->constrained('ordenes')->onDelete('cascade');
        $table->foreignId('platillo_id')->constrained('platillos')->onDelete('cascade');
        $table->integer('cantidad');
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
        Schema::dropIfExists('orden_platillo');
    }
};
