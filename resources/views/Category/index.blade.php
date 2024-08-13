<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
    <h1>Categories</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table border="1">
        <thead>
            <tr>
                          <th>ID</th>
                <th>Name</th>

                <th>Cover Image</th>

                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $categore)
                <tr>
                 <td>{{ $categore->id }}</td>
                    <td>{{ $categore->name }}</td>
                     <td>
 @if ($categore->cover_image)
                        <img src="{{ asset('storage/cover_images/' . $categore->cover_image) }}"  width="100">
                    @else
                        No image
                    @endif

      
                    </td>
                    <td>
                        <a href="{{ route('Category.edit', $categore) }}">Edit</a>
                   <form action="{{ route('Category.destroy', $categore) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this Category?')">Delete</button>
                        </form>
                        
                    </td>
                   
                    <td>
                </tr>
            @endforeach
        </tbody>

    </table>
                          <a href="{{ route('Category.create') }}">Add new categore</a>

</body>
</html>
