<x-admin-master>
@section('content')
    <h1>User Profile: {{$user->name}}</h1>

    <div class="row">
        <div class="col-sm-6">
            <form action="" method="post">
                <div class="form-group">
                    <img src="{{asset('/images/placeholder-50x50.jpg')}}" class="mb-4 img-profile rounded-circle">
                    <label for="Avatar">Avatar</label>
                    <input type="file" id="avatar" name="avatar" class="form-control-file">
                </div> 
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter Name" value="{{$user->name}}" class="form-control">
                </div>  
                <div class="form-group">  
                    <label for="Email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter Email Address" value="{{$user->email}}" class="form-control">
                </div>  
                <div class="form-group">  
                    <label for="Password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control">
                </div>  
                <div class="form-group">  
                    <label for="Confirm Password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                    </div>
                <br>
                <button type="submit" class="btn btn-primary"> Submit </button>
            </form>
        </div>
        <div class="col-sm-6">

        </div>
    </div>
@endsection
</x-admin-master>