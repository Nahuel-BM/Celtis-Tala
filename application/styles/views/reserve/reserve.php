<!-- Page Content -->
<div class="container">


    <h1>ti amo</h1>

    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />




    <div class="container">
        <div class="row">
            <div class='col-sm-8'>
                <div class="form-group">
                    <input type="text" name="daterange" value="01/01/2015 - 01/31/2015" />
                </div>
            </div>

        </div>
    </div>









    <script type="text/javascript">
        $(function () {
            $('input[name="daterange"]').daterangepicker();
        });
    </script>

</div>