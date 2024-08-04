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
        Schema::create('project_users', function (Blueprint $table) {
            if (!Schema::hasColumn('project_users', 'id')) {
                $table->id();
            }
            if (!Schema::hasColumn('project_users', 'project_id')) {
                $table->unsignedBigInteger('project_id');
                $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')
                ->onDelete('cascade');;
            }
            if (!Schema::hasColumn('project_users', 'user_id')) {
                $table->Integer('user_id');
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('project_users');
        Schema::table('project_users', function($table)
        {
            if (Schema::hasColumn('project_users', 'id')) {
                $table->dropColumn('id');
            }
            if (Schema::hasColumn('project_users', 'project_id')) {
                $table->dropForeign(['project_id']);
                $table->dropColumn('project_id');
            }
            if (Schema::hasColumn('project_users', 'user_id')) {
                $table->dropColumn('user_id');
            }
            $table->dropTimestamps();
        });
    }
};
