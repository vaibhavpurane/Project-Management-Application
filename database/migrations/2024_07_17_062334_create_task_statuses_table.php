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
        Schema::create('task_statuses', function (Blueprint $table) {
            if (!Schema::hasColumn('task_statuses', 'id')) {
                $table->id();
            }
            if (!Schema::hasColumn('task_statuses', 'name')) {
                $table->string('name');
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_statuses', function($table)
        {
            if (Schema::hasColumn('task_statuses', 'id')) {
                $table->dropColumn('id');
            }
            if (Schema::hasColumn('task_statuses', 'name')) {
                $table->dropColumn('name');
            }
            $table->dropTimestamps();
        });
    }
};
