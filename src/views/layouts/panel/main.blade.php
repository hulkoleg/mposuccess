<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="ru">
<!--<![endif]-->
<!-- BEGIN HEAD -->
    <head>
        @include('mposuccess::layouts.panel.head')
    </head>

    <body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo">

        @include('mposuccess::layouts.panel.top')


        <!-- BEGIN CONTAINER -->
        <div class="page-container">

            {!! $slidebar !!}

            <div class="page-content-wrapper">
                <div class="page-content">
                    {!! $content !!}
                </div>
            </div>

            {!! $r_slidebar !!}

        </div>
        <!-- END CONTAINER -->
        @include('mposuccess::layouts.panel.footer')
        @include('mposuccess::layouts.panel.script')
    </body>
<!-- END BODY -->
</html>