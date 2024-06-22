<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi Sedang di proses</title>
</head>
<body>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Transaksi Detail - {{ $data["code"] }}</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Unit</th>
                                <th>Qty</th>
                                {{-- <th>Batch Unit</th>
                                <th>Batch Stock</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail as $key => $item)
                                <tr>
                                    <td>{{ getProductUnit($item["product_unit_id"])->product->name }}</td>
                                    <td>{{ getProductUnit($item["product_unit_id"])->name }}</td>
                                    <td>{{ $item["qty"] }} {{ $item["unit_slug"] }}</td>
                                    {{-- <td>{{ $item["batch_unit"] }}</td>
                                    <td>{{ getProductUnit($item["product_unit_id"])->stocks }}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
