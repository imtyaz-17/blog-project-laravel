<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.homecss')
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        @include('home.header')
    </div>
    <!-- header section end -->
    <div class="container">
        <div class="card mb-3">
            <img src="{{asset('uploads/postimage/'.$post->image)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h2 class="card-title">{{$post->post_title}}</h2>
                <p class="card-text">{{$post->post_desc}}</p>
                <p class="card-text"><small class="text-muted">Post by <b>{{$post->name}}</b></small></p>
            </div>
        </div>
    </div>

    <!-- footer section start -->
    @include('home.footer')
</body>

</html>