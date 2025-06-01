<!DOCTYPE html>
<html>
    <head>
        <title>bootstrap datepicker examples</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Bootstrap CSS and bootstrap datepicker CSS used for styling the demo pages-->
        <link rel="stylesheet" href="./assets/css/datepicker3.css">
        <link rel="stylesheet" href="./assets/css/bootstrap.css">
          <script>
      var page = {bootstrap:3};
      function swap_bs(){
        var bscss = $('#bs-css'),
            bsdpcss = $('#bsdp-css');
        if (page.bootstrap == 3){
          bscss.prop('href', 'http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css');
          bsdpcss.prop('href', 'bootstrap-datepicker/css/datepicker.css');
          page.bootstrap = 2;
          $(page).trigger('change:bootstrap', 2)
        }
        else{
          bscss.prop('href', 'http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css');
          bsdpcss.prop('href', 'bootstrap-datepicker/css/datepicker3.css');
          page.bootstrap = 3;
          $(page).trigger('change:bootstrap', 3)
        }
      }
    </script>
    </head>
    <body>
        <div class="container">
            <div class="hero-unit">
                <input  type="text" placeholder="click to show datepicker"  id="example1">
            </div>
        </div>
        <!-- Load jQuery and bootstrap datepicker scripts -->
        <script src="./assets/js/jquery.js"></script>
        <script src="./assets/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
           
                $('#example1').datepicker({
                    format: "dd/mm/yyyy",
                     todayBtn: "linked",
                     autoclose: true
                });  
            
            
        </script>
    </body>
</html>