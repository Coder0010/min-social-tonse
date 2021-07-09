@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <form action="{{ route('profile-update') }}" method="POST" class="col">
                @method('PATCH')
                @csrf
                <div class="form-group input-group mb-3">
                    <div class="input-group input-group-seamless">
                        <span class="input-group-prepend"> <span class="input-group-text"> <i class="fa fa-user fa-fw"></i> </span> </span>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="{{ Auth::user()->name }}">
                    </div>
                </div>
                <div class="form-group input-group mb-3">
                    <div class="input-group input-group-seamless">
                        <span class="input-group-prepend"> <span class="input-group-text"> <i class="fa fa-envelope fa-fw"></i> </span> </span>
                        <input type="text" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-success m-auto">Update Account</button>
            </form>
            <form class="formvalidator" action="{{ route('profile-update-password') }}" method="POST" class="col">
                @method('PATCH')
                @csrf
                <div class="form-group input-group mb-3">
                    <div class="input-group input-group-seamless">
                        <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password">
                        <span class="input-group-append"> <span class="input-group-text"> <i class="fa fa-lock fa-fw"></i> </span> </span>
                    </div>
                </div>
                <div class="form-group input-group mb-3">
                    <div class="input-group input-group-seamless">
                        <input type="password" name="password" id="password" class="form-control" placeholder="New Password">
                        <span class="input-group-append"> <span class="input-group-text"> <i class="fa fa-lock fa-fw"></i> </span> </span>
                    </div>
                </div>
                <div class="form-group input-group mb-3">
                    <div class="input-group input-group-seamless">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="New Confirmation Password">
                        <span class="input-group-append"> <span class="input-group-text"> <i class="fa fa-lock fa-fw"></i> </span> </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Update Password</button>
            </form>
        </div>
    </div>
@endsection
