<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{

    public function dashboard()
    {
        $total_product = Product::all()->count();
        $total_user = User::all()->count();
        $total_order = Order::all()->count();

        $order = Order::all();
        $total_revenue = 0;
        foreach ($order as $order) {
            $total_revenue = $total_revenue + $order->price;
        }



        return view('admin.dashboard', compact('total_product', 'total_order', 'total_user'));
    }
    public function view_category()
    {
        $data = Category::all();
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {

        $category = new Category;
        $category->category_name = $request->category;
        $category->save();
        toastr()->closeButton()->timeOut(5000)->addSuccess('Category has been Added Successfully.');

        return redirect()->back();
    }

    public function delete_category($id)
    {

        $data = Category::find($id);
        $data->delete();
        toastr()->closeButton()->timeOut(5000)->addInfo('Category has been Deleted Successfully.');

        return redirect()->back();
    }

    public function edit_category($id)
    {

        $data = Category::find($id);
        return view('admin.edit_category', compact('data'));
    }

    public function update_category(Request $request, $id)
    {
        $data = Category::find($id);
        $data->category_name = $request->category;
        $data->save();
        toastr()->closeButton()->timeOut(5000)->addSuccess('Category has been Updated Successfully.');
        return redirect('/view_category');
    }

    public function add_product()
    {

        $category = Category::all();
        return view('admin.add_product', compact('category'));
    }


    public function upload_product(Request $request)
    {
        $product = new Product;
        $product->product_name = $request->title;
        $product->product_description = $request->description;
        $product->product_price = $request->price;
        $product->product_quantity = $request->qty;
        $product->product_category = $request->category;

        $product_image = $request->image;
        if ($product_image) {
            // Define the image path
            $imagePath = 'products';

            // Check if the directory exists, if not, create it
            if (!File::exists(public_path($imagePath))) {
                File::makeDirectory(public_path($imagePath), 0755, true);
            }

            // Generate a unique name for the image
            $imagename = time() . '.' . $product_image->getClientOriginalExtension();

            // Move the image to the defined path
            $request->image->move(public_path($imagePath), $imagename);
            $product->product_image = $imagename;
        }

        $product->save();
        toastr()->closeButton()->timeOut(5000)->addSuccess('Product has been added successfully.');

        return redirect()->back();
    }

    public function view_product()
    {
        $product = Product::paginate(5);
        return view('admin.view_product', compact('product'));
    }

    public function delete_product($id)
    {
        $product = Product::find($id);

        // Correct the image path construction
        $image_path = public_path('products/' . $product->product_image);
        if (File::exists($image_path)) {
            // Use File facade to delete the image
            File::delete($image_path);
        }

        $product->delete();
        toastr()->closeButton()->timeOut(5000)->addSuccess('Product has been deleted successfully.');

        return redirect()->back();
    }

    public function update_product($id)
    {

        $product = Product::find($id);
        $category = Category::all();
        return view('admin.update_product', compact('product', 'category'));
    }

    public function edit_product(Request $request, $id)
    {
        $product = Product::find($id);
        $product->product_name = $request->title;
        $product->product_description = $request->description;
        $product->product_price = $request->price;
        $product->product_quantity = $request->quantity;
        $product->product_category = $request->category;

        $product_image = $request->image;
        if ($product_image) {
            // Get the image name with its extension
            $imagename = time() . '.' . $product_image->getClientOriginalExtension();

            $request->image->move('products', $imagename);
            $product->product_image = $imagename; // Update the column name to product_image
        }

        $product->save();
        toastr()->closeButton()->timeOut(5000)->addSuccess('Product has been updated successfully.');
        return redirect('/view_product');
    }

    public function product_search(Request $request)
    {
        $search = $request->search;
        $product = Product::where('product_name', 'LIKE', '%' . $search . '%')->orWhere('product_category', 'LIKE', '%' . $search . '%')->paginate(3);
        return view('admin.view_product', compact('product',));
    }

    public function view_order()
    {

        $product = Order::all();
        return view('admin.order', compact('product'));
    }

    public function out_for_delivery($id)
    {
        $product = Order::find($id);
        $product->status = 'Out for Delivery';
        $product->save();
        toastr()->closeButton()->timeOut(5000)->addSuccess('Order has been updated successfully.');
        return redirect('/view_order');
    }


    public function delivered($id)
    {
        $product = Order::find($id);
        $product->status = 'Delivered';
        $product->save();
        toastr()->closeButton()->timeOut(5000)->addSuccess('Order has been updated successfully.');
        return redirect('/view_order');
    }


    public function customer_data()
    {
        // Fetch all users
        $customers = User::all();

        // Return the view with customers data
        return view('admin.customer_data', ['customers' => $customers]);
    }

    public function api_add_product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_price' => 'required|numeric',
            'product_quantity' => 'required|integer',
            'product_category' => 'required|string|max:255',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }

        $product = new Product;
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_price;
        $product->product_quantity = $request->product_quantity;
        $product->product_category = $request->product_category;

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imagePath = 'products';
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($imagePath), $imageName);
            $product->product_image = $imageName;
        }

        $product->save();

        return response()->json(['status' => 201, 'message' => 'Product created successfully'], 201);
    }

    public function api_view_products()
    {
        $products = Product::all();
        return response()->json(['status' => 200, 'products' => $products], 200);
    }

    public function api_edit_product(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['status' => 404, 'message' => 'Product not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'product_name' => 'sometimes|required|string|max:255',
            'product_description' => 'sometimes|required|string',
            'product_price' => 'sometimes|required|numeric',
            'product_quantity' => 'sometimes|required|integer',
            'product_category' => 'sometimes|required|string|max:255',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }

        // Update the product attributes
        $product->update($request->only(['product_name', 'product_description', 'product_price', 'product_quantity', 'product_category']));

        // Check if a new product image is uploaded
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imagePath = 'products';
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($imagePath), $imageName);
            $product->product_image = $imageName;
        }

        // Save the changes to the product
        $product->save();

        return response()->json(['status' => 200, 'message' => 'Product updated successfully'], 200);
    }
    public function api_delete_product($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['status' => 404, 'message' => 'Product not found'], 404);
        }

        $imagePath = public_path('products/' . $product->product_image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $product->delete();

        return response()->json(['status' => 200, 'message' => 'Product deleted successfully'], 200);
    }

    public function api_show_product($id)
    {
        $product = Product::find($id);

        if ($product) {
            return response()->json([
                'status' => 200,
                'Message' => 'Product Found', $product,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'Message' => 'Product not found',
            ], 200);
        }
    }
}
