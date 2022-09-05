<x-admin-master>

@section('content')
    <h1>Create</h1>
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="imageFile" name="imageFile" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea id="body" name="body" class="form-control" placeholder="Enter Content" cols="30" rows="10"></textarea>
        </div>        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
    @include('inc.messages')

@endsection


</x-admin-master>