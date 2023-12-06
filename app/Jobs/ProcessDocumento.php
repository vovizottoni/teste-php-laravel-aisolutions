<?php

namespace App\Jobs;

use App\Models\Document;
use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessDocumento implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

     public $categoria;
     public $titulo;
     public $conteudo;


    public function __construct($categoria, $titulo, $conteudo)
    {

        $this->categoria = $categoria;
        $this->titulo = $titulo;
        $this->conteudo = $conteudo;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {


        //detecta a category_id associada
        $category = Category::where([['name', '=', $this->categoria]])->first();

        if($category){

            //insere
            Document::create(['category_id' => $category->id, 'title' => $this->titulo, 'contents' => $this->conteudo ]);

        }

    }
}
