<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Make sure to import this

class CategoryController extends Controller
{
    public function index()
    {

         $categories = Category::with('books')->get();
      $categories = $categories->map(function ($category) {
            $category->id = (string) $category->id;
            $category->books = $category->books->map(function ($book) {
                $book->id = (string) $book->id;
                $book->category_id = (string) $book->category_id;
                return $book;
            });
            return $category;
        });
 //$categories = Category::all();
        return response()->json(['data'=>$categories,'status'=>'success'],200);    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
                        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
     $data = $request->only('name');

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/cover_images', $filename);
            $data['cover_image'] = $filename;
        }

        Category::create($data);

        return redirect()->route('Category.index')->with('success', 'Category added successfully.');
    }

       /// return view('category.index', compact('category'));
    

    public function show(Category $category)
    {
        return $category;
    }

    public function update(Request $request,  $id)
    {
        
              $validated = $request->validate([

            'name' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

   $category = Category::findOrFail($id);
        $data = $request->only('name');

        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($category->cover_image) {
                Storage::delete('public/cover_images/' . $category->cover_image);
            }

            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/cover_images', $filename);
            $data['cover_image'] = $filename;
        }

        $category->update($data);
      


   $category = Category::all();
        return view('Category.index', compact('category'));    }

    

    
         public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete cover image if exists
        if ($category->cover_image) {
            Storage::delete('public/cover_images/' . $category->cover_image);
        }

        // This will delete the category and all associated books
        $category->delete();

        return redirect()->route('Category.index')->with('success', 'Category and all associated books deleted successfully.');
    }
    


    public function indexweb(){

     $category = Category::all();
        return view('Category.index', compact('category'));

        // Map over the books to include the full URL for the cover image
        /*$books->map(function ($book) {
            if ($book->cover_image) {
                $book->cover_image_url = url('storage/' . $book->cover_image);
            } else {
                $book->cover_image_url = null;
            }
            return $book;
        });*/
}
public function edit(Category $Category)
    {
        return view('Category.edit', compact('Category'));
    }

     public function create()
    {
          $categories = Category::all(); 
        return view('category.create',compact('categories'));
    }

}
