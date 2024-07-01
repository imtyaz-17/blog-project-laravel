<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    //
    public function index()
    {
        if (Auth::id()) {
            $account_type = Auth()->user()->account_type;
            if ($account_type == 'user') {
                $posts = Post::where('post_status', '=', 'active')->get();
                return view('home.home', compact('posts'));
            } else if ($account_type == 'admin') {
                return view('admin.admindashboard');
            } else {
                return redirect()->back();
            }
        }
    }

    public function homepage()
    {
        $posts = Post::where('post_status', '=', 'active')->get();
        return view('home.home', compact('posts'));
    }
    public function post_details($id)
    {
        $post = Post::findOrFail($id);
        return view('home.post_details', compact('post'));
    }

    public function create()
    {
        return view('home.create_post');
    }
    public function store(Request $request)
    {
        $user = Auth()->user();
        $user_id = $user->id;
        $name = $user->name;
        $account_type = $user->account_type;
        // Validate the incoming request data
        $request->validate([
            'post_title' => 'required|min:6',
            'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $post = new Post();
        $post->post_title = $request->post_title;
        $post->post_desc = $request->post_desc;
        $post->post_status = 'pending';

        // Handle image upload if an image is provided
        $image = $request->post_image;
        if ($image) {
            $ext = $image->getClientOriginalExtension();
            $image_name = time() . '.' . $ext;

            // Move the uploaded image to the specified directory
            $image->move(public_path('uploads/postimage'), $image_name);

            // Set the image name in the product instance
            $post->image = $image_name;
        }
        $post->user_id = $user_id;
        $post->name = $name;
        $post->account_type = $account_type;


        $post->save();
        Alert::success('Done', 'Posted successfully!');
        return redirect()->back();
    }
    public function myPost()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $user_posts = Post::where('user_id', '=', $user_id)->get();
        return view('home.my_post', compact('user_posts'));
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('home.edit_post', compact('post'));
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'post_title' => 'required|min:6',
            'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $post = Post::findOrFail($id);
        $post->post_title = $request->post_title;
        $post->post_desc = $request->post_desc;

        // Handle image upload if a new image is provided
        $image = $request->post_image;
        if ($image) {
            // Delete the old image
            File::delete(public_path('uploads/postimage/' . $post->image));

            $ext = $image->getClientOriginalExtension();
            $image_name = time() . '.' . $ext;

            // Move the uploaded image to the specified directory
            $image->move(public_path('uploads/postimage'), $image_name);

            // Set the image name in the product instance
            $post->image = $image_name;
        }

        $post->save();
        Alert::success('Done', ' Post Updated!!');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $delete_post = Post::findOrFail($id);
        if ($delete_post->image) {
            // Delete the associated image file
            File::delete(public_path('uploads/postimage/' . $delete_post->image));
        }

        $delete_post->delete();
        // Redirect to the product list with a success message
        return redirect()->back()->with('success', 'Post deleted.');
    }
}
