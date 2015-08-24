<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="ru">
<!--<![endif]-->
<!-- BEGIN HEAD -->
    <head>
        @include('mposuccess::layouts.head')
    </head>

    <body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo">

        @include('mposuccess::layouts.top')

        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            @include('mposuccess::layouts.slidebar')
            @include('mposuccess::layouts.content')
        </div>
        <!-- END CONTAINER -->
        @include('mposuccess::layouts.footer')
        @include('mposuccess::layouts.script')
    </body>
<!-- END BODY -->
</html>