<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvatoProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envato_products', function (Blueprint $table) {
            $table->id();
            $table->string('envato_id')->unique();
            $table->string('name')->unique()->nullable();
            $table->string('author_name')->unique()->nullable();
            $table->string('url')->unique()->nullable();
            $table->string('thumbnail')->unique()->nullable();
            $table->string('github_repo')->unique();
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
        Schema::dropIfExists('envato_products');
    }
}
