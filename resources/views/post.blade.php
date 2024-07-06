
@extends('layouts.master')

@section('title', 'posts')

@section('content')

<div class="container">
    <h1 class="my-3">ajax project</h1>
    <a href="{{ url('category') }}">click category</a>
    <button class="my-5 btn btn-success" data-bs-toggle="modal" id="open-create"
        data-bs-target="#exampleModal">Create Post</button>

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

                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <form id="create-form1" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Writer Name</label>
                            <input name="writer" type="text" class="form-control" id="exampleFormControlInput1">
                            <span id="span1" class="span-validate text-danger">please fill writer</span>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Body Post</label>
                            <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            <span class="span-validate text-danger">please fill body</span>
                        </div>
                        <div class="mb-3">
                            <label for="SelectCategory" class="form-label">Select Category</label>
                            <select name="category_id" id="SelectCategory" class="form-select"
                                aria-label="Default select example">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            <span class="span-validate text-danger">please fill category</span>
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Select Image</label>
                            <input name="image" class="form-control" type="file" id="formFile">
                            <span class="span-validate text-danger">please fill file</span>
                        </div>

                        <div class="mb-3">
                            <button id="btn-create" type="submit" class="btn btn-success">Submit
                                Post</button>
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


        </tbody>
    </table>

</div>
{{-- **************************************   edit modal ************************************************ --}}
{{-- start edit post modal --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- ---body post --}}

                <form id="update-form" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input name="hidden1" type="hidden" class="form-control" id="hidden1">
                        <label for="exampleFormControlInput1" class="form-label">Writer
                            Name</label>
                        <input id="writer2" name="writer" type="text" class="form-control"
                            id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Body
                            Post</label>
                        <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="SelectCategory" class="form-label">Select
                            Category</label>
                        <select name="category_id" id="SelectCategory" class="form-select"
                            aria-label="Default select example">
                            <option selected disabled>Open this select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="formFile2" class="form-label">Select Image</label>
                        <input name="image" class="form-control" type="file" id="formFile2">
                    </div>

                    <div class="mb-3">
                        <button type="submit" id="btn-update" class="btn btn-outline-primary">Update
                            Post</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- end edit post modal --}}

{{-- ***************************************   delete modal     ******************************************** --}}
{{-- start delete post modal --}}
<!-- Modal -->
<div class="modal fade" id="deletePost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="hidden2">
                <h5>Are You Shure Delete This Post ?</h5>
                <form>
                    <button type="button" id="btnDelete" class="btn btn-danger"
                        data-bs-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </form>

            </div>

        </div>
    </div>
</div>
{{-- end delete post modal --}}


{{-- *********************************************** java script ************************************************* --}}
<script type="module">
    $(document).ready(function() {

       fetchAllPost();

        // **************************************** fetch all Posts with ajax **************************************
        function fetchAllPost() {
            $.ajax({
                type: 'GET',
                url: "/getPosts",
                dataType: "json",

                success: (result) => {
                    let output2 = "";
                    result.forEach((post, index) => {
                        output2 += `<tr>
                          <th scope="row">${++index}</th>
                          <td>${post.writer}</td>
                          <td>${post.body}</td>
                          <td>
                           <div class="div-img"><img src="images/${post.image}" alt="img1"
                                class="img-fluid rounded-circle"></div>
                          </td>
                          <td>
                          <button type="button" class="btnEdit btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">Edit</button>
                          <button type="button" class="btndel btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePost">Delete</button>
                           </td>
                           <td class='d-none'>${post.id}</td>
                           <td class='d-none'>${post.category.id}</td>
                           </tr>
                                `;
                    });
                    $("tbody").html(output2);

                    // ------------------- btn for show edit modal -----------------------------------

                    $(".btnEdit").click(function() {
                        $("#formFile2").val('');
                        let writer = $(this).parent().siblings("td:nth-of-type(1)").text();
                        let body = $(this).parent().siblings("td:nth-of-type(2)").text();
                        let image = $(this).parent().siblings("div img").attr('src');
                        let hidden1 = $(this).parent().siblings("td:nth-of-type(5)").text();
                        let select = $(this).parent().siblings("td:nth-of-type(6)").text();

                        $("#writer2").val(`${writer}`);
                        $("textarea").val(`${body}`);
                        $("#hidden1").val(`${hidden1}`);
                        $("select").val(`${select}`);
                    });

                    // ------------------------- btn for show dialog delete user -------------------------------
                    $(".btndel").on("click", function() {

                        let id = $(this).parent().next().text();
                        $("#hidden2").val(`${id}`);
                    });
                },
            });
        }

        // ****************************************** create post *************************************************
        $("#open-create").click(function() {
            $("#create-form1").find('input, textarea').val('');
            $(".print-error-msg").css('display', 'none');
            $("#create-form1").find('select').val('1');
        });
        $("#create-form1").submit(function(event) {
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
                url: '/createPost',
                data: formData,
                contentType: false,
                processData: false,

                success: (response) => {
                    fetchAllPost();
                    $(".print-error-msg").css('display', 'none');
                    $('#btn-create').removeAttr('disabled');
                    $("#btn-create").html("Submit Post");
                    $(this).find('input, textarea, select').val('');
                },

                error: function(response) {

                    $('#btn-create').removeAttr('disabled');
                    $("#btn-create").html("Submit Post");

                    let msg = response.responseJSON.errors;
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display', 'block');
                    $.each(msg, function(key, value) {
                        $(".print-error-msg").find("ul").append('<li>' + value +
                            '</li>');
                    });
                },
            });
        });

        // **************************************** update post with ajax ********************************************
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
                url: `/updatePost/${id}`,
                data: formData,
                // cache:false,
                contentType: false,
                processData: false,

                success: (response) => {
                    fetchAllPost();
                    $('#btn-update').removeAttr('disabled');
                    $("#btn-update").html("Update Category");
                },

                error: function(response) {
                    alert('Form error');
                },
            });
        });

        // ******************************************** delete *************************************************
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
                url: `/deletePost/${id}`,

                success: (response) => {
                    fetchAllPost();
                    $(this).removeAttr('disabled');
                    $(this).html("Yes");
                },

                error: function(response) {
                    alert('Form error');
                },
            });
        });
        // *****************************************************************************************************

        // ==================================== end of ready document ==========================================
    });
</script>

@endsection

