<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="/assets/global/plugins/respond.min.js"></script>
<script src="/assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>

{!! \Assets::js() !!}



<!-- only for page "panel/admin/news" -->
<script type="text/javascript" src="/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-CN.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/moment.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/jquery.mockjax.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-editable/inputs-ext/address/address.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js"></script>
<script src="/assets/js/form-editable.js"></script>

<script>
    jQuery(document).ready(function() {
        FormEditable.init();
    });
</script>

<script type="text/javascript" src="/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="/assets/js/table-managed.js"></script>


<script>
    var notification_count = {{$notification_new}};

    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features

        <!-- only for page "panel/admin/news" -->
        TableManaged.init();

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "20000",
            "extendedTimeOut": "10000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        $(document).ajaxStart(
            function(event, jqxhr, settings){
                Metronic.blockUI({
                    target: 'body',
                    animate: true
                });
            }
        ).ajaxStop(
            function(event, jqxhr, settings) {
                Metronic.unblockUI('body');
            }
        );
        loadNotification();
    });

    function loadNotification(){
        var notification = $.ajax({
            url: '/panel/notification/' + notification_count,
            headers: {
                'X-CSRF-Token' : $('meta[name=_token]').attr('content')
            },
            method: "POST",
            dataType: "json",
            global: false
        });

        notification.done(function( response ) {
            console.log(response);
            d = new Date();
            date = d.getDate();
            month = d.getMonth() + 1;
            year = d.getFullYear();
            $.each(response, function(index, res){
                if('notification_count' == res.type){
                    notification_count = res.count;
                    $('#notification-count').text(notification_count);
                } else {
                    toastr[res.type](res.message, res.name);
                    $('#notification-list').append(
                        '<li>' +
                        '<a href="javascript:;">' +
                        '<span class="time">' +
                        date + "/" + month + "/" + year +
                        '</span>' +
                        '<span class="details"> ' +
                        '<span class="label label-sm label-icon label-success">' +
                        '<i>' + res.name + '</i>' +
                        '</span>' +
                        '</span>' +
                        '<div>' +
                        res.message +
                        '</div>' +
                        '</a>' +
                        '</li>'
                    );
                }
            });
            setTimeout(loadNotification, 5000);
        });

        notification.fail(function( jqXHR, textStatus ) {
            setTimeout(loadNotification, 5000);
        });
    }
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        //Hide the overview when click
        $('#someid').on('click', function () {
            $('#OverviewcollapseButton').removeClass("collapse").addClass("expand");
            $('#PaymentOverview').hide();
        });
    });
</script>
<!-- END JAVASCRIPTS -->