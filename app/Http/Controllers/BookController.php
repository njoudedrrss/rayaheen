<?php
namespace App\Http\Controllers;

use App\Models\Book;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Make sure to import this

class BookController extends Controller
{
   
    public function index()
    {
       // $books = Book::all();
       // return view('books.index', compact('books'));
       return response()->json(Book::with('category')->get(), 200);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required|integer',

            'price' => 'required|numeric',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
                      'count' => 'required|integer',

        ]);
        $data = $request->all();

            if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('cover_images', 'public');
        }
          $book = Book::create($data);
                    $books = Book::all();

        return view('books.index', compact('books'));
    }
    

    public function show(Book $book)
    {
        return $book->load('category');
    }

    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'author' => 'sometimes|required',
            'publisher' => 'sometimes|required',
            'year' => 'sometimes|required|integer',

            'price' => 'sometimes|required|numeric',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'sometimes|required|exists:categories,id',
            'count' => 'sometimes|required|integer',

        ]);
   $book = Book::findOrFail($id);
   
  $data = $request->all();
  if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($book->cover_image) {
                Storage::delete('public/cover_images/' . $book->cover_image);
            }

            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/cover_images', $filename);
            $data['cover_image'] = $filename;
       
    }
    $book->update($data);

     $books = Book::all();
        return view('books.index', compact('books'));
    }


    public function destroy( $id)
    {
     $book = Book::find($id);

        if (!$book) {
            return redirect()->route('books.index')->with('error', 'Book not found');
        }

        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();
             $books = Book::all();

     //   return view('books.index', compact('books'));
               return redirect()->route('books.index')->with('success', 'Product deleted successfully.');

    }

    //in web
    public function edit(Book $book)
    { $categories = Category::all(); 
       // return view('books.create',compact('categories'));
        return view('books.edit', compact('book','categories'));
    }

    public function indexweb()
    {
      //  $books = Book::all();
         $books = Book::with('category')->get();

        // Map over the books to include the full URL for the cover image
        $books->map(function ($book) {
            if ($book->cover_image) {
                $book->cover_image_url = url('storage/' . $book->cover_image);
            } else {
                $book->cover_image_url = null;
            }
            return $book;
        });
        return view('books.index', compact('books'));
       // return Book::with('category')->get();
    }
      public function create()
    {
          $categories = Category::all(); 
        return view('books.create',compact('categories'));
    }

}
