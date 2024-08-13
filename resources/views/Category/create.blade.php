<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Category</title>
</head>
<body>
    <h1>Add New Category </h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('Category.store') }}" method="POST" enctype="multipart/form-data">>
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
        </div>
       
      
        
        
        
          <div>
        <label for="cover_image">Cover Image:</label>
        <input type="file" id="cover_image" name="cover_image">
    </div>
         
            </select>
        </div>
        <button type="submit">Add Category</button>
    </form>
</body>
</html>
