<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hu_alarms', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('logSNumber')->nullable();
            $table->string('oIName')->nullable();
            $table->string('objIden')->nullable();
            $table->string('nType')->nullable();
            $table->string('identity')->nullable();
            $table->string('aSource')->nullable();
            $table->string('eAlrmSN')->nullable();
            $table->string('aName')->nullable();
            $table->string('type')->nullable();
            $table->string('sev')->nullable();
            $table->string('status')->nullable();
            $table->string('oTime')->nullable();
            $table->string('ackTime')->nullable();
            $table->string('cTime')->nullable();
            $table->string('unAckOper')->nullable();
            $table->string('clrOper')->nullable();
            $table->string('locInfor')->nullable();
            $table->string('lnkFDN')->nullable();
            $table->string('lnkName')->nullable();
            $table->string('ltype')->nullable();
            $table->string('alrmIdent')->nullable();
            $table->string('alrmId')->nullable();
            $table->string('oType')->nullable();
            $table->string('autoClear')->nullable();
            $table->string('aCType')->nullable();
            $table->string('busaffected')->nullable();
            $table->string('addText')->nullable();
            $table->string('arriUtcTime')->nullable();
            $table->string('lstid')->nullable();
            $table->string('relLogId')->nullable();
            $table->string('aid')->nullable();
            $table->string('rid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hu_alarms');
    }
};
