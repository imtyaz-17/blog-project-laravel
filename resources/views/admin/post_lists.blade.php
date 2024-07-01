<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('admin.admincss')
</head>

<body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content p-2 ">
            @if (session('success'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <h1 class="text-white text-center p-4">All Post</h1>

            <table class="table table-bordered border-primary text-white mb-4">
                <thead class="border border-primary bg-info">
                    <tr class="border border-primary">
                        <th scope="col" class="border border-primary">#id</th>
                        <th scope="col" class="border border-primary">Post Title</th>
                        <th scope="col" class="border border-primary">Post Description</th>
                        <th scope="col" class="border border-primary">Author</th>
                        <th scope="col" class="border border-primary">Post Status</th>
                        <th scope="col" class="border border-primary">UserType</th>
                        <th scope="col" class="border border-primary">Image</th>
                        <th scope="col" class="border border-primary">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr class="border border-primary">
                        <th scope="row" class="border border-primary">{{$post->id}}</th>
                        <td class="border border-primary">{{$post->post_title}}</td>
                        <td class="border border-primary">{{$post->post_desc}}</td>
                        <td class="border border-primary">{{$post->name}}</td>
                        <td class="border border-primary">{{$post->post_status}}</td>
                        <td class="border border-primary">{{$post->account_type}}</td>
                        <td class="border border-primary">
                            <img src="uploads/postimage/{{$post->image}}" alt="" width="100" height="100">
                        </td>
                        <td class="d-flex border-0 gap-1">
                            <a href="{{ route('admin.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.destroy', $post->id) }}" method="POST"
                                onsubmit="return confirmDeletion(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('admin.accept', $post->id) }}" class="btn btn-success">Accept</a>
                            <a href="{{ route('admin.reject', $post->id) }}" class="btn btn-danger">Reject</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('admin.footer')

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