<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('hp', 12)->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode', 5)->nullable();
            $table->string('state', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('hp');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('postcode');
            $table->dropColumn('state');
        });
    }
}
