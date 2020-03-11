 
@extends('home')

@section('content')

<div class="container">
        <p class="text-center">Elegir otra bola compatible con líder</p>

       
        <div class="table-responsive-md">
            <table class="table table-bordered">
                <thead>
                    <th>Bola líder</th>
                    <th colspan="4">Bolas disponibles</th>
                </thead>
                <tbody> 
                  
                    <tr> 
                        <!-- Imprime líder  -->
                        <td> <div class="bola" style="background:{{$lider->color}}">{{ $lider->id }}</div> </td>
                      
                        
                        <td colspan="4">
                      
                        @php  
                        print_r($disponibles); 
                        @endphp

                        </td>

                    </tr>
                  
                    
                 </tbody>   
               
            </table> 
          <!-- Botón reiniciar relaciones -->
          <a href="{{ route('home') }}" role="button" class="btn btn-success">Regresar a tabla</a>
        </div>
</div><!-- Fin container -->


@endsection