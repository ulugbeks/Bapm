<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);
        
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'category_id' => 'exists:categories,id',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'required|string|max:255',
            'active' => 'boolean',
            'author_name' => 'nullable|string|max:255',
            'author_link' => 'nullable|string|max:255',
        ]);
        
        // Generate slug from title
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        
        // Ensure the slug is unique
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        // Create post
        $post = new Post();
        $post->title = $request->title;
        $post->seo_title = $request->seo_title;
        $post->seo_description = $request->seo_description;
        $post->slug = $slug;
        $post->excerpt = $request->excerpt;
        $post->content = $request->content;
        $post->featured_image = $request->featured_image;
        $post->category_id = $request->category_id;
        $post->active = $request->has('active') ? 1 : 0;
        $post->author_name = $request->author_name; 
        $post->author_link = $request->author_link;
        $post->save();
        
        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'category_id' => 'exists:categories,id',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'required|string|max:255',
            'active' => 'boolean',
            'author_name' => 'nullable|string|max:255',
            'author_link' => 'nullable|string|max:255',
        ]);
        
        // If title changed, update slug
        if ($post->title != $request->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;
            
            // Ensure the slug is unique
            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            
            $post->slug = $slug;
        }
        
        // Update post
        $post->title = $request->title;
        $post->seo_title = $request->seo_title;
        $post->seo_description = $request->seo_description;
        $post->excerpt = $request->excerpt;
        $post->content = $request->content;
        $post->featured_image = $request->featured_image;
        $post->category_id = $request->category_id;
        $post->active = $request->has('active') ? 1 : 0;
        $post->author_name = $request->author_name; 
        $post->author_link = $request->author_link; 
        $post->save();
        
        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}