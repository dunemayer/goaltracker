<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('measurables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('use_boolean')->default(true);
            $table->boolean('do_measurement')->default(false);
            $table->string('unit')->nullable()->default(null);
            $table->integer('integer_value')->nullable()->default(null);
            $table->string('string_value')->nullable()->default(null);
            $table->boolean('has_description')->default(false);
            $table->enum('check_in_type', ['monthly', 'weekly', 'final']);
            $table->foreignId('goal_id')->nullable()->constrained('goals')->nullOnDelete();
            $table->foreignId('persona_id')->nullable()->constrained('personas')->nullOnDelete();
            $table->timestamps();
        });

        DB::table('measurables')->insert([
            [
                'name' => 'Did you put aside at least €175 for the holiday this month?',
                'has_description' => true,
                'do_measurement' => true,
                'unit' => 'integer',
                'check_in_type' => 'monthly',
                'goal_id' => 3,
                'persona_id' => null,
            ],
            [
                'name' => 'Did you save at least €700 this month?',
                'check_in_type' => 'monthly',
                'has_description' => true,
                'do_measurement' => true,
                'unit' => 'integer',
                'goal_id' => 4,
                'persona_id' => null,
            ],
            [
                'name' => 'Did you eat healthy last week?',
                'unit' => 'boolean',
                'do_measurement' => false,
                'check_in_type' => 'weekly',
                'has_description' => true,
                'goal_id' => 5,
                'persona_id' => null,
            ],
            [
                'name' => 'Was there room for intimacy last week?',
                'check_in_type' => 'weekly',
                'has_description' => true,
                'do_measurement' => false,
                'unit' => null,
                'goal_id' => 6,
                'persona_id' => null,
            ],
            // Goal 7 has measure_both=true, so create for both personas
            [
                'name' => 'Did you keep the house clean and organized last week?',
                'check_in_type' => 'weekly',
                'has_description' => true,
                'do_measurement' => false,
                'unit' => null,
                'goal_id' => 7,
                'persona_id' => null,
            ],
            // Goal 8 has measure_both=true, so create for both personas
            [
                'name' => 'Did you read 25 pages of a book last week?',
                'check_in_type' => 'weekly',
                'has_description' => true,
                'do_measurement' => false,
                'unit' => null,
                'goal_id' => 8,
                'persona_id' => 1,
            ],
            [
                'name' => 'Did you read 25 pages of a book last week?',
                'check_in_type' => 'weekly',
                'has_description' => true,
                'do_measurement' => false,
                'unit' => null,
                'goal_id' => 8,
                'persona_id' => 2,
            ],
            [
                'name' => 'Did you sport at least 4 times last week?',
                'do_measurement' => true,
                'unit' => 'integer',
                'check_in_type' => 'weekly',
                'has_description' => true,
                'goal_id' => 9,
                'persona_id' => 1,
            ],
            [
                'name' => 'Did you buy an ETF?',
                'check_in_type' => 'monthly',
                'has_description' => true,
                'do_measurement' => false,
                'unit' => null,
                'goal_id' => 10,
                'persona_id' => 1,
            ],
            [
                'name' => 'Did you work 8 hours on your side business last week?',
                'check_in_type' => 'weekly',
                'has_description' => true,
                'do_measurement' => false,
                'unit' => null,
                'goal_id' => 11,
                'persona_id' => 1,
            ],
            [
                'name' => 'Any progress on career path development?',
                'check_in_type' => 'monthly',
                'has_description' => true,
                'do_measurement' => false,
                'unit' => null,
                'goal_id' => 11,
                'persona_id' => 1,
            ],
            [
                'name' => 'Did you sport at least 5 times last week?',
                'do_measurement' => true,
                'unit' => 'integer',
                'check_in_type' => 'weekly',
                'has_description' => true,
                'goal_id' => 12,
                'persona_id' => 2,
            ],
            [
                'name' => 'Did you study at least 4 hours every day last week?',
                'check_in_type' => 'weekly',
                'has_description' => true,
                'do_measurement' => false,
                'unit' => null,
                'goal_id' => 13,
                'persona_id' => 2,
            ],
            [
                'name' => 'Did you spend time on your hobby\'s: cozinhar e bordado last week?',
                'unit' => 'boolean',
                'do_measurement' => false,
                'check_in_type' => 'weekly',
                'has_description' => true,
                'goal_id' => 14,
                'persona_id' => 2,
            ],
            // all for the final check-in:
            [
                'name' => 'Did you pass the gyneacology test in november 2026?',
                'unit' => 'boolean',
                'do_measurement' => false,
                'check_in_type' => 'final',
                'has_description' => true,
                'goal_id' => 15,
                'persona_id' => 2,
            ],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurables');
    }
};
