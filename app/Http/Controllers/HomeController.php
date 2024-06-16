<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function get_customers()
    {
        $users = User::all();

        if ($users->count() > 0) {
            return response()->json([
                'status' => 200,
                'Message' => $users,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'Message' => 'No records found',
            ], 200);
        }
    }

    // Function to create a new user
    public function create_users(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'status' => 201,
            'message' => "Customer created successfully.",
        ], 201);
    }

    public function show_users($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'status' => 200,
                'Message' => $user,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'Message' => 'User not found',
            ], 200);
        }
    }

    // Function to update a specific user by ID
    public function update_users(Request $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'status' => 404,
            'Message' => 'User not found',
        ], 200);
    }

    $validator = Validator::make($request->all(), [
        'first_name' => 'sometimes|required|string|max:255',
        'last_name' => 'sometimes|required|string|max:255',
        'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
        'phone' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255',
        'password' => 'nullable|string|min:8',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'Message' => $validator->errors(),
        ], 422);
    }

    $user->update($request->only(['first_name', 'last_name', 'email', 'phone', 'address']));

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
        $user->save();
    }

    return response()->json([
        'status' => 200,
        'Message' => 'User updated successfully',
        'User' => $user,
    ], 200);

}
    // Function to delete a specific user by ID
    public function delete_users($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'Message' => 'User not found',
            ], 200);
        }

        $user->delete();

        return response()->json([
            'status' => 200,
            'Message' => 'User deleted successfully',
        ], 200);
    }

    private function getCartCount()
    {
        return Auth::check() ? Cart::where('user_id', Auth::id())->count() : null;
    }
    public function home()
    {
        $products = Product::all();
        $count = $this->getCartCount();
        return view('home.homepage', compact('products', 'count'));
    }

    public function login_home()
    {
        $products = Product::all();
        $count = $this->getCartCount();
        return view('home.homepage', compact('products', 'count'));
    }

    public function view_products($id)
    {
        $product = Product::find($id);
        $count = $this->getCartCount();

        if (!$product) {
            return redirect()->route('home')->with('error', 'Product not found.');
        }

        return view('home.view_products', compact('product', 'count'));
    }

    public function about()
    {
        $count = $this->getCartCount();
        return view('home.about', compact('count'));
    }

    public function shop()
    {
        $count = $this->getCartCount();
        return view('home.shop', compact('count'));
    }

    public function contact()
    {
        $count = $this->getCartCount();
        return view('home.contact', compact('count'));
    }
    public function add_cart($id)
    {
        $user = Auth::user();
        $product_id = $id;

        if ($user) {
            $product = new Cart;
            $product->user_id = $user->id;
            $product->product_id = $product_id;
            $product->save();

            // Use session flash message
            session()->flash('success', 'Product added to cart successfully.');

            // Redirect back to the previous page
            return redirect()->back();
        }

        // Return an error response if the user is not authenticated
        return response()->json(['error' => 'User not authenticated'], 401);
    }


    public function mycart()
    {
        $userId = Auth::id();
        $count = Cart::where('user_id', $userId)->count();
        $cart = Cart::where('user_id', $userId)->get();

        return view('home.mycart', compact('count', 'cart'));
    }

    public function updateQuantity(Request $request, $cartId)
    {
        $cartItem = Cart::find($cartId);
        $newQuantity = $request->input('quantity');

        if ($newQuantity >= 1 && $newQuantity <= 8) {
            $cartItem->quantity = $newQuantity;
            $cartItem->save();
        }

        return response()->json(['success' => true, 'newTotal' => $cartItem->quantity * $cartItem->product->product_price]);
    }

    public function checkout(Request $request)
{
    // Validate the input fields
    $request->validate([
        'first_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'payment_method' => 'required|string|max:50',
    ]);

    $user = Auth::user();
    $userId = $user->id;
    $cartItems = Cart::where('user_id', $userId)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    DB::beginTransaction();

    try {
        foreach ($cartItems as $cartItem) {
            $order = new Order();
            $order->name = $request->first_name;
            $order->delivery_address = $request->address;
            $order->phone_no = $request->phone;
            $order->payment_method = $request->payment_method;
            $order->user_id = $userId;
            $order->product_id = $cartItem->product_id;
            $order->quantity = $cartItem->quantity;
            $order->save();
        }

        // Clear the user's cart after checkout
        Cart::where('user_id', $userId)->delete();

        DB::commit();

        toastr()->closeButton()->timeOut(5000)->addSuccess('Thank you for your purchase! Will Contact you soon.');
    } catch (\Exception $e) {
        DB::rollBack();
        toastr()->closeButton()->timeOut(5000)->addError('There was an error processing your order. Please try again.');
        return redirect()->back()->with('error', 'There was an error processing your order.');
    }

    return redirect()->route('home')->with('success', 'Order placed successfully!');
}

    public function deleteCartItem($id)
{
    $cartItem = Cart::find($id);
    if ($cartItem) {
        $cartItem->delete();
        // toastr()->closeButton()->timeOut(5000)->addSuccess('Item removed from cart.');
    } else {
        toastr()->closeButton()->timeOut(5000)->addError('Item not found.');
    }

    return redirect()->route('mycart')->with('success', 'Item removed successfully!');
}


    public function showCart()
{
    $userId = Auth::id();
    $cartItems = Cart::where('user_id', $userId)->get();

    return view('home.mycart', compact('cartItems'));
}

}

