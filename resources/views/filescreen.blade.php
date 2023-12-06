@extends('layouts.admin')

@section('content')

    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <h4 class="page-title">Importação de arquivos .json para Documents</h4>
        </div>
    </div>

    @if (session('success__'))
            <br>
            <div class="alert alert-success">
                {{ session('success__') }}
            </div>
    @endif

    @if (session('error__'))
            <br>
            <div class="alert alert-warning">
                {{ session('error__') }}
            </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-xlg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('readFileAndDispatch') }}" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group mb-3">
                                <label class="col-md-12 p-0 label-form-bold">Arquivo (.json)</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="file" name="arquivo" id="arquivo"  class="form-control p-0">

                                    @error('arquivo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-1 col-sm-12 col-xs-12 p-0 mb-2">
                                    <button type="submit" class="btn btn-success">Importar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@push('js-scripts')

    <script type="application/javascript">

        $(document).ready(function() {

            //Códigos Jquery específicos para esta view
            // ...

        });

    </script>
@endpush