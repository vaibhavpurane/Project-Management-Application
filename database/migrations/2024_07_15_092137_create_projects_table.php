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
        Schema::create('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'id')) {
                $table->id();
            }
            if (!Schema::hasColumn('projects', 'name')) {
                $table->string('name');
            }
            if (!Schema::hasColumn('projects', 'start_date')) {
                $table->date('start_date');
            }
            if (!Schema::hasColumn('projects', 'active')) {
                $table->tinyInteger('active');
            }
            if (!Schema::hasColumn('projects', 'created_at')) {
                $table->timestamps();
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function($table)
        {
            if (Schema::hasColumn('projects', 'id')) {
                $table->dropColumn('id');
            }
            if (Schema::hasColumn('projects', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('projects', 'start_date')) {
                $table->dropColumn('start_date');
            }
            if (Schema::hasColumn('projects', 'active')) {
                $table->dropColumn('active');
            }

            $table->dropTimestamps();

        });
    }
};
