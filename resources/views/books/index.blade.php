<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
</head>
<body>
    <h1>Books</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table border="1">
        <thead>
            <tr>
                          <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Description</th>
                 <th>Publisher</th> 
                 <th>Year</th>
                                  <th>Count</th>

                <th>Price</th>
                <th>Category</th>

                <th>Cover Image</th>

                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                 <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->description }}</td>
                      <td>{{ $book->publisher }}</td>
                        <td>{{ $book->year }}</td>
                                                 <td>{{ $book->count }}</td>

                    <td>{{ $book->price }}</td>
                        <td>{{ $book->category->name }}</td>
                     <td>
                        @if ($book->cover_image)
                        <img src="{{ asset('storage/cover_images/' . $book->cover_image) }}"  width="100">
                    @else
                        No image
                    @endif
                    </td>
                    <td>
                        <a href="{{ route('books.edit', $book) }}">Edit</a>
                   <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                        </form>
                        
                    </td>
                   
                    <td>
                </tr>
            @endforeach
        </tbody>

    </table>
                          <a href="{{ route('books.create') }}">Add new Book</a>

</body>
</html>
