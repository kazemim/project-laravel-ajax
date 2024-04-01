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
        <h1 class="mb-5">category2</h1>


    </div>




    {{-- java script --}}
    <script type="module">
        var url2 = "http://127.0.0.1:8000/category3";

        $(document).ready(function() {

            fetchAllCategory();

            function fetchAllCategory() {
                $.ajax({
                    type: 'GET',
                    url: url2,
                    dataType: "json",

                    success: (result) => {

                        var table = $(
                            "<table class='table table-striped'><tr><th>#</th><th>title</th><th>setting</th></tr>"
                        );

                        var tr;
                        var n = 1;

                        for (var i = 0; i < result.length; i++, n++) {

                            // output += "<tr>" +
                            //     "<th scope='row'>" + n + "</th>" +
                            //     "<td>" + result[i].title + "</td>" +
                            //     "<td>" + "setting" + "</td>" +
                            //     "</tr>";

                            tr = $("<tr>");
                            tr.append("<th>" + n + "</th>");
                            tr.append("<td>" + result[i].title + "</td>");
                            tr.append("<td>" + "setting" + "</td>");
                            tr.append("</tr>");
                            table.append(tr);
                        }
                        // $("thead").append(output);
                        table.append("</table>");
                        $(".container").append(table);
                    },

                });
            }











            // **************************************** create category with ajax ********************************************
            $("#create-form").submit(function(event) {

                event.preventDefault();
                let url = $(this).attr("action");
                let formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: (response) => {

                        $("#exampleModal").hide();
                        $(".modal-backdrop.show").css("opacity", 0);
                    },

                    error: function(response) {
                        alert('Form error');
                    },


                });


            });

            // -----------------------------------------------------------------------


            // ========================================================================
        });
    </script>
</body>

</html>
