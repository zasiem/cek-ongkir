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
        <form action="{{ url('/process') }}" method="post">
            @csrf
            <div class="row bg-white p-5">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="province_origin" class="font-weight-bold">Province Origin</label>
                        <select name="province_origin" id="province_origin" class="form-control">
                            <option value="">Choose Province Origin</option>
                            @foreach($provinces as $province)
                            <option value="{{ $province->province_id }}">{{ $province->province }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="city_origin" class="font-weight-bold">City Origin</label>
                        <select name="city_origin" id="city_origin" class="form-control">
                            <option value="">Choose City Origin</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="province_destination" class="font-weight-bold">Province Destination</label>
                        <select name="province_destination" id="province_destination" class="form-control">
                            <option value="">Choose Province Destination</option>
                            @foreach($provinces as $province)
                            <option value="{{ $province->province_id }}">{{ $province->province }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="city_destination" class="font-weight-bold">City Destination</label>
                        <select name="city_destination" id="city_destination" class="form-control">
                            <option value="">Choose City Destination</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="weight" class="font-weight-bold">Weight (Gram)</label>
                        <input type="text" class="form-control" name="weight" placeholder="Minimum 1 gram">
                    </div>
                </div>
                <div class="col-sm-12">
                    <button class="btn btn-dark" type="submit">Check Ongkir</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#province_origin').on('change', function() {
                let province_id = $(this).val();
                loadCities("city_origin", province_id);
            });

            $('#province_destination').on('change', function() {
                let province_id = $(this).val();
                loadCities("city_destination", province_id);
            });

            function loadCities(id, province_id) {
                $.ajax({
                    url: "/get-cities",
                    method: 'post',
                    data: {
                        province_id: province_id
                    },
                    success: function(response) {
                        $('#' + id + ' option').remove();
                        $('#' + id).append("<option value=''>Choose City Origin</option>");
                        response.map(data => {
                            $('#' + id).append("<option value='" + data.city_id + "'>" + data.city_name + "</option>");
                        });
                    },
                });
            }
        });
    </script>
</body>

</html>