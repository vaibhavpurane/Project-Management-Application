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
        Schema::create('milestones', function (Blueprint $table) {
            if (!Schema::hasColumn('milestones', 'id')) {
                $table->id();
            }
            if (!Schema::hasColumn('milestones', 'name')) {
                $table->string('name')->requied();
            }
            if (!Schema::hasColumn('milestones', 'due_date')) {
                $table->date('due_date')->nullable();
            }
            if (!Schema::hasColumn('milestones', 'project_id')) {
                $table->unsignedBigInteger('project_id');
                $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')
                ->onDelete('cascade');
            }
            if (!Schema::hasColumn('milestones', 'statuses_id')) {
                $table->unsignedBigInteger('statuses_id');
                $table->foreign('statuses_id')->references('id')->on('milestone_statuses')->onUpdate('cascade')
                ->onDelete('cascade');
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('milestones', function($table){
            if (Schema::hasColumn('milestones', 'id')) {
                $table->dropColumn('id');
            }
            if (Schema::hasColumn('milestones', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('milestones', 'due_date')) {
                $table->dropColumn('due_date');
            }
            if (Schema::hasColumn('milestones', 'project_id')) {
                $table->dropForeign(['project_id']);
                $table->dropColumn('project_id');
            }
            if (Schema::hasColumn('milestones', 'statuses_id')) {
                $table->dropForeign(['statuses_id']);
                $table->dropColumn('statuses_id');
            }
            $table->dropTimestamps();
        });
    }
};
