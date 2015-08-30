<!-- BEGIN TOP BAR -->
<div class="pre-header">
    <div class="container">
        <div class="row">
            <!-- BEGIN TOP BAR LEFT PART -->
            <div class="col-md-6 col-sm-6 additional-shop-info">
                <ul class="list-unstyled list-inline">
                    <li><i class="fa fa-phone"></i><span>+1 456 6717</span></li>
                    <li><i class="fa fa-envelope-o"></i><span>info@keenthemes.com</span></li>
                </ul>
            </div>
            <!-- END TOP BAR LEFT PART -->
            <!-- BEGIN TOP BAR MENU -->
            <div class="col-md-6 col-sm-6 additional-nav">
                <ul class="list-unstyled list-inline pull-right">
                    @if (Auth::check())
                        <li><a href="/panel">{{Auth::user()->name}}</a></li>
                        <li><a href="/auth/logout">@lang('mposuccess::front.logout')</a></li>
                    @else
                        <li><a href="/auth/login">@lang('mposuccess::front.login')</a></li>
                        <li><a href="/auth/register">@lang('mposuccess::front.register')</a></li>
                    @endif
                </ul>
            </div>
            <!-- END TOP BAR MENU -->
        </div>
    </div>
</div>
<!-- END TOP BAR -->