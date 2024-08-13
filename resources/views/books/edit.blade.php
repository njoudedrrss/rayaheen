<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
</head>
<body>
    <h1>Edit Book</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
        @method('PUT')
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="{{ $book->title }}" required>
        </div>
        <div>
            <label for="author">Author</label>
            <input type="text" id="author" name="author" value="{{ $book->author }}" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" required>{{ $book->description }}</textarea>
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" id="price" name="price" value="{{ $book->price }}" required>
        </div>
          <div>
            <label for="publisher">Publisher:</label>
            <input type="text" id="publisher" name="publisher" value="{{ $book->publisher }}" required>
        </div>
        <div>
            <label for="year">Year:</label>
            <input type="text" id="year" name="year" value="{{ $book->year }}" required>
        </div>
         <div>
            <label for="count">Count:</label>
            <input type="text" id="count" name="count" value="{{ $book->count }}" required>
        </div>
    <div>
        <label for="cover_image">Cover Image:</label>
        <input type="file" id="cover_image" name="cover_image" required>{{ $book->cover_image }}</file>
    </div>
     <div>
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit">Update Book</button>
        </div>
    </form>

    <a href="{{ route('books.index') }}">Back to Books</a>
</body>
</html>
