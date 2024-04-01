<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ajax Project</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])


    <!-- Styles -->

</head>

<body>

    <div class="container">
        <h1 class="my-3">ajax project</h1>
        <a href="{{ url('category') }}">click category</a>
        <button class="my-5 btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Create Post</button>

        {{-- start create post modal --}}
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Post</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- ---body post --}}

                        <form method="POST" action="{{ route('createPost') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Writer Name</label>
                                <input name="writer" type="text" class="form-control" id="exampleFormControlInput1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Body Post</label>
                                <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="SelectCategory" class="form-label">Select Category</label>
                                <select name="category_id" id="SelectCategory" class="form-select"
                                    aria-label="Default select example">
                                    <option selected disabled>Open this select category</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Select Image</label>
                                <input name="image" class="form-control" type="file" id="formFile">
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-outline-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        {{-- end create post modal --}}

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Writer</th>
                    <th scope="col">Post Body</th>
                    <th scope="col">Image</th>
                    <th scope="col">Setting</th>
                </tr>
            </thead>
            <tbody>

                {{-- foreach --}}
                @foreach ($posts as $key => $post)
                    <tr class="">
                        <th scope="row">{{ ++$key }}</th>
                        <td>{{ $post->writer }}</td>
                        <td>
                            <p>
                                {{ $post->body }}
                            </p>
                        </td>
                        <td>
                            <div class="div-img"><img src="{{ asset($post->image) }}" alt="img1"
                                    class="img-fluid rounded-circle"></div>
                        </td>
                        <td>
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#{{$post->id}}">Edit</button>

                            {{-- start edit post modal --}}
                            <!-- Modal -->
                            <div class="modal fade" id="{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Post</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- ---body post --}}

                                            <form method="POST" action="{{route('updatePost', $post->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Writer
                                                        Name</label>
                                                    <input name="writer" type="text" class="form-control" value="{{$post->writer}}"
                                                        id="exampleFormControlInput1">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Body
                                                        Post</label>
                                                    <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$post->body}}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="SelectCategory" class="form-label">Select
                                                        Category</label>
                                                    <select name="category_id" id="SelectCategory" class="form-select"
                                                        aria-label="Default select example">
                                                        <option selected disabled>Open this select category</option>
                                                        @foreach ($categories as $category)
                                                        <option  value="{{ $category->id }}">{{ $category->title }}</option>
                                                    @endforeach

                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Select Image</label>
                                                    <input name="image" class="form-control" type="file" id="formFile">
                                                </div>

                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-outline-primary">Update
                                                        Post</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- end edit post modal --}}

                            <button class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deletePost">Delete</button>
                            {{-- start delete post modal --}}
                            <!-- Modal -->
                            <div class="modal fade" id="deletePost" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Post</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <h5>Are You Shure Delete This Post ?</h5>
                                            <form action="{{ route('deletePost', $post->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Yes</button>
                                                <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">No</button>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- end delete post modal --}}
                        </td>
                    </tr>
                @endforeach

                {{-- end foreach --}}


            </tbody>
        </table>

    </div>


    {{-- java script --}}
    <script type="module">
        $(document).ready(function() {


            // ======================================
        });
    </script>
</body>

</html>
