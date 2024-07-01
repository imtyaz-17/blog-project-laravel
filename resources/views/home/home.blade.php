<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.homecss')
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        @include('home.header')
        <!-- banner section start -->
        @include('home.banner')
        <!-- banner section end -->
    </div>
    <!-- header section end -->
    <!-- services section start -->
    @include('home.blogs')
    <!-- services section end -->
    <!-- about section start -->
    @include('home.about')
    <!-- about section end -->
    <!-- blog section start -->
    <div class="blog_section layout_padding">
        <div class="container">
            <h1 class="blog_taital">See Our Video</h1>
            <p class="blog_text">many variations of passages of Lorem Ipsum available, but the majority have suffered
                alteration in some form, by injected humour, or randomised words which</p>
            <div class="play_icon_main">
                <div class="play_icon"><a href="#"><img src="images/play-icon.png"></a></div>
            </div>
        </div>
    </div>

    <!-- footer section start -->
    @include('home.footer')
</body>

</html>