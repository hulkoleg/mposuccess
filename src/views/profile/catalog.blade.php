<link href="/assets/admin/pages/css/pricing-table.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/css/components.css" rel="stylesheet" type="text/css"/>
@foreach($products as $product)
    <div class="col-md-6">
        <div class="pricing hover-effect">
            <div class="pricing-head">
                <h3>{{$product->name}}
                    <span>
                        {{$product->des}}
                    </span>
                </h3>
                <h4>
                    <i>$</i>{{$product->price}}<i>.{{$product->penny}}</i>
                    <span>{{$product->what}}</span>
                </h4>
            </div>
            <div class="pricing-footer">
                <a href="/bye/tree/{{$product->url}}" class="btn yellow-crusta">
                    Купить <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
    </div>
@endforeach