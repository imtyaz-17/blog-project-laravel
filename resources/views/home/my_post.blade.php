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
        <h1 class="services_taital text-center my-2">My Posts </h1>
        <div class="row">
            @foreach ($user_posts as $post)
            <div class="col-md-4 mb-3">
                <div>
                    <img src="{{asset('uploads/postimage/'.$post->image)}}" class="services_img mb-2"
                        style="height: 200px">
                </div>
                <h4>{{$post->post_title}}</h4>
                <p>{{Str::limit($post->post_desc, 100, '...') }} <a href="{{route('post_details', $post->id)}}"
                        class="text-primary">Read More</a></p>
                <p class="text-secondary">Post by <b>{{$post->name}}</b></p>
                <div class="flex mt-2 justify-content-between">
                    <a href="{{route('user.edit', $post->id)}}" class="btn btn-warning mb-2">Update</a>
                    <form action="{{route('user.destroy', $post->id)}}" method="POST"
                        onsubmit="return confirmDeletion(event)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-3">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>
    <!-- footer section start -->
    @include('home.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        function confirmDeletion(event) {
            event.preventDefault(); 
            swal({
                title: "Are you sure you want to delete this?",
                text: "You won't be able to revert this action.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    event.target.submit();
                }
            });                 
        }
    </script>
</body>

</html>