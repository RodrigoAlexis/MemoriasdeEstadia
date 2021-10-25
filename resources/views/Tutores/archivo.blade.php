    <div class="text-center">
        <h1> Subida de Archivos</h1>
            <h5>(Carta de Presentación, Carta de Aceptación, Formato de Memoria de Estadia, Evaluación SAC-F-05)</h5>
            <br>
            <br>
                           
                <form action="{{url('/Tutores')}}" method="POST" enctype="multipart/form-data">
                     @csrf
                        <select class="custom-select col-8 col-lg-8 col-md-8 col-sm-12" id="select" name="select" onchange="show(this)">
                            <option value="0">Selecciona una opción</option>
                            <option value="Carta de presentacion">Carta de Presentación</option>
                            <option value="Carta de aceptacion">Carta de Aceptación</option>
                            <option value="Formato de Memoria de Estadia">Formato de Memoria de Estadia</option>
                            <option value="Evaluacion SAC-F-05" >Evaluación SAC-F-05</option>
                        </select>
                        <br>
                        <br>
                        <div>
                            <table class="table">
                                <tr>
                                    <th>
                                        <div id="Upload" style="display:none">
                                            <label for="">Sube tu archivo</label>
                                            <br>
                                            <input type="file" name="txtFile" id="txtFile">
                                        </div>
                                        <br>
                                        <br>
                                            <center>
                                                <button type="submit" class="btn btn-success" id="button" style="display:none">Subir</button>
                                            </center>
                                    </th>  
                                </tr>
                            </table>
                        </div>
                </form>
     </div>

    <script>
        function show(select){
            if(select.value=='0'){
                document.getElementById('Upload').style.display = "none";
                document.getElementById('button').style.display = "none";
            }else if(select.value=='Carta de presentacion'){
                document.getElementById('Upload').style.display = "inline";
                document.getElementById('button').style.display = "inline";
            }else if(select.value=='Carta de aceptacion'){
                document.getElementById('Upload').style.display = "inline";
                document.getElementById('button').style.display = "inline";
            }else if(select.value=='Formato de Memoria de Estadia'){
                document.getElementById('Upload').style.display = "inline";
                document.getElementById('button').style.display = "inline";
            }else if(select.value=='Evaluacion SAC-F-05'){
                document.getElementById('Upload').style.display = "inline";
                document.getElementById('button').style.display = "inline";
            }
        }
    </script>