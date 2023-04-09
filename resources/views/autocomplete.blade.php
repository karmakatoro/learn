<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Autocomplete</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
</head>
<body>
    <h3 class="text-center">Autocomplete Field</h3>
    <center>
        <div class="form-group col-md-3">
            <input type="text" name="country_name" id="country_name" class="form-control col-md-4" placeholder="Enter Country Name">
            {{ csrf_field() }}
            <div id="country_list" class="mt-3">

            </div>
        </div>

    </center>
    <script>
        $(document).ready(function() {
            $("#country_name").keyup(function() {
                var query = $(this).val();
                if (query != '') {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('autocomplete.fetch') }}"
                        , method: "POST"
                        , data: {
                            query: query
                            , _token: _token
                        }
                        , success: function(data) {
                            $("#country_list").fadeIn();
                            $("#country_list").html(data)
                        }
                    });
                }
            });
            $(document).on('click','li', function () {
                $("#country_name").val($(this).text());
                $("#country_list").fadeOut();
            })
        });

    </script>
</body>
</html>
