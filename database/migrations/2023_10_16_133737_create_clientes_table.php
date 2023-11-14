<?php

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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // Cria uma coluna 'id' que será a chave primária da tabela.
            $table->string('nome'); // Cria uma coluna 'nome' para armazenar o nome do cliente.
            $table->string('endereco'); // Cria uma coluna 'endereco' para armazenar o endereço do cliente.
            $table->string('cidade'); // Cria uma coluna 'cidade' para armazenar a cidade do cliente.
            $table->string('cep'); // Cria uma coluna 'cep' para armazenar o CEP do cliente.
            $table->string('telefone'); // Cria uma coluna 'telefone' para armazenar o telefone do cliente.
            $table->text('public_key')->nullable(); // Cria uma coluna 'public_key' para armazenar a chave pública do cliente.
            $table->text('private_key')->nullable(); // Cria uma coluna 'private_key' para armazenar a chave privada do cliente.
            $table->unsignedBigInteger('public_key_id')->nullable(); // Cria uma coluna 'public_key_id' como chave estrangeira para a tabela 'keys'.
            $table->unsignedBigInteger('private_key_id')->nullable(); // Cria uma coluna 'private_key_id' como chave estrangeira para a tabela 'keys'.
            $table->foreign('public_key_id')->references('id')->on('keys')->onDelete('cascade'); // Define a relação de chave estrangeira para 'public_key_id'.
            $table->foreign('private_key_id')->references('id')->on('keys')->onDelete('cascade'); // Define a relação de chave estrangeira para 'private_key_id'.
            $table->timestamps(); // Adiciona colunas 'created_at' e 'updated_at' para rastrear timestamps de criação e atualização de registros.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
