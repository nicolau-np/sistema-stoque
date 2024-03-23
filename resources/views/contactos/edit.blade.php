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
                <form method="POST" action="/contactos/{{ $contacto->id }}">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        @include('include.message')

                        <div class="col-md-4 mb-3">
                            <label for="">Descrição <span class="text-danger">*</span></label>
                            <input type="text" name="descricao" placeholder="Descrição" class="form-control"
                                value="{{ old('descricao', $contacto->descricao) }}" />
                            @if ($errors->has('descricao'))
                                <span class="text-danger">{{ $errors->first('descricao') }}</span>
                            @endif
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="">Província <span class="text-danger">*</span></label>
                            <input type="text" name="provincia" placeholder="Província" class="form-control"
                                value="{{ old('provincia', $contacto->provincia) }}" />
                            @if ($errors->has('provincia'))
                                <span class="text-danger">{{ $errors->first('provincia') }}</span>
                            @endif
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="">Município <span class="text-danger">*</span></label>
                            <input type="text" name="municipio" placeholder="Município" class="form-control"
                                value="{{ old('municipio', $contacto->municipio) }}" />
                            @if ($errors->has('municipio'))
                                <span class="text-danger">{{ $errors->first('municipio') }}</span>
                            @endif
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="">Morada <span class="text-danger">*</span></label>
                            <input type="text" name="morada" placeholder="Morada" class="form-control"
                                value="{{ old('morada', $contacto->morada) }}" />
                            @if ($errors->has('morada'))
                                <span class="text-danger">{{ $errors->first('morada') }}</span>
                            @endif
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="">Nº de Telefone </label>
                            <input type="text" name="telefone" placeholder="Nº de Telefone" class="form-control"
                                value="{{ old('telefone', $contacto->telefone) }}" />
                            @if ($errors->has('telefone'))
                                <span class="text-danger">{{ $errors->first('telefone') }}</span>
                            @endif
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="">Tipo de contacto <span class="text-danger">*</span></label>
                            <select name="tipo" class="form-control">
                                <option value="" hidden>Tipo de contacto</option>
                                <option value="Cliente" {{ old('tipo')=='Cliente'? 'selected': null }}>Cliente</option>
                                <option value="Fornecedor" {{ old('tipo')=='Fornecedor'? 'selected': null }}>Fornecedor</option>
                            </select>
                            @if ($errors->has('tipo'))
                                <span class="text-danger">{{ $errors->first('tipo') }}</span>
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
