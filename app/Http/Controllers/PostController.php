<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayUService\Exception;

use App\Models\Post;
use App\Models\User;


class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); //->except(['index']);
    }
    public function  index(){
        $posts = Post::where('user_id', auth()->user()->id)->get();
        //alternatively--> 
        //$posts = auth()->user()->posts; //returns a collection of posts connected to the authenticated user
        return view('admin.posts.index')->with('posts', $posts);
    }

    public function  show(Post $post){
        //$post = Post::find($id)->get; //injecting the post class means thisnis not required
        return view('blog-post')->with('post', $post);
    }

    public function  create(Post $post){
        $this->authorize('create', Post::class);
        
        return view('admin.posts.create');
    }

    public function store(Request $request){

        $this->authorize('create', Post::class);

        $this->validate($request, [
            'title' => 'required|min:8|max:255',
            'imageFile' => 'required',
            'body' => 'required|min:8'
        ]);

        $title = $request->input('title');
        $body = $request->input('body');
        $img = $request->file('imageFile');
        
        

        if($img){
            $name = $img->getClientOriginalName();
            $img->move('images', $name);
        } else {
            $name = 'placeholder-900x300.jpg';
        }

        try{
            $post = new Post;
            $post->user_id = auth()->user()->id;
            $post->title = $title;
            $post->body = $body;
            $post->post_image = asset('/images/'.$name);
            $post->save();
        } catch (\Exception $e){
            return $e;
        }



        return back()->with('success', 'Post added');

        //dd(request()->all());
    }

    public function edit(Post $post){
        //$post = Post::findOrFail($id);
        $this->authorize('update', $post);
        return view('admin.posts.edit')->with('post', $post);
    }

    public function update(Request $request, Post $post){

        $this->validate($request, [
            'title' => 'required|min:8|max:255',
            'body' => 'required|min:8'
        ]);

        $title = $request->input('title');
        $body = $request->input('body');
        $img = $request->file('imageFile');

        if($img){
            $name = $img->getClientOriginalName();
            $img->move('images', $name);
        }

        try{
            $this->authorize('update', $post);
            //$post = Post::findOrFail($id);//not required because of Post Class Injection
            $post->user_id = auth()->user()->id;
            $post->title = $title;
            $post->body = $body;
            if($img){$post->post_image = asset('/images/'.$name);}
            $post->update();
        } catch (\Illuminate\Database\QueryException $e){
            return $e;

            // if($errorCode === 403){
            //    return back()->with('error', 'Your action is not authortised');
            // }
            //if($errorCode == 1062){ //duplication of records - requires a unqiue field such as NI NUmber
            //    return back()->with('error', 'You have already started an application - please click the `Continue with a Previously Started Application` button to continue.');
            //}
        }



        return redirect('/admin/posts/index')->with('success', 'Post updated');

    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);
        $post->delete();
        return back()->with('error', 'Post Deleted');
    }
}
