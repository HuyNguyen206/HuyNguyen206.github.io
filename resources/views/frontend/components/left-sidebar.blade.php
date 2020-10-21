<div class="left-sidebar">
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        @foreach ($categories as $c)
            @if(!$c->childCategory->isEmpty())
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$c->slug}}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{$c->name}}
                        </a>
                    </h4>
                </div>
                <div id="{{$c->slug}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach ($c->childCategory as $child)
                                <li><a href="{{$c->slug.'/'.$child->slug}}">{{$child->name}} </a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            @else
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="{{$c->slug}}">{{$c->name}}</a></h4>
                    </div>
                </div>
            @endif
        @endforeach
    </div><!--/category-products-->

    <div class="price-range"><!--price-range-->
        <h2>Price Range</h2>
        <div class="well text-center">
            <div class="slider slider-horizontal" style="width: 163px;"><div class="slider-track"><div class="slider-selection" style="left: 41.6667%; width: 33.3333%;"></div><div class="slider-handle round left-round" style="left: 41.6667%;"></div><div class="slider-handle round" style="left: 75%;"></div></div><div class="tooltip top" style="top: -30px; left: 62.5833px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">250 : 450</div></div><input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" style=""></div><br>
            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
        </div>
    </div><!--/price-range-->

    <div class="shipping text-center"><!--shipping-->
        <img src="images/home/shipping.jpg" alt="">
    </div><!--/shipping-->

</div>
