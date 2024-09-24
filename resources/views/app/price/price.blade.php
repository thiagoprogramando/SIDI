@extends('app.layout')
@section('title') Cotação @endsection
@section('conteudo')

    @if(empty($client))
        <div class="col-sm-12 col-md-12 col-lg-12 card mb-3 p-5">
            <div class="row g-0">
                <form action="{{ route('price') }}" method="GET" class="col-12 col-sm-12 col-md-12 col-lg-12 row">
                    <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                        <select id="swal-users" name="client_id" placeholder="Escolha um Cliente">
                            <option value="" selected>Escolha um Cliente</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" >{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                        <button type="submit" class="btn btn-block btn-dark"><i class="bx bx-search"></i> Avançar</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="col-sm-12 col-md-12 col-lg-12 card mb-3 p-5">
            <div class="row g-0">
                <h3 class="display-6">Cotação</h3>
                <hr>

                <div class="col-12">
                    <div class="btn-group" role="group">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createPrice" class="btn btn-dark modal-swal"><i class="bx bxs-message-alt-add"></i> Criar</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#filterPrice" class="btn btn-outline-dark modal-swal"><i class="bi bi-ui-checks"></i> Filtros</button>
                        <a href="{{ route('price-excel', request()->query()) }}" class="btn btn-outline-dark"><i class="ri-file-excel-2-line"></i> Excel</a>
                        <a href="{{ route('price-pdf', request()->query()) }}" target="_blank" class="btn btn-outline-dark"><i class="bx bxs-file-pdf"></i> PDF</a>
                    </div>

                    <div class="modal fade" id="createPrice" tabindex="-1" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cadastro de Cotação:</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('create-price') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="client_id" value="{{ request('client_id') }}">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-2">
                                                <select id="swal-products" name="product_id" placeholder="Escolha um Produto">
                                                    <option value="" selected>Escolha um Produto</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}" @selected(request('product_id') == $product->id)>{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="mb-2">
                                                    <input type="text" name="amount" class="form-control" placeholder="Quantidade:">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="mb-2">
                                                    <input type="date" name="created_at" class="form-control" placeholder="Data:" value="{{ date('Y-m-d') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-dark">Cadastrar cotação</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="filterPrice" tabindex="-1" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Pesquisa de Cotação:</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('price') }}" method="GET">
                                    <input type="hidden" name="client_id" value="{{ request('client_id') }}">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-2">
                                                <select id="swal-product" name="product_id" placeholder="Escolha um Produto">
                                                    <option value="" selected>Escolha um Produto</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}" @selected(request('product_id') == $product->id)>{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="dateStart" class="form-control" id="floatingDateStart" placeholder="Data Inicial" value="{{ request('dateStart') }}">
                                                    <label for="floatingDateStart">Data Inicial</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="dateEnd" class="form-control" id="floatingDateEnd" placeholder="Data Final" value="{{ request('dateEnd') }}">
                                                    <label for="floatingDateEnd">Data Final</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-dark">Buscar cotação</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col" class="text-center">Quantidade</th>
                                    <th scope="col" class="text-center">Valor</th>
                                    <th scope="col" class="text-center">Total</th>
                                    <th scope="col" class="text-center">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prices as $key => $price)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $price->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $price->product->name }}</td>
                                        <td class="text-center">{{ $price->amount }}</td>
                                        <td class="text-center">R$ {{ number_format($price->product->value, 2, ',', '.') }}</td>
                                        <td class="text-center">R$ {{ number_format($price->value, 2, ',', '.') }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('delete-price') }}" method="POST" class="btn-group delete" role="group">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $price->id }}">
                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#updatePrice{{ $price->id }}" class="btn btn-outline-warning"><i class="ri-edit-box-line"></i></button>
                                            </form>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="updatePrice{{ $price->id }}" tabindex="-1" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detalhes da Cotação:</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('update-price') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $price->id }}">
                                                    <input type="hidden" name="client_id" value="{{ $price->client_id }}">
                                                    <input type="hidden" name="product_id" value="{{ $price->product_id }}">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                                <div class="mb-2">
                                                                    <input type="text" name="amount" class="form-control" placeholder="Quantidade:">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                                <div class="mb-2">
                                                                    <input type="date" name="created_at" class="form-control" placeholder="Data:" value="{{ date('Y-m-d') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Fechar</button>
                                                            <button type="submit" class="btn btn-dark">Atualizar cotação</button>
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
    @endif

    <script>
        $('.modal-swal').click(function(){
            var products = new TomSelect("#swal-products", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                maxItems: 1,
            });

            var product = new TomSelect("#swal-product", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                maxItems: 1,
            });
        });

        @if (empty($client))
            var users = new TomSelect("#swal-users", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                maxItems: 1,
            });
        @endif
    </script>
@endsection