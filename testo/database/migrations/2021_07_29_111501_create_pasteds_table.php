<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePastedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasteds', function (Blueprint $table) {
            $table->id();
            $table-> integer(column:"authorId")->nullable()->default(NULL);
            $table->boolean(column: 'anon');
            $table->boolean(column: 'forall');
            $table->string(column: 'subject');
            $table->text(column: 'message');
            $table->integer(column: 'lifetime');
            $table->string(column: 'hash')->unique();
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
        Schema::dropIfExists('pasteds');
    }
}
