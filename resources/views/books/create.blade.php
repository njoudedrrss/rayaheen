<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New E-book</title>
</head>
<body>
    <h1>Add New E-book</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">>
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}">
        </div>
        <div>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" value="{{ old('author') }}">
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ old('description') }}"></textarea>
        </div>
      
        <div>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="{{ old('price') }}">
        </div>
        <div>
            <label for="publisher">Publisher:</label>
            <input type="text" id="publisher" name="publisher" value="{{ old('publisher') }}">
        </div>
        <div>
            <label for="year">Year:</label>
            <input type="text" id="year" name="year" value="{{ old('year') }}">
        </div>
         <div>
            <label for="count">Count:</label>
            <input type="text" id="count" name="count" value="{{ old('count') }}">
        </div>
          <div>
        <label for="cover_image">Cover Image:</label>
        <input type="file" id="cover_image" name="cover_image">
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
        <button type="submit">Add E-book</button>
    </form>
</body>
</html>
