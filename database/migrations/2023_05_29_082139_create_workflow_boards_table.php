<?php

use App\Models\WorkflowTemplate;
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
        Schema::create('workflow_boards', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WorkflowTemplate::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('order')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workflow_boards');
    }
};
