<div>

    <div class="container">
    <center>
    <h2>Memoria De Estadia</h2>
    <center>
    
        <div class="row">
            
                <div class=" col-lg-2 col-md-3 col-sm-3">

                 
                     <form action="{{url('/biblioteca')}}" method="post">
                     {{csrf_field()}}
                        <button type="submit" class="btn btn-success">aprobar memoria</button>
                   	
               
                 
                 
                </div>
                
                <div id="info" class="col-lg-5   col-md-1 col-sm-1">

                 <form action="{{url('/biblioteca')}}" method="post">
                     {{csrf_field()}}
                     <br>
                     
                        
                       
                        <br>
                        <button type="submit" class="btn btn-warning">Regresar memoria
                        </button>
                    </form>
                </div>
                    
                    <div class="com" class="card float-right  col-lg-5    col-md-6 col-sm-5 "  style="width: 15rem;">
                        <form action="{{url('/biblioteca')}}" method="post">
                        {{csrf_field()}}
                        <ul class="list-group list-group-flush" style="height: 3.5rem;">
                            <li class="list-group-item">
                                <h3 class="text-center">Comentarios</h3>
                             </li>
                        </ul>
                        
                        <div class="card-footer">
                            <textarea class="form-control" name="texto" id="texto" cols="10" rows="4" placeholder="Escribe aqui tus comentarios"></textarea>
                               {{$errors}} 
                                <br>
                                <button type="submit" class="btn btn-success">Envíar</button>
                        </div>
                        </form>
                    </div>  
            </div>
    </div>
</div>



