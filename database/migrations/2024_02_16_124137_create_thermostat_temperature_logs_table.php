<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const TABLE = 'thermostat_temperature_logs';

    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('thermostat_id')->constrained();
            $table->string('temperature');
            $table->timestamp('logged_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
};
