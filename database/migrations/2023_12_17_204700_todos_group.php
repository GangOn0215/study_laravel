<?php

use App\Models\Todos;
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
        //
        Schema::create('todos_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 그룹 이름
            $table->integer('depth');
            $table->integer('sequence'); // 순서
            $table->string('color'); // 그룹에 입힐 색상
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
        Schema::dropIfExists('todos_groups');
    }
};
