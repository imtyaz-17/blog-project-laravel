<div class="services_section layout_padding" id="blogs">
    <div class="container">
        <h1 class="services_taital">Blog Posts </h1>
        <p class="services_text mb-4">Welcome to our blog section, where we share a wealth of travel experiences, tips,
            and guides to inspire your next adventure. Whether you're looking for detailed itineraries, packing tips, or
            personal travel stories, you'll find something to spark your wanderlust and help you plan your dream trips.
        </p>
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-md-4 mb-3">
                <div>
                    <img src="{{asset('uploads/postimage/'.$post->image)}}" class="services_img mb-2"
                        style="height: 250px">
                </div>
                <h4>{{$post->post_title}}</h4>
                <p>Post by <b>{{$post->name}}</b></p>
                <div class="btn_main"><a href="{{route('post_details', $post->id)}}">Read More</a></div>
            </div>
            @endforeach

        </div>
    </div>
</div>