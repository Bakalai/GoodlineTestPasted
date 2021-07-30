@php use Carbon\Carbon;


@endphp
@extends('layout')
@section('page_title') Паста по ссылке @endsection
@section('main_content')
    <h1>Прямая "Паста" </h1>

    @foreach($publicates->reverse() as $el)
    @php
        $iscurrent = "/" . $el -> hash == $_SERVER['REQUEST_URI']  ;                                               // $_SERVER['REQUEST_URI']

        $deda = $el -> created_at->addSeconds($el -> lifetime) ;                                                  //deda - время конца жизни публикации
        $timenow = Carbon::now();
        $showornot = $timenow < $deda;                                                                            // Весь вывод зависит от переменной showornot, expiration time проверка

    @endphp
    @if(   $iscurrent and $showornot  )
    <div class="alert alert-info">
        <h3>{{$el -> subject}}</h3>
        @if($el -> anon == 1)
            <b>Аноним</b>
        @else
            <b> {{ DB::table('users')->whereIn('id', array($el -> authorId))->get("name")[0] -> name }}    </b>      <!-- Если анонимная запись, то скрываем, иначе вывод name пользоватея по id -->

        @endif

        <p>{{$el -> message}}</p>
        <h6>{{$el -> created_at}}</h6>
        <p >{{ $_SERVER['HTTP_HOST']."/" .$el -> hash }}</p>

    </div>
    @endif
    @endforeach
@endsection
