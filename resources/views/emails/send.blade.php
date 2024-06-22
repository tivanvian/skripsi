<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Email</title>
</head>
<body>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Transaction Details</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Unit</th>
                                <th>Qty</th>
                                <th>Batch Unit</th>
                                <th>Batch Stock</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data->detail as $item)
                            {{-- {{ dd($item) }} --}}
                                <tr>
                                    <td>{{ $item->productunit->product->name }}</td>
                                    <td>{{ $item->productunit->name }}</td>
                                    <td>{{ $item->qty }} {{ $item->unit_slug }}</td>
                                    <td>{{ $item->batch_unit }}</td>
                                    <td>{{ $item->productunit->stocks }}</td>
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
