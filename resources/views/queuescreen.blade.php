@extends('layouts.admin')

@section('content')

    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <h4 class="page-title">Dispara o processamento da fila</h4>
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
                        <form action="{{ route('runQueue') }}" method="POST" class="form-horizontal form-material" id="formRunQueue">

                            @csrf


                            <div class="row">
                                <div class="col-md-1 col-sm-12 col-xs-12 p-0 mb-2">
                                    <button type="submit" id="submitbutton" class="btn btn-success" onclick="document.getElementById('submitbutton').disabled = true; document.getElementById('submitbutton').style.opacity='0.5'; document.getElementById('formRunQueue').submit();" >Processar Fila</button>
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