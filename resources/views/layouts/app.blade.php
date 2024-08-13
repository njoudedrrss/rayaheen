<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Include your styles and scripts here -->
</head>
<body>
    <nav>
     
       <ul>   <li><a href="{{ route('Category.index') }}">Manage Categories</a></li></ul>
          <ul>
    <li><a href="{{ route('books.index') }}">Manage Products</a></li></ul>

    <ul>  <li><a href="{{ route('user.index') }}">Manage Users</a></li></ul>

    <!-- Add other admin links here -->

    </nav>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>
