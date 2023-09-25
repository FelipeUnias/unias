<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//ex1
Route::get('/', function () {
    return view('welcome');
})->name('home');

//ex2
Route::get('/user/{id}',function($id){
    return $id;
})->name('user.profile');

//ex3
Route::get('/post/{slug}',function($slug){
    if($slug==1){
        return 'vc digitou um vc é feio';
    };
    return 'vc digitou'.$slug;
})->name('blog.post');

//ex4
Route::get('/category/{category}', function ($category) {
    if($category=='comida'){
        return 'categoria boa é esse de '.$category;
    }
    return "Posts da Categoria: $category";
})->name('blog.category')->where('category', '[a-zA-Z]+');

//ex5
Route::get('/user/{id}/language/{lang?}', function ($id, $lang = "pt-br" ) {
    
    return "o perfil do usuario é $id na língua $lang";
})->name('user.profile.language')->where('id', '[0-9]+')->where('lang', '[a-zA-Z]+');
//ex6
Route::get('/products/{category}/{minPrice?}', function ($category,$minPrice=10) {
    $produtos=[
        ['titulo'=>"comida",'categoria'=>'bebida', "preco"=>100],['titulo'=>"carro", 'categoria'=>'hb20', "preco"=>80000]
        ];
        $resultado=[];
        foreach($produtos as $produto){
            if ($produto['categoria']==$category && $produto['preco']<=$minPrice){
                $resultado[]=$produto;
            }
        }

    return $resultado;
})->name('products.category.price');

//7
Route::get('/page/{page}', function ($page) {
    return "Página Número: $page";
})->where('page', '[0-9]+')->name('page.number');

//8
Route::get('/convert/{money}', function ($money) {
    
    if (!preg_match('/^\d+(\.\d{1,2})?$/', $money)) {
        return "Formato inválido para o valor monetário.";
    }

    
    $usdValue = $money / 4.93; 

    return "Valor em Reais: R$ $money convertido para Dólar: $usdValue";
})->name('currency.converter');

//9
Route::get('/sum/{number1}/{number2}', function ($number1, $number2) {
    
    if (!is_numeric($number1) || !is_numeric($number2) || intval($number1) != $number1 || intval($number2) != $number2) {
        return "Os parâmetros devem ser números inteiros.";
    }

   
    $sum = $number1 + $number2;

    return "A soma de $number1 e $number2 é igual a $sum";
})->name('sum.numbers');
//10
Route::get('/sum/{number1}/{number2}/{arit}', function ($number1, $number2,$ARIT) {
    
    if (!is_numeric($number1) || !is_numeric($number2) || intval($number1) != $number1 || intval($number2) != $number2) {
        return "Os parâmetros devem ser números inteiros.";
    }
    
    if($ARIT == '-'){
        $sum = $number1 - $number2;
         return "A subtração de $number1 e $number2 é igual a $sum";
    }
    if($ARIT == '+'){
        $sum = $number1 + $number2;
         return "A soma de $number1 e $number2 é igual a $sum";
    }
    if($ARIT == '*'){
        $sum = $number1 * $number2;
         return "A multiplicação de $number1 e $number2 é igual a $sum";
    }
    if($ARIT == '%'){
        $sum = $number1 / $number2;
         return "A divisão de $number1 e $number2 é igual a $sum";
    }
    

   
})->name('sum.numbers');