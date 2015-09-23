<div class="col-md-12">
    <div class="row tree">
        <div class="col-xs-12 tree-container">
            <a href="/tree/build/{{$sheet->getParent()}}" class="tree-circle">
                {{$sheet->user->id}}
            </a>
        </div>

        <div class="clearfix"></div>

        <div class="col-xs-6 tree-container">
            <a href="/tree/build/{{$sheet->getSid() * 2}}/{{$sheet->getLeft()}}" class="tree-circle">
                {{$sheet->getLeft()}}
            </a>
        </div>
        <div class="col-xs-6 tree-container">
            <a href="/tree/build/{{($sheet->getSid() * 2) + 1}}/{{$sheet->getRight()}}" class="tree-circle">
                {{$sheet->getRight()}}
            </a>
        </div>

        <div class="clearfix"></div>

        <div class="col-xs-3 tree-container">
            <a href="/tree/build/{{($sheet->getSid() * 4)}}/{{$sheet->getTwo(0)}}" class="tree-circle">
                {{$sheet->getTwo(0)}}
            </a>
        </div>
        <div class="col-xs-3 tree-container">
            <a href="/tree/build/{{($sheet->getSid() * 4) + 1}}/{{$sheet->getTwo(1)}}" class="tree-circle">
                {{$sheet->getTwo(1)}}
            </a>
        </div>
        <div class="col-xs-3 tree-container">
            <a href="/tree/build/{{($sheet->getSid() * 4) + 2}}/{{$sheet->getTwo(2)}}" class="tree-circle">
                {{$sheet->getTwo(2)}}
            </a>
        </div>
        <div class="col-xs-3 tree-container">
            <a href="/tree/build/{{($sheet->getSid() * 4) + 3}}/{{$sheet->getTwo(3)}}" class="tree-circle">
                {{$sheet->getTwo(3)}}
            </a>
        </div>
    </div>
</div>