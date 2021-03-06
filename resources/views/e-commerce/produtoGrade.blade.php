@extends('layouts.template') 

@section('pre-pagina')

@if($mostrarCarousel)

    <div id="carouselExampleIndicators" class="carousel slide w-100" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/storage/banners/1.jpg" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="/storage/banners/2.jpg" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="/storage/banners/3.jpg" class="d-block w-100" alt="..." />
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Próximo</span>
        </a>
    </div>

@endif
@endsection 

@section('pagina')
<div class="row mt-3">
    @foreach($listaProdutos as $produto)
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card" style="width: 18rem;">
            <a href="{{route('tela_detalhes', ['slug' => $produto->slug])}}">
            @if(isset($produto->fotos->first()->nome))
            <img src="{{url($produto->fotos->first()->nome)}}" class="card-img-top" alt="..." width="100" height="200" />
            @endif
            </a>
            <div class="card-body">
                <h5 class="card-title">{{$produto->nome}}</h5>
                <p class="card-text font-weight-bold">Preço: R${{$produto->valor}}</p>
                <form method="POST" action="{{ route('adicionar_carrinho') }}">
                    @csrf
                    <div>
                        <input type="text" class="form-control" placeholder="Quantidade" name="quantidade">                      
                        <input type="text" class="form-control" value="{{$produto->id}}" name="id_produto" hidden>
                        <button type="submit" id="botao_verde" class="btn btn-primary btn-block mt-1">Adicionar ao Carrinho</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{$listaProdutos->links()}} @endsection
