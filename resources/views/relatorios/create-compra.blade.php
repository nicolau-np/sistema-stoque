@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $menu }}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="/relatorios/compra">
                    @method('POST')
                    @csrf

                    <div class="row">
                        @include('include.message')

                        <div class="col-md-4 mb-3">
                            <label for="">Data Inicial</label>
                            <input type="date" name="data_inicial" placeholder="Data Inicial" class="form-control" />
                            @if ($errors->has('data_inicial'))
                                <span class="text-danger">{{ $errors->first('data_inicial') }}</span>
                            @endif
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="">Data Final</label>
                            <input type="date" name="data_final" placeholder="Data Final" class="form-control" />
                            @if ($errors->has('data_final'))
                                <span class="text-danger">{{ $errors->first('data_final') }}</span>
                            @endif
                        </div>

                        <div class="col-md-3 pt-4 mb-3">
                            <button type="submit" class="btn btn-primary">Imprimir</button> 
                        </div>
                    </div>

                </form>
            </div>
        </div>

       
    </div>
@endsection
