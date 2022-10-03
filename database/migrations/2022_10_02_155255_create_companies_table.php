<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            // All column names are matching with the CSV's heading row
            $table->id('companyId');
            $table->string('companyName');
            $table->string('companyRegistrationNumber')->unique();
            $table->date('companyFoundationDate');
            $table->string('country');
            $table->string('zipCode');
            $table->string('city');
            $table->string('streetAddress');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('companyOwner');
            $table->unsignedInteger('employees');
            $table->string('activity');
            $table->boolean('active');
            $table->string('email')->index();
            $table->string('password');
        });

        DB::unprepared('
            CREATE TRIGGER disallow_modifying_companyFoundationDate
            BEFORE UPDATE ON `companies`
            FOR EACH ROW
            BEGIN
                IF NEW.companyFoundationDate <> OLD.companyFoundationDate THEN
                    SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Modifying this column is not allowed.";
                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `disallow_modifying_companyFoundationDate`;');
        Schema::dropIfExists('companies');
    }
}
