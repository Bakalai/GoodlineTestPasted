@extends('layout')
@section('page_title') Личный кабинет @endsection
@section('main_content')
    <h1>Личный кабинет</h1>
    <p> Тут отображены только ваши "пасты"</p>

    @php
        use App\Models\pasted;
        use Carbon\Carbon;
            $publicates = new pasted();
            $publicates = $publicates->all();

    @endphp
    <br>
    <h1>Ваши  записи </h1>
    @foreach($publicates->reverse() as $el)                                                                             {{-- $publicates->reverse() взовращает перевернутую коллекцию --}}
    @php
        $deda = $el -> created_at->addSeconds($el -> lifetime) ;                                                        //deda - время конца жизни публикации
        $timenow = Carbon::now();
        $immortalnost = $el -> lifetime == 3;
        $showornot = $timenow < $deda ;                                                                                  // Весь вывод зависит от переменной showornot, expiration time проверк
    @endphp

    @if(  ($showornot or $immortalnost) and (Auth::check() and $el-> authorId == Auth::user()->id))             <!-- счет до 10 тут же, Если доступ не только по ссылке или (пользователь и авторизован и совпадает с автором)-->
    <div class="alert alert-info">
        <h3>{{$el -> subject}}</h3>
        @if($el -> anon == 1)
            <b>Аноним</b>
        @else
            <b> {{ DB::table('users')->whereIn('id', array($el -> authorId))->get("name")[0] -> name }}    </b>         <!-- Если анонимная запись, то скрываем, иначе вывод name пользоватея по id -->

        @endif

        <p>{{$el -> message}}</p>
        <h6>{{$el -> created_at}}</h6>
        <a href="{{$el -> hash}}">{{ $_SERVER['HTTP_HOST']."/" .$el -> hash }}</a>

    </div>
    @endif
    @endforeach

@endsection
