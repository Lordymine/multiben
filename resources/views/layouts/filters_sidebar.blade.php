<div class="col-xl-3 col-lg-4 order-lg-1">
    <button class="sidebar-toggle position-left" data-toggle="modal" data-target="#modalShopFilters"><i class="icon-layout"></i></button>
    <aside class="sidebar sidebar-offcanvas">
        <!-- Widget Categories-->
        <section class="widget widget-categories">
        <h3 class="widget-title">categorias</h3>
        <ul>
            @foreach($categories as $category)
            <li class="has-children"><a href="{{route("companies_index",$category->id)}}">{{$category->nome}}</a><span>({{ App\Repositories\CategoriesRepository::getCategoriesQtdEmpresas($category->id)  }})</span>
            @endforeach
        </ul>
        </section>
        <!-- Widget Price Range-->
        <section class="widget widget-categories">
        <h3 class="widget-title">valor do desconto</h3>
        <form class="price-range-slider" method="post" data-start-min="5" data-start-max="100" data-min="0" data-max="100" data-step="1">
            <div class="ui-range-slider"></div>
            <footer class="ui-range-slider-footer">
            <div class="column">
                <button class="btn btn-outline-primary btn-sm" type="button" id="deduction">Filtrar</button>
            </div>
            <div class="column">
                <div class="ui-range-values">
                <div class="ui-range-value-min">%<span></span>
                    <input type="hidden" name="deduction_min" id="deduction_min">
                </div>&nbsp;-&nbsp;
                <div class="ui-range-value-max">%<span></span>
                    <input type="hidden" name="deduction_max" id="deduction_max">
                </div>
                </div>
            </div>
            </footer>
        </form>
        </section>

        <!-- Widget Brand Filter-->
        <section class="widget">
        <h3 class="widget-title">Filtrar por cidade</h3>

        @foreach($cidades as $cidade)
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input filtro_cidade" type="checkbox" name="cidades_filter[]" value="{{$cidade->id}}" id="{{$cidade->id}}_{{$cidade->uf}}">
            <label class="custom-control-label" for="{{$cidade->id}}_{{$cidade->uf}}">{{$cidade->nome}} - {{$cidade->uf}}</label>
        </div>
        @endforeach

        </section>

    </aside>
</div>
