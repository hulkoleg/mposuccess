<div class="header-navigation pull-right font-transform-inherit">
    <ul>
        <li>
            <a href="/">
                @lang('mposuccess::front.home')
            </a>
        </li>

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                @lang('mposuccess::front.success.title')
            </a>

            <ul class="dropdown-menu">
                <li><a href="/success/defense">@lang('mposuccess::front.success.defense')</a></li>
            </ul>
        </li>

        <li>
            <a href="/news">
                @lang('mposuccess::front.news')
            </a>
        </li>

        <li>
            <a href="/article">
                @lang('mposuccess::front.article')
            </a>
        </li>

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                @lang('mposuccess::front.about.title')
            </a>

            <ul class="dropdown-menu">
                <li><a href="/about/contacts">@lang('mposuccess::front.about.contacts')</a></li>
                <li><a href="/about">@lang('mposuccess::front.about.title')</a></li>
                <li><a href="/about/rights">@lang('mposuccess::front.about.rights')</a></li>
                <li class="dropdown-submenu">
                    <a href="javascript:;">@lang('mposuccess::front.about.docs.title') <i class="fa fa-angle-right"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="/about/charter">@lang('mposuccess::front.about.docs.charter')</a></li>
                        <li><a href="/about/regdocs">@lang('mposuccess::front.about.docs.regdocs')</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        <!-- BEGIN TOP SEARCH -->
        <li class="menu-search">
            <span class="sep"></span>
            <i class="fa fa-search search-btn"></i>
            <div class="search-box">
                <form action="#">
                    <div class="input-group">
                        <input type="text" placeholder="Search" class="form-control">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">Search</button>
                    </span>
                    </div>
                </form>
            </div>
        </li>
        <!-- END TOP SEARCH -->
    </ul>
</div>