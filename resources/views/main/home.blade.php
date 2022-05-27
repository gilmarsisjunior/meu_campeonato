@extends('layout.layout')
@section("title", "Início")

@section('content')
<form action="{{route('teams.create')}}" method="POST">
    @csrf

    <div class="form-group col-md-4">
      <label for="name">Nome dos Times</label>
      <input type="name1" class="form-control" id="name1" name="name1" aria-describedby="emailHelp" placeholder="Digite o nome do time 1">
    </div>
 
    <div class="form-group col-md-4">
        <input type="name2" class="form-control" id="name2" name="name2"aria-describedby="emailHelp" placeholder="Digite o nome do time 2">
    </div>
    <div class="form-group col-md-4">
        <input type="name3" class="form-control" id="name3" name="name3" aria-describedby="emailHelp" placeholder="Digite o nome do time 3">
    </div>
    <div class="form-group col-md-4">
        <input type="name4" class="form-control" id="name4" name="name4"  aria-describedby="emailHelp" placeholder="Digite o nome do time 4">
    </div>
    <div class="form-group col-md-4">
        <input type="name5" class="form-control" id="name5" name="name5" aria-describedby="emailHelp" placeholder="Digite o nome do time 5">
    </div>
    <div class="form-group col-md-4">
        <input type="name6" class="form-control" id="name6" name="name6" aria-describedby="emailHelp" placeholder="Digite o nome do time 6">
    </div>
    <div class="form-group col-md-4">
        <input type="name7" class="form-control" id="name7" name="name7" aria-describedby="emailHelp" placeholder="Digite o nome do time 7">
    </div>
    <div class="form-group col-md-4">
        <input type="name8" class="form-control" id="name8" name="name8" aria-describedby="emailHelp" placeholder="Digite o nome do time 8">
    </div>

    <div class="form-group col-md-4">
        <input type="name8" class="form-control" id="group" name="group" aria-describedby="emailHelp" placeholder="Digite o nome GRUPO">
    </div>






  <div>
      <button type="submit"class="btn btn-primary">Criar Campeonato</button>
  </div>
</form>
@endsection