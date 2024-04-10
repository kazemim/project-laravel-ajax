<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

                        <form id="create-form">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                                <input id="name" name="title" type="text" class="form-control">
                            </div>

                            <div class="mb-3">
                                <button id="btn-create" type="submit" class="btn btn-success">Submit
                                    Category</button>
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
            </tbody>
        </table>

    </div>
    {{-- -------------------------- edit modal------------------------------- --}}
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- ---body category --}}

                    <form id="update-form">
                        <div class="mb-3">
                            <label for="name1" class="form-label">Category Name</label>
                            <input name="title2" type="text" class="form-control" id="name1">
                            <input name="hidden1" type="hidden" class="form-control" id="hidden1">
                        </div>

                        <div class="mb-3">
                            <button id="btn-update" type="submit" class="btn btn-outline-primary">Update
                                category</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- -------------------------- delete modal------------------------------- --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden2">
                    <h5>Are You Shure Delete This Category ?</h5>
                    <form id="form-delete">
                        <button id="btnDelete" type="button" data-bs-dismiss="modal"
                            class="btndelete btn btn-danger">Yes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    </form>
                </div>

            </div>
        </div>
    </div>



    {{-- java script --}}
    <script type="module">
        $(document).ready(function() {

            fetchAllCategory();

            function fetchAllCategory() {
                $.ajax({
                    type: 'GET',
                    url: "/getCategories",
                    dataType: "json",

                    success: (result) => {
                        let output2 = "";
                        result.forEach((cat, index) => {
                            output2 += `<tr>
                              <th scope="row">${++index}</th>
                              <td>${cat.title}</td>
                              <td class='d-none'>${cat.id}</td>
                              <td>
                              <button type="button" class="btnEdit btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">Edit</button>
                              <button type="button" class="btndel btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal3">Delete</button>
                               </td>
                               </tr>
                                    `;
                        });
                        $("tbody").html(output2);

                        // -------------- btn for show edit modal -----------------------------------
                        $(".btnEdit").on("click", function() {

                            let name = $(this).parent().siblings("td:nth-of-type(1)").text();
                            let hidden1 = $(this).parent().siblings("td:nth-of-type(2)").text();

                            $("#name1").val(`${name}`);
                            $("#hidden1").val(`${hidden1}`);
                        });
                        // --------------------- btn for show dialog delete user -------------------------------
                        $(".btndel").on("click", function() {

                            let id = $(this).parent().siblings('td:nth-of-type(2)').text();
                            $("#hidden2").val(`${id}`);
                        });
                    },
                });
            }

            // **************************************** create category with ajax ********************************************
            $("#create-form").submit(function(event) {
                event.preventDefault();

                $('#btn-create').attr('disabled', 'true');
                let btnSending = `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                   <span role="status">Sending Data...</span>`;
                $("#btn-create").html(btnSending);

                let formData = new FormData(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/createCategory',
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: (response) => {
                        fetchAllCategory();
                        $('#btn-create').removeAttr('disabled');
                        $("#btn-create").html("Submit Category");
                        $(this).find("#name").val('');
                    },

                    error: function(response) {
                        alert('Form error');
                    },
                });


            });

            // **************************************** update category with ajax ********************************************

            $("#update-form").submit(function(event) {

                event.preventDefault();

                $('#btn-update').attr('disabled', 'true');
                let btnSending = `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                 <span role="status">Updating Data...</span>`;
                $("#btn-update").html(btnSending);

                let formData = new FormData(this);
                let id = $(this).find("#hidden1").val();
                formData.append("_method", "PUT");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: `/updateCategory/${id}`,
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: (response) => {
                        fetchAllCategory();
                        $('#btn-update').removeAttr('disabled');
                        $("#btn-update").html("Update Category");
                    },

                    error: function(response) {
                        alert('Form error');
                    },
                });
            });
            // ************************************* delete *****************************************************
            $("#btnDelete").click(function(event) {

                $(this).attr('disabled', 'true');
                let btnSending = `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Deleting Data...</span>`;
                $(this).html(btnSending);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    }
                });

                let id = $(this).parent().siblings('input').val();

                $.ajax({
                    type: 'DELETE',
                    dataType: "json",
                    url: `/deleteCategory/${id}`,

                    success: (response) => {
                        fetchAllCategory();
                        $(this).removeAttr('disabled');
                        $(this).html("Yes");
                    },

                    error: function(response) {
                        alert('Form error');
                    },
                });
            });

            // ========================================================================
        });
    </script>
</body>

</html>
