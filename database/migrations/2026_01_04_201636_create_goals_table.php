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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('measure_both')->default(false);
            $table->foreignId('persona_id')->nullable()->constrained('personas');
            $table->integer('order')->default(0);
            $table->integer('year')->default(2026);
            $table->boolean('show')->default(true);
            $table->timestamps();
        });

        DB::table('goals')->insert([
            [
                'order' => 1,
                'title' => 'Do monthly meetings where we reflect on our spendings and deposit savings',
                'description' => null,
                'measure_both' => false,
                'persona_id' => null,
                'show' => false,
                'year' => 2026,
            ],
            [
                'order' => 2,
                'title' => 'Do weekly meetings to monitor the progress on our goals and to discuss our life',
                'description' => null,
                'measure_both' => false,
                'persona_id' => null,
                'show' => false,
                'year' => 2026,
            ],
            [
                'order' => 4,
                'title' => 'Go on a holiday in South East Asia → Save €4000 and schedule this.',
                'description' => null,
                'measure_both' => false,
                'persona_id' => null,
                'show' => true,
                'year' => 2026,
            ],
            [
                'order' => 5,
                'title' => 'Save €700 per month',
                'description' => null,
                'measure_both' => false,
                'persona_id' => null,
                'show' => true,
                'year' => 2026,
            ],
            [
                'order' => 6,
                'title' => 'Eat healthy',
                'description' => null,
                'measure_both' => false,
                'persona_id' => null,
                'show' => true,
                'year' => 2026,
            ],
            [
                'order' => 7,
                'title' => 'Make room for intimacy',
                'description' => null,
                'measure_both' => false,
                'persona_id' => null,
                'show' => true,
                'year' => 2026,
            ],
            [
                'order' => 8,
                'title' => 'Keep the house clean and organized',
                'description' => null,
                'measure_both' => false,
                'persona_id' => null,
                'show' => true,
                'year' => 2026,
            ],
            [
                'order' => 9,
                'title' => 'Read 25 pages every week',
                'description' => null,
                'measure_both' => true,
                'persona_id' => null,
                'show' => true,
                'year' => 2026,
            ],
            [
                'order' => 10,
                'title' => 'Sport 4 times per week',
                'description' => null,
                'measure_both' => false,
                'persona_id' => 1,
                'show' => true,
                'year' => 2026,
            ],
            [
                'order' => 11,
                'title' => 'Buy 1 ETF every month',
                'description' => null,
                'measure_both' => false,
                'persona_id' => 1,
                'show' => true,
                'year' => 2026,
            ],
            [
                'order' => 12,
                'title' => 'Work for 8 hours on my side business every week',
                'description' => null,
                'measure_both' => false,
                'persona_id' => 1,
                'show' => true,
                'year' => 2026,
            ],
            [
                'order' => 13,
                'title' => 'Work out my career path for the next 5 years',
                'description' => 'What are my options?',
                'measure_both' => false,
                'persona_id' => 1,
                'show' => true,
                'year' => 2026,
            ],
            [
                'order' => 14,
                'title' => 'Sport 5 times per week',
                'description' => null,
                'measure_both' => false,
                'persona_id' => 2,
                'show' => true,
                'year' => 2026,
            ],
            [
                'order' => 15,
                'title' => 'Study 4 hours per (work)day',
                'description' => null,
                'measure_both' => false,
                'persona_id' => 2,
                'show' => true,
                'year' => 2026,
            ],
            [
                'order' => 16,
                'title' => 'Make time for hobbys: bordado e cozinhar',
                'description' => null,
                'measure_both' => false,
                'persona_id' => 2,
                'show' => true,
                'year' => 2026,
            ],
            [
                'order' => 17,
                'title' => 'Less social media',
                'description' => null,
                'measure_both' => false,
                'persona_id' => 2,
                'show' => true,
                'year' => 2026,
            ],
            [
                'order' => 18,
                'title' => 'Pass the gyneacology test in november 2026',
                'description' => null,
                'measure_both' => false,
                'persona_id' => 2,
                'show' => true,
                'year' => 2026,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
