<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const TABLE = 'thermostats';

    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('owner_id')->constrained('owners');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
};
