<?php

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
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('appName')->nullable();
            $table->string('appLogo')->nullable();
            $table->string('sessionExpiration')->nullable();
            $table->string('pagination')->nullable();
            $table->string('filePath')->nullable();
            $table->string('fileName')->nullable();
            $table->string('themeMode')->nullable();
            $table->string('accentColor')->nullable();
            $table->string('subAccentColor')->nullable();
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
        Schema::dropIfExists('app_settings');
    }
};
