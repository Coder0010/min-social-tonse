@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <messages-list/>
            </div>
            <div class="col-md-4">
                <users-list/>
            </div>
            <div class="col-md-4">
                <friends-list/>
            </div>
        </div>
    </div>
@endsection
