<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Lider;
use App\Companero;
use Illuminate\Support\Collection as Collection;



class GrupoController extends Controller
{

    public function index()
    {

        $lideres = Lider::all();
        $companeros = Companero::all();

        return view('listado', array(
            'lideres' => $lideres,
            'companeros' => $companeros
        ));
    }



    public function seleccionar($id = null)  //Envía disponibles
    {

        /*Lógica: 
        
        Dado un id de líder, estos son los incompatibles:
        1. Su líder                                 id == companero_id   companero_id->lider_id
        2. Compañeros pertenecen a mismo lider, excluyéndose a sí mismo     
        3. Sus compañeros si es lider               id == lider_id   todos los companero_id
        4. Él mismo                                 id  
        

        Caso 1:
        A->B->C
        D->A       PERMITIDO

        Caso 2:
        A->B->C
        B->D  (D->A)
        D->A   	   NO PERMITIDO

        Caso 3:
        A->B
        C->A
        B->C  NO PERMITIDO

        Caso 4. No problema
        A->B->C
        D->E

        */



        //Lider de Bloque Izq será $id. Enviarlo en return view

        $liderDelRecibido = null;
        $relacionados = Companero::all();
        $incompatibles = array();
        $disponibles = array();

        

        //Su lider, si tiene           
        foreach($relacionados as $relacionado){
             if ($id == $relacionado->companero_id) {
                 $liderDelRecibido = $relacionado->lider_id;
             }
        }


        //Si tiene lider, añadir a incompatibles los compañeros de ese lider, si no son él mismo
        if ($liderDelRecibido != null) {
            foreach($relacionados as $relacionado){
                if( $relacionado->lider_id == $liderDelRecibido  &&  $relacionado->companero_id != $id  ) {
                    $incompatibles[] = $relacionado->companero_id;   
                }
            }
            //Y añadir lider a incompatibles
            $incompatibles[] = $liderDelRecibido;
        }



        //Incompatibilizar sus compañeros si es lider
        foreach($relacionados as $relacionado){
            if( $relacionado->lider_id == $id ) {
                $incompatibles[] = $relacionado->companero_id;   
            }
        }


        //Añadirse a sí mismo a incompatibles
        $incompatibles[] = $id;
         
        
        //Deducir los disponibles restando (todos - incompatibles)  
        for ($i=1; $i<=5; $i++){ 
            $coincide = false;
            foreach($incompatibles as $incompatible){
                if ($incompatible == $i) $coincide = true;
            }
            if ($coincide == false){
                $disponibles[] = $i;
            }
        }
        
        //Ordenar por valores
        sort($disponibles);

        //Envia líder
        $lider = Lider::find($id);
       

        /*
        $bolasDisponibles = new Lider;

        foreach ($disponibles as $disponible){
                $bolasDisponibles = Lider::find($disponible)->get();   
        }
       */


        return view('seleccionar', array(
                                'lider' => $lider, 
                                'disponibles' => $disponibles)
        );

        
    }    





    public function guardar(Request $request){

    	//Validar 
    	$validatedData = $this->validate($request, [
    		'id' => 'required|numeric|max:5'
        ]);

    	$companero = new Companero();
    	$companero->companero_id = $request->input('companero_id');
    	$companero->lider_id = $request->input('lider_id');

    	$companero->save();

    	return redirect()->route('home')->with(array(
    			'message' => 'El compañero se ha añadido correctamente.'
    		));

    }





    public function reiniciar(Request $request)
    {
        $companero= Companero::findAll();
        $companero->delete();

        return redirect()->route('home')->with(array(
    		'message' => 'Relaciones borradas correctamente.'
    	));
    }

}