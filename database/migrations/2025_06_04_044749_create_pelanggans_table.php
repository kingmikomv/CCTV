<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
    {
       Schema::create('pelanggans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade'); // link ke users
    $table->string('nama');
    $table->string('no_hp');
    $table->text('alamat');
    $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('pelanggans');
    }
};
