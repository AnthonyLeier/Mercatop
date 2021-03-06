@extends('layouts.template')
@section('pagina')

<table class="table table-bordered table-striped mt-4">
	<thead>
		<th>CEP</th>
		<th>Descrição</th>
		<th>Logradouro</th>
		<th>Número</th>
		<th>Bairro</th>		
		<th>Cidade</th>		
		<th>Alteração</th>		
		<th>Exclusão</th>
	</thead>
	@foreach (Auth::user()->enderecos as $elemento)	
	<tbody>
		<td>{{$elemento->cep}}</td>
		<td>{{$elemento->descricao}}</td>
		<td>{{$elemento->logradouro}}</td>
		<td>{{$elemento->numero}}</td>
		<td>{{$elemento->bairro}}</td>
		@if(isset($elemento->cidade))<td>{{$elemento->cidade->nome."-".$elemento->cidade->estado}}</td>@else<td>Cidade Deletada</td>@endif
		<td><a href="{{route('tela_alterar_endereco', ["id" => $elemento->id])}}" class="btn btn-warning btn-block">Alterar</a></td>
		<td><a href="#" onclick="exclui({{$elemento->id}})" class="btn btn-danger btn-block">Excluir</a></td>
	</tbody>
	@endforeach
</table>
<a href="{{route('tela_adicionar_endereco')}}" class="btn btn-primary btn-block">Novo Endereço</a>

<script>
    function exclui(id) {
        if (confirm("Deseja excluir o endereco de id: " + id + "?")) {
            location.href = "/endereco/excluir/" + id;
        }
    }
</script>
@endsection