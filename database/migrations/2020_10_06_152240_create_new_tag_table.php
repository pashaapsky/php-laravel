<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTagTable extends Migration
{
    public function up()
    {
        Schema::create('new_tag', function (Blueprint $table) {
            $table->foreignId('new_id')->constrained('news')->onDelete('Cascade');
            $table->foreignId('tag_id')->constrained('tags')->onDelete('Cascade');

            $table->primary(['new_id', 'tag_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('new_tag');
    }
}
