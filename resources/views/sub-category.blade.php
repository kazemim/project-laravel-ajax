@extends('layouts.master')

@section('title', 'sub-categories')

@section('content')


    <div class="container">
        <h1 id="h1" class="my-3">Sub Category Setting</h1>

        <div id="btn-container">

            @foreach ($categories as $key => $category)
                <button id='category{{$key}}' class="btn btn-outline-primary btn-category">{{ $category->title }}</button>
            @endforeach

        </div>

        {{-- -------------------------------------------  table  ------------------------------------------------- --}}


        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Writer</th>
                    <th scope="col">Post Body</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

    </div>

    {{-- ++++++++++++++++++++++++++++++++++++++++++ javascript++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
    <script type="module">
        $(document).ready(function() {

            fetchSubCategory('category0');
            
            $(".btn-category").click(function() {
                $(this).siblings().removeClass('clickChange');
                $(this).addClass('clickChange');

                let catId = $(this).attr('id');
                fetchSubCategory(catId);

            });

            function fetchSubCategory(catId) {
                $.ajax({
                    type: 'GET',
                    url: "/getSubCategory",
                    dataType: "json",

                    success: (categories) => {
                        let output = "";

                        // catId.slice(8) => (remove category string)  ===    category5 => 5

                        let id = catId.slice(8);
                        let result = categories[id].posts;
                        result.forEach((post, index) => {
                            output += `<tr>
                          <th scope="row">${++index}</th>
                          <td>${post.writer}</td>
                          <td>${post.body}</td>
                          <td>
                           <div class="div-img"><img src="${post.image}" alt="img1"
                                class="img-fluid rounded-circle"></div>
                          </td>
                           </tr>
                                `;
                        });
                        $("tbody").html(output);

                    }
                });
            }
            // ===========================================================================================================
        });
    </script>
@endsection
