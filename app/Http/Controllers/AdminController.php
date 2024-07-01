<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    //
    public function create()
    {
        return view('admin.create_post');
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
        $post->post_status = 'active';

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

        return redirect()->back()->with('success', 'Add Post successfully!');
    }

    public function showAll()
    {
        $posts = Post::all();
        return view('admin.post_lists', compact('posts'));
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.edit_post', compact('post'));
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

        return redirect()->back()->with('success', ' Post Updated!!');
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
        return redirect()->route('admin.posts')->with('success', 'Post deleted.');
    }

    public function accept_post($id)
    {
        $post = Post::findOrFail($id);
        $post->post_status = 'active';
        $post->save();

        return redirect()->back()->with('success', 'Post is active now.');
    }
    public function reject_post($id)
    {
        $post = Post::findOrFail($id);
        $post->post_status = 'rejected';
        $post->save();

        return redirect()->back()->with('success', 'Post is rejected!!');
    }
}
