<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <title>@yield('title') - {{ env('APP_NAME') }}</title>

        <link href="{{ asset('template/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('template/img/favicon.png') }}" rel="apple-touch-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <style>
            p {
                font-size: 12px !important;
            }

            table {
                font-size: 12px !important;
            }
        </style>
    </head>
    <body class="container">

        <div class="row mt-5">
            <div class="col-12 col-sm-12 offset-md-2 col-md-2 offset-lg-2 col-lg-2 text-center">
                <img src="{{ url('template/img/favicon.png') }}" class="img-fluid" width="100" height="100" alt="{{ env('APP_GOV') }}">
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <h5>
                    {{ env('APP_GOV') }} <br>
                    {{ env('APP_DEP') }}
                </h5>
                <h6>{{ $product->description ?? '---' }}</h6>
            </div>

            <div class="col-12 col-sm-12 offset-md-2 col-md-8 offset-lg-2 col-lg-8 mt-3">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ORGÃO</th>
                            <th scope="col" colspan="4" class="text-center">{{ $client->name }}</th>
                        </tr>
                        <tr>
                            <th scope="col">PERÍODO</th>
                            <th scope="col" colspan="4" class="text-center">
                                <span>{{ \Carbon\Carbon::parse($dateStart)->format('d/m/Y') }} até {{ \Carbon\Carbon::parse($dateEnd)->format('d/m/Y') }}</span>
                            </th>                                                       
                        </tr>
                        <tr>
                            <th scope="col">DIA</th>
                            <th scope="col" class="text-center">{{ $product->name ?? '---' }}</th>
                            <th scope="col" class="text-center">VALOR</th>
                            <th scope="col" class="text-center">TOTAL DO DIA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prices as $price)
                            <tr>
                                <td>{{ $price->created_at->format('d/m/Y') }}</td>
                                <td class="text-center">{{ $price->amount }}</td>
                                <td class="text-center">R$ {{ number_format($price->product->value, 2, ',', '.') }}</td>
                                <td class="text-center">R$ {{ number_format($price->value, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td>TOTAL DE {{ $product->name ?? '---' }}</td>
                                <td class="text-center">{{ $price->sum('amount') }}</td>
                                <td class="text-center">TOTAL DO MÊS</td>
                                <td class="text-center">R$ {{ number_format($price->sum('value'), 2, ',', '.') }}</td>
                            </tr>
                    </tbody>
                </table>

                <p class="mt-3 lead mb-5">
                    {{ \Carbon\Carbon::now()->locale('pt-BR')->translatedFormat('l, d \d\e F \d\e Y') }}
                </p>                
            </div>

            <div class="col-12 col-sm-12 offset-md-3 col-md-6 offset-lg-3 col-lg-6 text-center mb-5">
                <hr>
                Supervisor do setor
            </div>

            <div class="col-12 col-sm-12 offset-md-3 col-md-6 offset-lg-3 col-lg-6 text-center mt-5">
                <p class="lead"><b>{!! env('APP_ADDRESS') !!}</b></p>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            window.onload = function () {
                setTimeout(() => {
                    window.print();
                }, 500);
            };
        </script>
    </body>
</html>
