@extends('app.layout')
@section('title') Listagem de Produtos @endsection
@section('conteudo')

<div class="col-sm-12 col-md-12 col-lg-12 card mb-3 p-5">
    <div class="row g-0">

        <div class="col-12">
            <div class="btn-group" role="group">
                <button type="button" data-bs-toggle="modal" data-bs-target="#newProduct" class="btn btn-dark">Novo Produto</button>
                <button type="button" class="btn btn-outline-dark"><i class="ri-file-excel-2-line"></i> Excel</button>
                <button type="button" class="btn btn-outline-dark"><i class="bx bxs-file-pdf"></i> PDF</button>
            </div>
        </div>

        <div class="modal fade" id="newProduct" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cadastro de Produto:</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('create-product') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="name:">
                                        <label for="name">Nome</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="value" class="form-control" id="value" placeholder="Valor:">
                                        <label for="value">Valor</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-floating mb-2">
                                        <textarea name="description" class="form-control" placeholder="Descrição" style="height: 100px;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-dark">Cadastrar Produto</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-3">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Detalhes</th>
                            <th scope="col" class="text-center">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>
                                    {{ $product->name }} <br>
                                    <span class="badge bg-dark">{{ $product->description }}</span>
                                </td>
                                <td>
                                    {{ $product->value }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('delete-product') }}" method="POST" class="btn-group delete" role="group">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#editProduct{{ $product->id }}" class="btn btn-outline-warning"><i class="ri-edit-box-line"></i></button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editProduct{{ $product->id }}" tabindex="-1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Dados do Usuário:</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('update-product') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                                        <div class="form-floating mb-2">
                                                            <input type="text" name="name" class="form-control" id="name" placeholder="name:" value="{{ $product->name }}">
                                                            <label for="name">Nome</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                        <div class="form-floating mb-2">
                                                            <input type="text" name="value" class="form-control" id="value" placeholder="Valor:" value="{{ $product->value }}">
                                                            <label for="value">Valor</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                        <div class="form-floating mb-2">
                                                            <textarea name="description" class="form-control" placeholder="Descrição" style="height: 100px;">{{ $product->description }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-dark">Atualizar Produto</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </div>

    </div>
</div>
@endsection