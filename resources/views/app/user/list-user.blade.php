@extends('app.layout')
@section('title') Listagem de usuários @endsection
@section('conteudo')

<div class="col-sm-12 col-md-12 col-lg-12 card mb-3 p-5">
    <div class="row g-0">

        <div class="col-12">
            <div class="btn-group" role="group">
                <button type="button" data-bs-toggle="modal" data-bs-target="#cadastraruser" class="btn btn-dark">Novo Usuário</button>
                <button type="button" class="btn btn-outline-dark"><i class="ri-file-excel-2-line"></i> Excel</button>
                <button type="button" class="btn btn-outline-dark"><i class="bx bxs-file-pdf"></i> PDF</button>
            </div>
        </div>

        <div class="modal fade" id="cadastraruser" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cadastro de Usuário:</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('create-user') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="name:" required>
                                        <label for="name">name</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="cpfcnpj" class="form-control" id="cpfcnpj" placeholder="CPF ou CNPJ" required>
                                        <label for="cpfcnpj">CPF ou CNPJ</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-floating mb-2">
                                        <select class="form-select" name="role" id="role" aria-label="Atribuições do usuário">
                                            <option selected="2">Tipo de usuário</option>
                                            <option value="user">Colaborador</option>
                                            <option value="admin">Administrador</option>
                                            <option value="client">Cliente</option>
                                        </select>
                                        <label for="role">Atribuições do usuário</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="isento" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">ISENTO</label>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-floating mb-2">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required>
                                        <label for="email">E-mail</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Telefone">
                                        <label for="phone">Telefone</label>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="postal_code" class="form-control" id="postal_code" placeholder="CEP">
                                        <label for="postal_code">CEP</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="num" class="form-control" id="n" placeholder="N°">
                                        <label for="n">N°</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="address" class="form-control" id="address" placeholder="Endereço">
                                        <label for="address">Endereço</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="state" class="form-control" id="state" placeholder="Estado">
                                        <label for="state">Estado</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-floating mb-2">
                                        <input type="text" name="city" class="form-control" id="city" placeholder="Cidade">
                                        <label for="city">Cidade</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-dark">Cadastrar Usuário</button>
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
                            <th scope="col">Usuário</th>
                            <th scope="col">Detalhes</th>
                            <th scope="col" class="text-center">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>
                                    {{ $user->name }} <br>
                                    <small>{{ $user->cpfcnpj }}</small>
                                </td>
                                <td>
                                    {{ $user->phone }} | {{ $user->email }} <br>
                                    <span class="badge bg-dark">{{ $user->postal_code }} - {{ $user->address }}</span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('delete-user') }}" method="POST" class="btn-group delete" role="group">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#editaruser{{ $user->id }}" class="btn btn-outline-warning"><i class="ri-edit-box-line"></i></button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editaruser{{ $user->id }}" tabindex="-1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Dados do Usuário:</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('update-user') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                        <div class="form-floating mb-2">
                                                            <input type="text" name="name" class="form-control" id="name" placeholder="name:" value="{{ $user->name }}">
                                                            <label for="name">name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-floating mb-2">
                                                            <input type="text" name="cpfcnpj" class="form-control" id="cpfcnpj" placeholder="CPF ou CNPJ" value="{{ $user->cpfcnpj }}">
                                                            <label for="cpfcnpj">CPF ou CNPJ</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                        <div class="form-floating mb-2">
                                                            <select class="form-select" name="role" id="role" aria-label="Atribuições do usuário">
                                                                <option value="{{ $user->role }}" selected>{{ $user->roleLabel() }}</option>
                                                                <option value="user">Colaborador</option>
                                                                <option value="admin">Administrador</option>
                                                                <option value="client">Cliente</option>
                                                            </select>
                                                            <label for="role">Atribuições do usuário</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" name="isento" id="flexSwitchCheckChecked" @checked($user->isento == 1)>
                                                            <label class="form-check-label" for="flexSwitchCheckChecked">ISENTO</label>
                                                        </div>
                                                    </div>
                    
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-floating mb-2">
                                                            <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" value="{{ $user->email }}">
                                                            <label for="email">E-mail</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-floating mb-2">
                                                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Telefone" value="{{ $user->phone }}">
                                                            <label for="phone">Telefone</label>
                                                        </div>
                                                    </div>
                    
                                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                        <div class="form-floating mb-2">
                                                            <input type="text" name="postal_code" class="form-control" id="postal_code" placeholder="CEP" value="{{ $user->postal_code }}">
                                                            <label for="postal_code">CEP</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                                                        <div class="form-floating mb-2">
                                                            <input type="text" name="num" class="form-control" id="n" placeholder="N°" value="{{ $user->num }}">
                                                            <label for="n">N°</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-floating mb-2">
                                                            <input type="text" name="address" class="form-control" id="address" placeholder="Endereço" value="{{ $user->address }}">
                                                            <label for="address">Endereço</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-floating mb-2">
                                                            <input type="text" name="state" class="form-control" id="state" placeholder="Estado" value="{{ $user->state }}">
                                                            <label for="state">Estado</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-floating mb-2">
                                                            <input type="text" name="city" class="form-control" id="city" placeholder="Cidade" value="{{ $user->city }}">
                                                            <label for="city">Cidade</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-dark">Atualizar Usuário</button>
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