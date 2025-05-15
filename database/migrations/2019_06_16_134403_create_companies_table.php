<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('companies', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
          
            $table->string('identification_number')->unique();
            $table->char('dv', 1)->nullable();
            $table->unsignedBigInteger('language_id');
      
            $table->unsignedBigInteger('tax_id');
          
            $table->unsignedBigInteger('type_environment_id');
         
            $table->unsignedBigInteger('type_operation_id');
      
            $table->unsignedBigInteger('type_document_identification_id');
         
            $table->unsignedBigInteger('country_id');
          
            $table->unsignedBigInteger('type_currency_id');
      
            $table->unsignedBigInteger('type_organization_id');
      
            $table->unsignedBigInteger('type_regime_id');
         
            $table->unsignedBigInteger('type_liability_id');
        
            $table->unsignedBigInteger('municipality_id');
   
            $table->string('merchant_registration');
            $table->string('address');
            $table->string('phone');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('companies');
    }
}
