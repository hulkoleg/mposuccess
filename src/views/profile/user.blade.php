<link href="../../assets/admin/pages/css/profile-old.css" rel="stylesheet" type="text/css"/>

<style>
    .profile-info h1 {
        margin-bottom: 20px;
    }

    .profile-info .list-unstyled li {
        margin-bottom: 15px;
    }

    .profile-info .list-unstyled li img {
        vertical-align: inherit;
    }

    .profile-nav img {
        margin: 0 auto;
    }

    .profile-nav .messageButton {
        margin: 15px auto;
        display: block;
        max-width: 100px;
    }
</style>

<div class="row">
    <div class="col-md-3">
        <ul class="list-unstyled profile-nav">
            <li>
                <img src="{{ $user->url_avatar ? $user->url_avatar : '/images/users/default.jpg' }}" class="img-responsive" alt=""/>
            </li>
            <li class="messageButton">
                <button type="button" class="btn btn-circle btn-danger btn-sm">@lang('mposuccess::profile.message')</button>
            </li>
        </ul>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-8 profile-info">
                <h1>{{ $user->surname . ' ' . $user->name . ' ' . $user->patronymic }} </h1>
                <ul class="list-unstyled">
                    <li>
                        <i class="fa fa-envelope"></i> {{ $user->email }}
                    </li>
                    <li>
                        <i class="fa fa-map-marker"></i>
                        @if ($country)
                            <img class='flag' src='/assets/global/img/flags/{{ $country->flag }}.png'/>&nbsp;&nbsp; {{ $country->name }}
                        @else
                           unknown
                        @endif
                    </li>
                    <li>
                        <i class="fa fa-calendar"></i> {{ $user->birthday or 'unknown' }}
                    </li>
                    @if($user->id != 1)
                        <li>
                            <i class="fa fa-home"></i> <a href="/profile/user/{{ $user->refer }}">{{ $refer or "unknown" }}</a>
                        </li>
                    @endif
                    <li>
                        <i class="fa fa-trophy"></i> {{ $program->name or "unknown" }}
                    </li>
                    <li>
                        <i class="fa fa-history"></i> {{ $user->created_at }}
                    </li>
                </ul>
            </div>
            <!--end col-md-8-->
            <div class="col-md-4">
                <div class="portlet sale-summary">
                    <div class="portlet-title">
                        <div class="caption">
                            Sales Summary
                        </div>
                        <div class="tools">
                            <a class="reload" href="javascript:;">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <ul class="list-unstyled">
                            <li>
																<span class="sale-info">
																TODAY SOLD <i class="fa fa-img-up"></i>
																</span>
																<span class="sale-num">
																23 </span>
                            </li>
                            <li>
																<span class="sale-info">
																WEEKLY SALES <i class="fa fa-img-down"></i>
																</span>
																<span class="sale-num">
																87 </span>
                            </li>
                            <li>
																<span class="sale-info">
																TOTAL SOLD </span>
																<span class="sale-num">
																2377 </span>
                            </li>
                            <li>
																<span class="sale-info">
																EARNS </span>
																<span class="sale-num">
																$37.990 </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--end col-md-4-->
        </div>
        <!--end row-->
    </div>
</div>