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
                <form method="POST" action="/produtos">
                    @method('POST')
                    @csrf

                    <div class="row">
                        @include('include.message')

                        <div class="col-md-4 mb-3">
                            <label for="">Descrição <span class="text-danger">*</span></label>
                            <input type="text" name="descricao" placeholder="Descrição" class="form-control"
                                value="{{ old('descricao', null) }}" />
                            @if ($errors->has('descricao'))
                                <span class="text-danger">{{ $errors->first('descricao') }}</span>
                            @endif
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="">Preço Unitário <span class="text-danger">*</span></label>
                            <input type="number" name="preco_unitario" placeholder="Preço Unitário" class="form-control"
                                value="{{ old('preco_unitario', null) }}" />
                            @if ($errors->has('preco_unitario'))
                                <span class="text-danger">{{ $errors->first('preco_unitario') }}</span>
                            @endif
                        </div>


                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
