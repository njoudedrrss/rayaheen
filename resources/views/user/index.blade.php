<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>
    <h1>Users</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table border="1">
        <thead>
            <tr>
                          <th>ID</th>
                <th>Name</th>

                <th>Email </th>
                <th>Image Profile </th>
                <th>Carts  </th>

                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                                 <td>{{ $user->id }}</td>

                 <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                     <td>
 @if ($user->image_profile)
                        <img src="{{ asset('storage/image_profile/' . $user->image_profile) }}"  width="100">
                    @else
                        No image
                    @endif

      
                    </td>
                    <td>
                                            <a href="{{ route('user.cart', $user) }}">Carts</a>                    </td>
                    </td>
                    <td>


                        <a href="{{ route('user.edit', $user) }}">Edit</a>
                   <form action="{{ route('user.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                        
                    </td>
                   
                    <td>
                </tr>
            @endforeach
        </tbody>

    </table>

</body>
</html>
