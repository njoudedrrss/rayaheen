<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>
<body>
    <h1>Orders</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table border="1" >
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Quantity</th>

                <th>Price </th>
                <th>Total Price  </th>
                <th>Complete  </th>
                <th>Payment Date  </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($cartitem as $item)
                <tr>
                                 <td>{{ $item->book_id }}</td>

                 <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                     <td>

      {{$item->total_price}}
                    </td>
               <td>
               {{$item->complete}}
               </td>
               <td>
               {{$item->payment_date}}
               </td>
                   
                    <td>
                </tr>
            @endforeach
        </tbody>

    </table>

</body>
</html>
