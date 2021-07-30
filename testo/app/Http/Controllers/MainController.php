<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\pasted;
use Auth, Hash;
use Carbon\Carbon;

class MainController extends Controller                                                 // сделал один контроллер т.к. проект маленький только больше путаницы бы возникло
{
    //
    public function home() {
        return view('home');
    }
    public  function about() {
        return view(view: 'about');
    }
    public function lk()
    {
        $publicates = new pasted();
        return view(view: 'lk', data: ['publicates' => $publicates->all()] );
    }
    public function onepasta()
    {
        $publicates = new pasted();
        return view(view: 'onepasta', data: ['publicates' => $publicates->all()]);
    }
    public function publicat() {

       return view(view: 'publicat') ;
    }
    public function publicat_check(Request $request) {
        $valid = $request->validate([
            'subject' => 'required|min:3|max:100',
            'message' => 'required|min:10|max:5000'
        ]) ;

        $pasted = new pasted();
        if (Auth::check()) {                                                                                 // Проверка на авторизацию посетителя
            $user = Auth::user();
            $pasted->authorId = $user -> id; }
        else {
            $pasted -> authorId = null;
        }
        $pasted -> anon = $request->input(key: "anon");
        $pasted -> forall = $request->input(key: "forall");
        $pasted -> subject = $request->input(key: "subject");
        $pasted -> message = $request->input(key: "message");
        $pasted -> lifetime = $request->input(key: "lifetime");
        $pasted -> hash = Hash::make(strlen($pasted -> message) .strval( time()) );                           // Не очень короткая ссылка, но зато уникальная =)


        $pasted->save();

        return redirect('publicat');
    }

}
