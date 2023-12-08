<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

use App\Exceptions\CampoConteudoTamanhoInvalidoException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


class DocumentTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_exception_if_document_length_is_more_than_maximum_allowed(): void
    {

        // Simula um upload do arquivo teste1.json
        $jsonFile = UploadedFile::fake()->createWithContent('teste1.json', Storage::get('teste1.json'));



        //Simula a requisição post deste arquivo jsonFile para a rota denominada readFileAndDispatch

        $response = $this->postJson(route('readFileAndDispatch'), [
           'arquivo' => $jsonFile,
        ]);


        //verifica se na sessão da aplicação em teste existe a mensagem da exceção CampoConteudoTamanhoInvalidoException

        $sessionData = $this->app['session']->all();
        $attributeExists = array_key_exists('error__', $sessionData);

        $this->assertTrue($attributeExists);
        $this->assertEquals("Documento com conteúdo maior que 1260 caracteres", $sessionData['error__']);


    }
}
