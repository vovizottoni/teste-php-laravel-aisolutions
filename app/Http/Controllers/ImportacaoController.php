<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;

//models utilizadas
use App\Models\User;
use App\Models\Category;
use App\Models\Document;

//Exceptions utilizadas
use App\Exceptions\CampoConteudoTamanhoInvalidoException;
use App\Exceptions\RegistroInvalidoException;


//jobs utilizados
use App\Jobs\ProcessDocumento;



class ImportacaoController extends Controller
{


    public $tamanhoMaximoConteudo = 1260;




    public function fileScreen(){ //action para Tela de leitura do arquivo storage/data/2023-03-28.json


        return view('filescreen');

    }

    public function readFileAndDispatch(Request $request){ //leitura e dispatch de cada document para queue


      if($request->hasFile('arquivo')) {

        // Lê arquivo .JSON (submetido pelo formulário e armazenado no diretório temporário do servidor, /tmp ... )
        $file  = $request->file('arquivo');
        $fileContent = file_get_contents($file);
        $objPHP = json_decode($fileContent);



        if(is_array($objPHP->documentos) && count($objPHP->documentos) > 0){ // se tem pelo menos 1 documento


            /////////////////////////////////////////////////////////////////////////////
            //Validações (Testes Unitários)
                // optei por não usar validate nem rule do Laravel (verificação manual e dispara exception em caso de problema)

            try {

                $this->validaCampoConteudoTamanho($objPHP);

            } catch (CampoConteudoTamanhoInvalidoException $exception) {

                Session::flash('error__', $exception->getMessage());
                return redirect()->route('fileScreen');
            }

            try {

                $this->validaCategoriaETitulo($objPHP);

            } catch (RegistroInvalidoException $exception) {

                Session::flash('error__', $exception->getMessage());
                return redirect()->route('fileScreen');
            }


            // IMplementar teste 2
            // IMplementar teste 2
            // IMplementar teste 2

            //obs apos implementar validações, testar se o arquivo storage/data/2023-03-28.json continua funcionando normalmente.
            /////////////////////////////////////////////////////////////////////////////






            //percorre array de documentos
            foreach($objPHP->documentos as $documento){

                //Coloca o $documento na fila de processamento
                ProcessDocumento::dispatch($documento->categoria, $documento->titulo, $documento->conteúdo);

            }

            Session::flash('success__', 'Importação adicionada na fila de processamento. Acesse a tela iniciar-fila para concluir o processo.');

        }else{

            Session::flash('error__', 'Arquivo .json vazio!');

        }

      }else{

        Session::flash('error__', 'Selecione o arquivo .json!');

      }

      return redirect()->route('fileScreen');


    }




    public function queueScreen(){


        return view('queuescreen');

    }

    public function runQueue(Request $request){ // run queue


        $exitCode = Artisan::call('queue:work --stop-when-empty');

        //sugestão de melhoria
        // Laravel Horizon para monitorar filas

        //em produção (unix), supervisor é útil para garantir a disponibilidade da(s) fila(s)

        Session::flash('success__', 'processamento da fila concluído.');

        return redirect()->route('queueScreen');

    }


    private function validaCampoConteudoTamanho(&$objPHP){ //verifica se algum campo conteúdo desrespeita o tamanho máximo permitido


        //percorre array de documentos
        foreach($objPHP->documentos as $documento){

            if(mb_strlen($documento->conteúdo, 'utf8') > $this->tamanhoMaximoConteudo){

                throw new CampoConteudoTamanhoInvalidoException('Documento com conteúdo maior que '.$this->tamanhoMaximoConteudo.' caracteres');
            }

        }

    }

    private function validaCategoriaETitulo(&$objPHP){

        //percorre array de documentos
        foreach($objPHP->documentos as $documento){


            $tituloMinusculo = strtolower($documento->titulo);

            if($documento->categoria == 'Remessa'){

                if (!str_contains($tituloMinusculo, 'semestre')) {

                    throw new RegistroInvalidoException('Registro inválido');

                }

            }else if($documento->categoria == 'Remessa Parcial'){

                if (!str_contains($tituloMinusculo, 'janeiro') && !str_contains($tituloMinusculo, 'fevereiro') && !str_contains($tituloMinusculo, 'março') && !str_contains($tituloMinusculo, 'abril')
                    && !str_contains($tituloMinusculo, 'maio') && !str_contains($tituloMinusculo, 'junho') && !str_contains($tituloMinusculo, 'julho')  && !str_contains($tituloMinusculo, 'agosto')
                    && !str_contains($tituloMinusculo, 'setembro')  && !str_contains($tituloMinusculo, 'outubro')  && !str_contains($tituloMinusculo, 'novembro')  && !str_contains($tituloMinusculo, 'dezembro')
                ) {

                    throw new RegistroInvalidoException('Registro inválido');

                }

            }

            // em PHP, existem outras opções de busca em string (regex c/ preg_match ...)
        }
    }



}
