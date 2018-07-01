<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_details', function (Blueprint $table) {
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            $table->increments('id');
            $table->string('name', 256);
            $table->text('caption');
            $table->integer('video');
            $table->integer('poster')->default(0);
            $table->integer('sort')->default(1);
            $table->integer('lesson_id');
            $table->integer('created_user_id')->default(0);
            $table->integer('updated_user_id')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_media');
    }
}
