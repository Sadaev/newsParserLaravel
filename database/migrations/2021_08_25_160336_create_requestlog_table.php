<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestlog', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('request_method');
            $table->string('request_url');
            $table->string('response_http_code');
            $table->text('response_body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requestlog');
    }
}
