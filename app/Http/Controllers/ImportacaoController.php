<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;

//models utilizadas
use App\Models\User;
use App\Models\Category;
use App\Models\Document;

//jobs utilizados
use App\Jobs\ProcessDocumento;



class ImportacaoController extends Controller
{

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

            //percorre array de documentos
            foreach($objPHP->documentos as $documento){

                //dd($documento);

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


        //sugestão de melhoria 1
        //botão de Iniciar fila disponível apenas se fila não está vazia


        return view('queuescreen');

    }

    public function runQueue(Request $request){ // run queue


        $exitCode = Artisan::call('queue:work --stop-when-empty');

        //sugestão de melhoria 2
        // Laravel Horizon para monitorar filas



        Session::flash('success__', 'processamento da fila concluído.');

        return redirect()->route('queueScreen');

    }



}
