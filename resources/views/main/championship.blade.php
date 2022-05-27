@extends('layout.layout')
@section("title", "Início")
@section('content')

    <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Nome Time</th>
            <th scope="col">GRUPO</th>
            <th scope="col">CHAVE</th>
            <th scope="col">GOLS MARCADOS</th>
            <th scope="col">GOLS SOFRIDOS</th>
            <th scope="col">PONTUAÇÃO</th>
            <th scope="col">ETAPA</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $match)
          <tr>
            <td>{{$match["name"]}}</td>
            <td>{{$match["group"]}}</td>
            <td>{{$match["key"]}}</td>
            <td>{{$match["goals"]?? 'None'}}</td>
            <td>{{$match["taken"]??'None'}}</td>
            <td>{{$match["points"] ?? 'None'}}</td>
            <td>{{$match['match'] ?? 'None'}}</td>
          </tr>
          @endforeach
        </tbody>
       
      </table>
      <h1 style="background-color: green">VENCEDOR: {{$winner->name}} {{$mensagem}}</h1>
@endsection