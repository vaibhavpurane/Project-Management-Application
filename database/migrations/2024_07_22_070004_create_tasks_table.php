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
        Schema::create('tasks', function (Blueprint $table) {
            if (!Schema::hasColumn('tasks', 'id')) {
                $table->id();
            }
            if (!Schema::hasColumn('tasks', 'name')) {
                $table->string('name')->requied();
            }
            if (!Schema::hasColumn('tasks', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('tasks', 'milestone_id')) {
                $table->unsignedBigInteger('milestone_id')->required();
                $table->foreign('milestone_id')->references('id')->on('milestones')->onUpdate('cascade')
                ->onDelete('cascade');
            }
            if (!Schema::hasColumn('tasks', 'status_id')) {
                $table->unsignedBigInteger('status_id')->required();
                $table->foreign('status_id')->references('id')->on('task_statuses')->onUpdate('cascade')
                ->onDelete('cascade');
            }
            if (!Schema::hasColumn('tasks', 'assign_id')) {
                $table->unsignedBigInteger('assign_id')->nullable();
                $table->foreign('assign_id')->references('id')->on('users')->onUpdate('cascade')
                ->onDelete('cascade');
            }

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function($table){
            if (Schema::hasColumn('tasks', 'id')) {
                $table->dropColumn('id');
            }
            if (Schema::hasColumn('tasks', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('tasks', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('tasks', 'milestone_id')) {
                $table->dropForeign(['milestone_id']);
                $table->dropColumn('milestone_id');
            }
            if (Schema::hasColumn('tasks', 'status_id')) {
                $table->dropForeign(['status_id']);
                $table->dropColumn('status_id');
            }
            if (Schema::hasColumn('tasks', 'assign_id')) {
                $table->dropForeign(['assign_id']);
                $table->dropColumn('assign_id');
            }
            $table->dropTimestamps();
            $table->dropSoftDeletes();
        });
    }
};
