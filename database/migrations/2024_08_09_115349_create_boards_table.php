<?php

use App\Models\Board;
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
        Schema::create(Board::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(Board::NAME);
            $table->foreignId(Board::USER_ID)->constrained()->onDelete(Board::CASCADE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Board::TABLE);
    }
};
