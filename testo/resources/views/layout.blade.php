<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page_title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
<div class="container py-3">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">TestoPasta</span>
            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="/">Главная</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="/about">Про нас</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="/publicat">Textы </a>
                <?php  if (Auth::check()) {                                                                                 // Проверка на авторизацию посетителя
                $user = Auth::user(); ?>
                <a href="/lk" class="me-3 py-2 text-dark text-decoration-none"> Здравствуй: <?php print( $user -> name) ; ?> </a>

                <a  class="btn btn-primary" href="{{ url('/logout') }}"> Выйти </a>
                <?php
                } else {                                                                                                     // Вывод соответствующих ссылок в навигации сайта

                ?>
                <a class="me-3 py-2 text-dark text-decoration-none" href="/login">Авторизация </a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="/register"> Регистрация </a>
                <?php
                }
                ?>

            </nav>
        </div>
    </header>

    @yield('main_content')
    @php
        use App\Models\pasted;
        use Carbon\Carbon;
            $publicates = new pasted();
            $publicates = $publicates->all();
            $last10 = 0                                                                                                 // Вывод последних 10 из возможных (у некоторых могло и время доступа выйти)
    @endphp
    <br>
    <h1>Последние 10 </h1>
    @foreach($publicates->reverse() as $el)                                                                             {{-- $publicates->reverse() взовращает перевернутую коллекцию --}}
        @php
        $deda = $el -> created_at->addSeconds($el -> lifetime) ;                                                        //deda - время конца жизни публикации
        $timenow = Carbon::now();
        $immortalnost = $el -> lifetime == 3;
        $showornot = $timenow < $deda ;                                                                                  // Весь вывод зависит от переменной showornot, expiration time проверк
        @endphp

        @if( $last10 < 10  and ( $showornot or $immortalnost) and ($el -> forall == 0 or (Auth::check() and $el-> authorId == Auth::user()->id)) )            <!-- счет до 10 тут же, Если доступ не только по ссылке или (пользователь и авторизован и совпадает с автором)-->
            @php $last10+=1; @endphp
        <div class="alert alert-info">
            <h3>{{$el -> subject}}</h3>
            @if($el -> anon == 1 or $el -> authorId == null)
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
</div>

</body>

</html>
