<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

     //****************************************************************************************************************** */
     //****************************************************************************************************************** */
     //Primeira Tarefa


     // Ao tentar executar os comandos para rodar migrations e seeders (php artisan migrate , php artisan db:seed --class=CategorySeeder)
     // ocorreu um erro informando que a tabela categories já existia. Após uma análise, foi detectado que:
     // Neste projeto utilizou-se do recurso "Squashing Migrations", onde o desenvolvedor executou o comando "php artisan schema:dump --prune"
     // para gerar um dump do banco de dados que é armazenado em database/schema/sqlite-schema.sql e remover todas migrations existentes no momento que executou-se este comando

     //Este recurso é muito útil para acelerar a axecução das migrations e testes unitários, pois se o projeto tiver centenas ou milhares de migrations haverá um ganho de desempenho nessa compactação em um único arquivo (dump).


     // ### Problema 1:  ###
     // Após a execução do "Squashing Migrations", criaram duas migrations para criação de tabelas que já existem no dump (categories e documents). Desse modo, ao
     // rodar "php artisan migrate" pela primeira vez, o laravel rodará primeiro o dump e depois as migrations (database/migrations) e gerará um erro pois tentará criar estas tabelas novamente (já foram criadas através do dump).

     // ### Problema 2:  ###
     // Foi feito um "Squashing Migrations" para um banco de dados muito pequeno. Esta ação pode gerar dúvidas uma vez que o sistema está nascendo.



     //Solução/Melhorias:
        //Como a base é muito pequena e não existe ações de ALTER TABLE, optou-se por trazer as migrations de volta para a pasta migrations.
        //As migrations que vêm inicialmente com o Laravel foram adicionadas copiando-as de um "new Laravel 10 project", as migrations de categories e documents foram atualizadas conforme as SQLs do sqlite-schema.sql



     //****************************************************************************************************************** */
     //****************************************************************************************************************** */

    public function up(): void
    {

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 255);
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('categories');


    }
};
