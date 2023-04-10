<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Load on scroll</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
    <style>
        .wrapper > ul#results li {
          margin-bottom: 2px;
          background: #e2e2e2;
          padding: 20px;
          width: 97%;
          list-style: none;
        }
        .ajax-loading{
          text-align: center;
        }
     </style>
</head>
<body>
    <h3 class="text-center">Load on scroll</h3>
    <center>
        <div class="container">
            <div class="wrapper">
             <ul id="results"><!-- results appear here --></ul>
              <div class="ajax-loading">
                <img src="{{ asset('assets/img/load.gif') }}" alt="">
              </div>
            </div>
           </div>

    </center>
    <script>
        var SITEURL = "http://127.0.0.1:8000/";
        var page = 1; //track user scroll as page number, right now page number is 1
        load_more(page); //initial content load
        $(window).scroll(function() { //detect page scroll
           if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
           page++; //page number increment
           load_more(page); //load content
           }
         });
         function load_more(page){
             $.ajax({
                url: SITEURL + "load?page=" + page,
                type: "get",
                datatype: "html",
                beforeSend: function()
                {
                   $('.ajax-loading').show();
                 }
             })
             .done(function(data)
             {
                 if(data.length == 0){
                 console.log(data.length);
                 //notify user if nothing to load
                 $('.ajax-loading').html("No more records!");
                 return;
               }
               $('.ajax-loading').hide(); //hide loading animation once data is received
               $("#results").append(data); //append data into #results element
                console.log('data.length');
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
               alert('No response from server');
            });
         }
     </script>
</body>
</html>
