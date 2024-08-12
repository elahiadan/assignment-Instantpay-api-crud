<?php

use App\Models\Task;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Task::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(Task::NAME);
            $table->text(Task::DESCRIPTION);
            $table->foreignId(Task::BOARD_ID)->constrained()->onDelete(Task::CASCADE);
            $table->foreignId(Task::USER_ID)->constrained()->onDelete(Task::CASCADE);
            $table->integer(Task::STATUS)->default(Task::PENDING);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Task::TABLE);
    }
};
