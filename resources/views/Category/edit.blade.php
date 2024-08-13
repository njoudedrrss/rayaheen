<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
</head>
<body>
    <h1>Edit Category</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('Category.update',  $Category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
        @method('PUT')
        <div>
            <label for="title">Name</label>
            <input type="text" id="title" name="name" value="{{ $Category->name }}" required>
        </div>
       
            <div>
        <label for="cover_image">Cover Image:</label>
        <input type="file" id="cover_image" name="cover_image">
    </div>
      
        <div>
            <button type="submit">Update Category</button>
        </div>
    </form>

    <a href="{{ route('Category.index') }}">Back to Books</a>
</body>
</html>
