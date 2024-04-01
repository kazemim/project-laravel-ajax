<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Category</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])

    <!-- Styles -->

</head>

<body>

    <div class="container">
        <h1 class="my-3">Category Setting</h1>
        <button class="my-5 btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Create
            Category</button>

        {{-- start create post modal --}}
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- ---body post --}}

                        <form id="create-form" method="POST" action="{{ route('createCategory') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                                <input name="title" type="text" class="form-control" id="exampleFormControlInput1">
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-outline-primary">Submit category</button>
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
                    <th scope="col">Category Name</th>
                    <th scope="col">Setting</th>
                </tr>
            </thead>
            <tbody>

                {{-- foreach --}}
                @foreach ($categories as $key => $category)
                    <tr class="">
                        <th scope="row">{{ ++$key }}</th>
                        <td>{{ $category->title }}</td>

                        <td>
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#{{ $category->id }}">Edit</button>

                            {{-- start edit post modal --}}
                            <!-- Modal -->
                            <div class="modal fade" id="{{ $category->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Post</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- ---body category --}}

                                            <form method="POST" action="{{ route('updateCategory', $category->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Category
                                                        Name</label>
                                                    <input value="{{ $category->title }}" name="title2" type="text"
                                                        class="form-control" id="exampleFormControlInput1">
                                                </div>

                                                <div class="mb-3">
                                                    <button type="submit"
                                                        class="btn btn-outline-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- end edit category modal --}}

                            <button class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#c{{ $category->id }}">Delete</button>
                            {{-- start delete category modal --}}
                            <!-- Modal -->
                            <div class="modal fade" id="c{{ $category->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Category</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <h5>Are You Shure Delete This Category ?</h5>
                                            <form action="{{ route('deleteCategory', $category->id) }}" method="POST">
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
                            {{-- end delete Category modal --}}
                        </td>
                    </tr>
                @endforeach

                {{-- end foreach --}}


            </tbody>
        </table>

    </div>


    {{-- java script --}}
    <script type="module">

      fetchAllCategory();


        $(document).ready(function() {





            $.ajax({
                type: 'GET',
                url: url,
                dataType: "json",

                success: (response) => {

                  console.log(response);
                },

                error: function(response) {
                    alert('Form error');
                },

                error: function(response) {
                    alert('Form error');
                },

            });


            // **************************************** create category with ajax ********************************************
            // $("#create-form").submit(function(event) {

            //     event.preventDefault();
            //     let url = $(this).attr("action");
            //     let formData = new FormData(this);

            //     $.ajax({
            //         type: 'POST',
            //         url: url,
            //         data: formData,
            //         contentType: false,
            //         processData: false,

            //         success: (response) => {

            //             $("#exampleModal").hide();
            //             $(".modal-backdrop.show").css("opacity", 0);
            //         },

            //         error: function(response) {
            //             alert('Form error');
            //         },


            //     });


            // });

            // -----------------------------------------------------------------------


            // ========================================================================
        });
    </script>
</body>

</html>
