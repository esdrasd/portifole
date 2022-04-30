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
        Schema::create('model_cruds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome'); //senderName
            $table->string('cpf');  //senderCPF && creditCardHolderCPF
            $table->string('ddd');  //senderAreaCode
            $table->string('telefone'); //senderPhone && creditCardHolderPhone
            $table->string('email'); //senderEmail
            $table->string('enderecoNome'); //shippingAddressStreet && billingAddressStreet
            $table->string('enderecoNumero');  //shippingAddressNumber && billingAddressNumber
            $table->string('complemento');  //shippingAddressComplement && billingAddressComplement
            $table->string('bairro');   //shippingAddressDistrict && billingAddressDistrict
            $table->string('cep');  //shippingAddressPostalCode && billingAddressPostalCode
            $table->string('cidade');   //shippingAddressCity && billingAddressCity
            $table->string('estado');   //shippingAddressState && billingAddressState
            $table->string('pais'); //shippingAddressCountry && billingAddressCountry
            $table->string('dataNascimento'); //creditCardHolderBirthDate
            $table->string('areaCode'); //creditCardHolderAreaCode
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
        Schema::dropIfExists('model_cruds');
    }
};
