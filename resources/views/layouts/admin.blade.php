<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @stack('up')
    @include('includes.style')
    @stack('down-style')

    <style>
        .invalid-feedback {
            display: block;
        }

        .ck-editor__editable {
            min-height: 300px;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('includes.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('content')


        </div>
    </div>
    @stack('up-script')
    @include('includes.script')
    @stack('down-script')
    <script>
        $("#filter").on("click", function(e) {
            e.preventDefault();
            var params = {};
            $(".datatable-input").each(function() {
                var i = $(this).data("col-index");
                if (params[i]) {
                    params[i] += "|" + $(this).val();
                } else {
                    params[i] = $(this).val();
                }
            });
            $.each(params, function(i, val) {
                parent
                    .$("#table-data")
                    .DataTable()
                    .column(i)
                    .search(val ? val : "", false, false);
            });
            parent.$("#table-data").DataTable().table().draw();
        });

        //reset button
        $("#reset").on("click", function(e) {
            e.preventDefault();
            $(".datatable-input").each(function() {
                $(this).val("");
                parent
                    .$("#table-data")
                    .DataTable()
                    .column($(this).data("col-index"))
                    .search("", false, false);
            });
            parent.$("#table-data").DataTable().table().draw();
        });
    </script>
    {{-- @include('sweetalert::alert') --}}
</body>

</html>
