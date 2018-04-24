
    <div class="container">
        <div class="row">
            <div class="footer col s12 center">
                Copyright &copy; <?php echo date('Y'); ?> <a href="http://pristontale.eu">PristonTale.eu</a> -  All rights reserved.
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script type="text/javascript" src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/jquery.countdown.min.js"></script>
    <script type="text/javascript">
        $('.header-banner').carousel({fullWidth: true});
    </script>

    <script>
        $('#clock').countdown('2018/04/22 12:00 UTC+2', function(event) {
            $(this).html(event.strftime('%-H Hours %-M Minutes %-S Seconds'));
        });
    </script>
</body>
</html>
