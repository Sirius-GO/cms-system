<x-admin-master>

@section('content')
    <h1>Edit Post</h1>
    <form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title" value="{{$post->title}}">
        </div>
        <div class="form-group">
            <div><img src="{{$post->post_image}}" height="100px"></div>
            <label for="image">Image</label>
            <input type="file" id="imageFile" name="imageFile" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea id="body" name="body" class="form-control" placeholder="Enter Content" cols="30" rows="10">{{$post->body}}</textarea>
        </div>        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
    @include('inc.messages')

@endsection


</x-admin-master>