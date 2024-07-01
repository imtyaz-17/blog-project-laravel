<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.homecss')
</head>

<body>
    @include('sweetalert::alert')
    <!-- header section start -->
    <div class="header_section">
        @include('home.header')
        {{-- </div> --}}
    <!-- header section end -->
    <div class="text-white">
        <h1 class=" text-white text-center p-4">Add New Post</h1>
        <div class="container w-75">
            <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="post_title">Post Title</label>
                    <input type="text" value="{{old('post_title')}}"
                        class="form-control  @error('post_title') is-invalid @enderror" id="post_title"
                        name="post_title" placeholder="Enter post title" required>
                    <span class="text-danger">
                        @error('post_title')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="post_desc">Post Description</label>
                    <textarea class="form-control" value="{{old('post_desc')}}" id="post_desc" name="post_desc" rows="3"
                        placeholder="Enter post description"></textarea>
                </div>
                <div class="form-group">
                    <label for="post_image">Upload Image</label>
                    <input type="file" value="{{old('post_image')}}" class="form-control-file" id="post_image"
                        name="post_image">
                    <span class="text-danger">
                        @error('post_image')
                        {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mb-3">Post Now</button>
                </div>
            </form>
        </div>
    </div>

    <!-- footer section start -->
    @include('home.footer')
</body>

</html>