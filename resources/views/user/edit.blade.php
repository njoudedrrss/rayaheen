<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.update',  $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
        @method('PUT')
        <div>
            <label for="title">Name</label>
            <input type="text" id="title" name="name" value="{{ $user->name }}" required>
        </div>
       
            <div>
        <label for="image_profile"> Image Profile:</label>
        <input type="file" id="image_profile" name="image_profile">
    </div>
      
        <div>
            <button type="submit">Update User Info</button>
        </div>
    </form>

    <a href="{{ route('user.index') }}">Back to Users</a>
</body>
</html>
