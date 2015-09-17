<!-- BEGIN PAGE LEVEL STYLES -->
<link href="../../assets/admin/pages/css/blog.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/pages/css/news.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->

<style>
    .article-block {
        padding: 0 50px;
    }

    .article-block .content {
        font-size: 16px;
    }
</style>

<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12 blog-page">
        <div class="row">
            <div class="article-block">
                <h3>{{ $news->name }}</h3>
                <div class="blog-tag-data">
                    @if($news->img)
                        <img src="{{ $news->img }}" class="img-responsive" alt="">
                    @endif
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6 blog-tag-data-inner">
                            <ul class="list-inline">
                                <li>
                                    <i class="fa fa-calendar"></i>
                                    <a href="javascript:;">
                                        {{ $news->created_at }} </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="content">
                    {{ $news->content }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->