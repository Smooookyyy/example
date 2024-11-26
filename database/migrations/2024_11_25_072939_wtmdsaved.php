<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Buat tabel dasar
        Schema::create('wtmdsaveds', function (Blueprint $table) {
            $table->id();
            $table->string('operatorName');
            $table->dateTime('testDateTime');
            $table->string('location');
            $table->string('deviceInfo');
            $table->string('certificateInfo');
            
            // Test results
            $table->boolean('resultPassIntest1')->default(false);
            $table->boolean('resultPassIntest2')->default(false);
            $table->boolean('resultPassIntest3')->default(false);
            $table->boolean('resultPassIntest4')->default(false);
            $table->boolean('resultPassOuttest1')->default(false);
            $table->boolean('resultPassOuttest2')->default(false);
            $table->boolean('resultPassOuttest3')->default(false);
            $table->boolean('resultPassOuttest4')->default(false);
            
            $table->enum('result', ['pass', 'fail'])->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['pending_supervisor', 'approved', 'rejected'])->default('pending_supervisor');
            $table->string('officerName')->nullable();
            $table->string('supervisorName')->nullable();
            $table->binary('officer_signature')->nullable();
            $table->binary('supervisor_signature')->nullable();
            $table->unsignedBigInteger('submitted_by');
            $table->timestamps();

            // Kolom tambahan
            $table->text('rejection_note')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->unsignedBigInteger('supervisor_id')->nullable();
        });

        // Step 2: Tambahkan foreign keys
        Schema::table('wtmdsaveds', function (Blueprint $table) {
            $table->foreign('reviewed_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            // Pastikan data submitted_by valid sebelum menambah constraint
            DB::statement('DELETE FROM wtmdsaveds WHERE submitted_by NOT IN (SELECT id FROM officers)');

            $table->foreign('submitted_by')
                ->references('id')
                ->on('officers')
                ->onDelete('cascade');

            $table->foreign('supervisor_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        // Step 3: Update data jika diperlukan
        if (DB::table('wtmdsaveds')->count() > 0) {
            $defaultSupervisor = DB::table('users')
                ->where('role', 'supervisor')
                ->first();

            if ($defaultSupervisor) {
                DB::table('wtmdsaveds')
                    ->whereNull('supervisor_id')
                    ->update(['supervisor_id' => $defaultSupervisor->id]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('wtmdsaveds', function (Blueprint $table) {
            $table->dropForeign(['reviewed_by']);
            $table->dropForeign(['submitted_by']);
            $table->dropForeign(['supervisor_id']);
        });

        Schema::dropIfExists('wtmdsaveds');
    }
};
