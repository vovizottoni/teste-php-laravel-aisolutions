<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

use App\Exceptions\RegistroInvalidoException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_exception_segunda_regra_e_aplicada_parte1(): void
    {

        // Simula um upload do arquivo teste2.json
        $jsonFile = UploadedFile::fake()->createWithContent('teste2.json', Storage::get('teste2.json'));



        //Simula a requisição post deste arquivo jsonFile para a rota denominada readFileAndDispatch

        $response = $this->postJson(route('readFileAndDispatch'), [
           'arquivo' => $jsonFile,
        ]);


        //verifica se na sessão da aplicação em teste existe a mensagem da exceção CampoConteudoTamanhoInvalidoException

        $sessionData = $this->app['session']->all();
        $attributeExists = array_key_exists('error__', $sessionData);

        $this->assertTrue($attributeExists);
        $this->assertEquals("Registro inválido", $sessionData['error__']);



    }

    public function test_exception_segunda_regra_e_aplicada_parte2(): void
    {

        // Simula um upload do arquivo teste2_parte2.json
        $jsonFile = UploadedFile::fake()->createWithContent('teste2_parte2.json', Storage::get('teste2_parte2.json'));



        //Simula a requisição post deste arquivo jsonFile para a rota denominada readFileAndDispatch

        $response = $this->postJson(route('readFileAndDispatch'), [
           'arquivo' => $jsonFile,
        ]);


        //verifica se na sessão da aplicação em teste existe a mensagem da exceção CampoConteudoTamanhoInvalidoException

        $sessionData = $this->app['session']->all();
        $attributeExists = array_key_exists('error__', $sessionData);

        $this->assertTrue($attributeExists);
        $this->assertEquals("Registro inválido", $sessionData['error__']);



    }

}
