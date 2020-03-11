@extends('home')

@section('content')
<div class="container">
        <p class="text-center">Pulsar en cualquier bola líder para elegir sus compatibles</p>

       
        <div class="table-responsive-md">
            <table class="table table-bordered">
                <thead>
                    <th>Bolas líderes</th>
                    <th colspan="4">Bolas compatibles con líder</th>
                </thead>
                <tbody> 
                    @foreach($lideres as $lider) <!-- Imprime líderes -->
                    <tr> 
            
                        <!-- Botón agregar compañeros -->
                        <td> <a href="{{ route('seleccionar', ['id' => $lider->id]) }}" 
                        class="bola" style="background:{{$lider->color}}">{{ $lider->id }}</a>  </td>
                        

                        <td colspan="4">
                        @foreach($companeros as $companero) <!-- Imprime compañeros -->
                            @if ( $lider->id == $companero->lider->id )
                            <div class="bola" style="background:{{$companero->lider->color}}">{{ $companero->companero_id }} </div>
                            @endif    
                        @endforeach
                        </td>

                    </tr>
                    @endforeach
                    
                 </tbody>   
               
            </table> 

            <!-- Botón reiniciar relaciones -->
            <a href="" role="button" class="btn btn-success">Reiniciar</a>
        </div>
</div><!-- Fin container -->
@endsection