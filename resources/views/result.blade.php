<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <title>Cek Ongkir</title>
</head>

<body class="bg-light">
    <div class="container my-5">
        <div class="row my-5">
            <div class="col-sm-12">
                <h1 class="font-weight-bold text-center">Check Ongkir</h1>
                <p class="text-center">`ongkir` is an extension of the `ongkos kirim` a.k.a shipping cost.</p>
            </div>
        </div>
        <div class="row bg-white p-5">
            <div class="col-sm-12">
                <h3 class="font-weight-bold text-center mb-5">Results</h3>
            </div>
            @foreach($ongkirs as $ongkir)
            <div class="col-sm-4 px-3">
                <div class="my-2">
                    <h5 class="font-weight-bold text-center">{{ $ongkir->name }}</h5>
                    <hr>
                </div>
                @foreach($ongkir->costs as $cost)
                <div>
                    <div class="bg-light pl-3 pt-3">
                    <h6 class="font-weight-bold">{{ $cost->service }}</h6>
                    <p>{{ $cost->description }}</p>
                    <hr>
                    </div>
                    @foreach($cost->cost as $service)
                    <div>
                        <table class="table table-borderless">
                            <tr>
                                <td>Price</td>
                                <td>:</td>
                                <td>Rp. {{ $service->value }},-</td>
                            </tr>
                            <tr>
                                <td>Duration Estimation</td>
                                <td>:</td>
                                <td>{{ $service->etd }}</td>
                            </tr>
                        </table>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
            @endforeach
            <div class="col-sm-12 text-center">
                <a href="/" class="btn btn-dark w-25 mt-3">Back</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>