<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('our_story')->nullable()->after('profile');
            $table->string('SKU', 10)->after('product_name');
            $table->string('origin', 100)->after('interested');
            $table->smallInteger('available')->after('interested');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('our_story');
            $table->dropColumn('SKU');
            $table->dropColumn('origin');
            $table->dropColumn('available');
        });
    }
}
