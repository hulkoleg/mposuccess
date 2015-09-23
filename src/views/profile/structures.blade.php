<div class="col-md-12">
    @if(is_object($sheet))
        <div class="row tree">
            <div class="col-xs-12 tree-container">
                <a id="current" data-url="/tree/build/{{$sheet->getLevel()}}/{{$sheet->getParent()}}" class="tree-circle">
                    {{$sheet->user->id}}
                </a>
            </div>

            <div class="clearfix"></div>

            <div class="col-xs-6 tree-container">
                <a id="one" data-url="/tree/build/{{$sheet->getLevel()}}/{{$sheet->getSid() * 2}}" class="tree-circle">
                    {{$sheet->getLeft()}}
                </a>
            </div>
            <div class="col-xs-6 tree-container">
                <a id="two" data-url="/tree/build/{{$sheet->getLevel()}}/{{($sheet->getSid() * 2) + 1}}" class="tree-circle">
                    {{$sheet->getRight()}}
                </a>
            </div>

            <div class="clearfix"></div>

            <div class="col-xs-3 tree-container">
                <a id="three" data-url="/tree/build/{{$sheet->getLevel()}}/{{($sheet->getSid() * 4)}}" class="tree-circle">
                    {{$sheet->getTwo(0)}}
                </a>
            </div>
            <div class="col-xs-3 tree-container">
                <a id="four" data-url="/tree/build/{{$sheet->getLevel()}}/{{($sheet->getSid() * 4) + 1}}" class="tree-circle">
                    {{$sheet->getTwo(1)}}
                </a>
            </div>
            <div class="col-xs-3 tree-container">
                <a id="five" data-url="/tree/build/{{$sheet->getLevel()}}/{{($sheet->getSid() * 4) + 2}}" class="tree-circle">
                    {{$sheet->getTwo(2)}}
                </a>
            </div>
            <div class="col-xs-3 tree-container">
                <a id="six" data-url="/tree/build/{{$sheet->getLevel()}}/{{($sheet->getSid() * 4) + 3}}" class="tree-circle">
                    {{$sheet->getTwo(3)}}
                </a>
            </div>
        </div>
    @else
        {{ $sheet }}
    @endif
</div>