<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/jquery.ui.touch-punch.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="js/flatui-checkbox.js"></script>
<script src="js/flatui-radio.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.placeholder.js"></script>
<script src="js/jquery.nivo.slider.pack.js"></script>
<script src="js/application.js"></script>
<script src="js/over.js"></script>
<script>
    $(function(){

        if( $('#nivoSlider').size() > 0 ) {

            $('#nivoSlider').nivoSlider({
                effect: 'random',
                pauseTime: 5000
            });

        }

    })
</script>
<script>
    $(document).ready(function () {

        (function ($) {

            $('#srch-term').keyup(function () {

                var rex = new RegExp($(this).val(), 'i');
                $('.searchable tr').hide();
                $('.searchable tr').filter(function () {
                    return rex.test($(this).text());
                }).show();

            })

        }(jQuery));

    });
</script>

<footer>
    <div class="container footer-text">
        <div class="col-md-12">

            <hr class="dashed">

        </div><!-- /.col -->
        <div class="editContent">
            <p class="pull-left small">RISSER Rémy - Bootstrap Starter Kit</p>
        </div>
        <div class="editContent">
            <p class="pull-right small">Fait avec <span class="fa fa-heart pomegranate"></span></p>
        </div>
    </div>
</footer>
</body>