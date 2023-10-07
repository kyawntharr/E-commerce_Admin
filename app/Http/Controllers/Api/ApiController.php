<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = JWTAuth::attempt($input);
        if ($jwt_token) {
            return response()->json([
                'con' => true,
                'message' => 'loging success',
                'token' => $jwt_token,
            ]);
        } else {
            return response()->json([
                'con' => false,
                'message' => 'creditial error!',
            ]);
        }
    }

    public function register(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required|between:4,20',
            'email' => 'required|email|unique:users',
            'password' => 'required|digits_between:4,20',
            'confirmation_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'con' => false,
                'message' => 'Register Fail!',
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();
        return response()->json([
            'con' => true,
            'message' => 'Register success.Please Login.',
        ]);
    }

    public function me()
    {
        return response()->json([
            'con' => true,
            'message' => 'Your Infos',
            'user' => auth()->user(),
        ]);
    }

    public function cats()
    {
        $cats = Category::get()->load('subcats');
        return response()->json([
            'con' => true,
            'message' => 'All Categories',
            'data' => $cats,
        ]);
    }

    public function subcats($id)
    {
        $subcats = SubCategory::where('category_id', $id)->get();
        return response()->json([
            'con' => true,
            'message' => 'All Sub Categories',
            'data' => $subcats,
        ]);
    }

    public function tags()
    {
        $tags = Tag::all();
        return response()->json([
            'con' => true,
            'message' => 'All tags',
            'data' => $tags,
        ]);
    }

    public function products(Request $request)
    {
        $products = Product::paginate(10);
        return response()->json([
            'con' => true,
            'message' => 'All products',
            'data' => $products,
        ]);
    }
    public function productByCategory(Request $request, $id)
    {
        $products = Product::where('category_id', $id)->simplePaginate(10);
        return response()->json([
            'con' => true,
            'message' => 'All products by category',
            'data' => $products,
        ]);
    }
    public function productByTag(Request $request, $id)
    {
        $products = Product::where('tag_id', $id)->simplePaginate(10);
        return response()->json([
            'con' => true,
            'message' => 'All products by Tag',
            'data' => $products,
        ]);
    }

    public function setOrder(Request $request)
    {
        $orders = $request->orders;
        $orderId = $this->saveOrder($orders);

        foreach ($orders as $ord) {
            $product = Product::find($ord['id']);

            $orderItem = new OrderItem();
            $orderItem->order_id = $orderId;
            $orderItem->user_id = auth()->user()->id;
            $orderItem->category_id = $product->category_id;
            $orderItem->subcat_id = $product->subcat_id;
            $orderItem->tag_id = $product->tag_id;
            $orderItem->name = $product->name;
            $orderItem->price = $product->price;
            $orderItem->images = $product->images;
            $orderItem->color = $product->colors;
            $orderItem->size = $product->sizes;
            $orderItem->count = $ord['count'];
            $orderItem->total = $product->price * $ord['count'];
            $orderItem->save();
        }

        return response()->json([
            'con' => true,
            'message' => 'order request success',
        ]);
    }

    public function saveOrder($orders)
    {
        $order = new Order();

        $total = 0;
        foreach ($orders as $ord) {
            $product = Product::find($ord['id']);
            $total += $product->price * $ord['count'];
        }

        $order->user_id = auth()->user()->id;
        $order->count = count($orders);
        $order->status = false;
        $order->total = $total;

        $order->save();
        return $order->id;
    }

    public function myOrder(Request $request)
    {
        $orders = Order::where('user_id', auth()->user()->id)
            ->get()
            ->load('orderitems');

        return response()->json([
            'con' => true,
            'message' => 'all orders',
            'data' => $orders,
        ]);
    }
    public function oribyorder($id)
    {
        $orderItems = OrderItem::where('order_id', $id)->get();

        return response()->json([
            'con' => true,
            'message' => 'all order items.',
            'data' => $orderItems,
        ]);
    }
}
