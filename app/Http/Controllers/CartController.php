<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $book = Book::find($request->book_id);
 if($book->count<$request->quantity)
 {

        return response()->json(['success' => false,'message'=>'the request number of books is not available ', 'count' => $book->count],201);


 }
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $cartItem = $cart->items()->updateOrCreate(
            ['book_id' => $request->book_id],
            [
                'quantity' => $request->quantity,
                'price' => $book->price, // Assuming 'price' is a field in the 'books' table
                'total_price' => $book->price * $request->quantity,
            ]
        );
        
        $data['count']=$book->count-$request->quantity;
         $book->update($data);
  
        return response()->json(['success' => true, 'cartItem' => $cartItem]);
    }

    public function viewCart()
    {
        $cart = Cart::where('user_id', Auth::id())->with('items.book')->first();

        if (!$cart) {
            return response()->json(['success' => true, 'cart' => []]);
        }

        return response()->json(['success' => true, 'cart' => $cart]);
    }
    public function totalpricetocart()
    {$cart = Cart::where('user_id', Auth::id())->with('items.book')->first();

    $total=0;
if (!$cart) {
            return response()->json(['success' => true, 'total' => $total]);
        }
        else
        foreach($cart->items as $item)
        $total=$total+($item->total_price);
                    return response()->json(['success' => true, 'total' => $total]);

    }

    public function updateCartItem(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::find($id);
                $book = Book::find($cartItem->book_id);

   if($book->count<$request->quantity)
 {

        return response()->json(['success' => false,'message'=>'the request number of books is not available ', 'count' => $book->count],201);


 }
        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
        }

        $cartItem->update([
            'quantity' => $request->quantity,
            'total_price' => $cartItem->price * $request->quantity,
        ]);

        return response()->json(['success' => true, 'cartItem' => $cartItem]);
    }

    public function removeCartItem($id)
    {
        $cartItem = CartItem::find($id);

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
        }

        $cartItem->delete();

        return response()->json(['success' => true, 'message' => 'Cart item removed']);
    }

    public function bill()
    {

        $cart = Cart::where('user_id', Auth::id())->with('items.book')->first();

    $total=0;
if (!$cart) {
            return response()->json(['success' => true, 'total' => $total]);
        }
        else
        foreach($cart->items as $item)
        if(!$item->complete)
        {$total=$total+($item->total_price);


        }
     return response()->json(['success' => true, 'total' => $total]);


    }
   public function pay_bill()
   {
       
   } 
}
