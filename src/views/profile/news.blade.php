<!-- BEGIN PAGE LEVEL STYLES -->
<link href="../../assets/admin/pages/css/blog.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/pages/css/news.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->

<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>

<style>
    .blog-img img {
        margin: 0 auto;
    }

    .blog-page li i {
        color: #78cff8;
    }

    .blog-page hr {
        margin-top: 0 !important;
    }

    h2 {
        padding-left: 30px;
    }

    #perPage {
        width: 60px;
        float: right;
    }
</style>


<div class="row">
    <div class="col-md-12 blog-page">
        <div class="row">
            <div class="col-md-12 col-sm-10 article-block">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-10">
                            <h2>Последние новости</h2>
                        </div>
                        <!--label class="control-label col-md-2">Показать</label-->
                        <div class="col-md-2">
                            <form id="perPage">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <select class="bs-select form-control" name="perPage">
                                    @foreach ([1, 3, 5, 10, 20, 50] as $count)
                                        <option value="{{ $count }}" @if($count == $news->perPage()) selected @endif>{{ $count }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                @for ($i = 0; $i < count($news); $i++)
                    @if ($i != 0)
                        <hr>
                    @endif

                    <div class="row">
                        <div class="col-md-4 blog-img blog-tag-data">
                            <img src="{{ $news[$i]->img or config('mposuccess.news_private_default_img') }}" alt="" class="img-responsive">
                        </div>
                        <div class="col-md-8 blog-article">
                            <h3>
                                <a href="post/{{ $news[$i]->id }}">
                                    {{ $news[$i]->name }}</a>
                            </h3>
                            <ul class="list-inline">
                                <li>
                                    <i class="fa fa-calendar"></i>
                                    <span>
                                        {{ $news[$i]->created_at }} </span>
                                </li>
                            </ul>
                            <p>
                                {{ $news[$i]->preview }}
                            </p>
                            <a class="btn blue" href="post/{{ $news[$i]->id }}">
                                @lang('mposuccess::panel.readMore')  <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>
                @endfor

                <?php echo $news->render(); ?>
            </div>
        </div>
    </div>
</div>

<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>

<script>
    //$('.pagination').addClass('pull-center');
    $('.bs-select').selectpicker({
        iconBase: 'fa',
        tickIcon: 'fa-check'
    }).on('change', function(){
        $('form#perPage').submit();
    });

    // fix pagination a href - for save perPage
    var perPage = "<?=$news->perPage()?>";
    $('.pagination').find('a').each(function () {
        $(this).attr('href', $(this).attr('href') + '&perPage=' + perPage);
    });
</script>