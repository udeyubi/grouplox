<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateApiStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status')->default(0);
            $table->timestamps();
        });

        DB::table('api_statuses')->insert([
            ['name' => 'service'],
            ['name' => 'validate']]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_statuses');
    }
}
