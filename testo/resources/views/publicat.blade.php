@php use Carbon\Carbon; @endphp
@extends('layout')
@section('page_title') CreateRead @endsection
@section('main_content')
    <h1>Форма добавления "Пасты"</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="/publicat/check">
        @csrf
        <input type="hidden" name="anon" id="anon" value="0">
        <input  type="checkbox"   name="anon" id="anon" class="form-check-input" value="1"> <span> Анонимно? </span> <br>
        <input type="hidden" name="forall" id="forall" value="0">
        <input  type="checkbox" name="forall" id="forall" class="form-check-input" value="1"> <span> Доступ только по ссылке  (войдите, чтобы воспользоваться этим функционалом)</span> <br>
        <input type="text" name="subject" id="subject" placeholder="Введите заголовок" class="form-control"> <br>
        <textarea name="message" id="message" class="form-control" placeholder="Ввведите текст" rows="15" ></textarea> <br>

        <select class="form-select" name="lifetime" id="lifetime">
                <option value="600"> 10 минут</option>
                <option value="3600"> 1 час</option>
                <option value="10800"> 3 часа</option>
                <option value="86400"> 1 день</option>
                <option value="604800"> 1 неделя</option>
                <option value="2419200"> 1 месяц</option>
                <option value="3"> Без ограничения</option>

            </select>
        <br>
        <button type="submit" class="btn btn-outline-success"> Нажми </button>
    </form>

@endsection
