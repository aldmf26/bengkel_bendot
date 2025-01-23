<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Nama menu
            $table->string('icon')->nullable(); // Icon menu (optional)
            $table->string('link')->nullable(); // Link menu (optional)
            $table->integer('parent_id')->nullable(); // Parent ID untuk submenu
            $table->integer('order')->default(0); // Urutan menu
            $table->string('roles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
