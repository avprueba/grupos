<?php


use App\Lider;
use App\Companero;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', array( 
	'as' => 'home',
	'uses' => 'GrupoController@index'
));



Route::get('/seleccionar/{id}', array( 
	'as' => 'seleccionar',
	'uses' => 'GrupoController@seleccionar'
));


/*
Route::get('/listado', function(){ 

        $lideres = Lider::all();
        foreach($lideres as $lider){
            echo $lider->id;
            echo $lider->color;
            echo '<hr/>';
        }
        die();
    

    //return view('welcome');
});
*/



