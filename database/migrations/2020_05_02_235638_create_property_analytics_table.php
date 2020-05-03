<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_analytics', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('analytic_type_id');
            $table->text('value');

            $table->unique(['property_id', 'analytic_type_id']);

            $table->foreign('property_id')
                  ->references('id')
                  ->on('properties');

            $table->foreign('analytic_type_id')
                  ->references('id')
                  ->on('analytic_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_analytics', function (Blueprint $table) {
            $table->dropForeign('property_analytics_property_id_foreign');
//            $table->dropForeign('property_analytics_analytic_type_id_foreign');
        });
        Schema::dropIfExists('property_analytics');
    }
}
