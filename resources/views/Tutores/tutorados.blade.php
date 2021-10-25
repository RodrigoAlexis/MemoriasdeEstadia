    <center>
        <h2>Lista de Tutorados</h2>
    </center>
            <table class="table">
                <thead class="thead-light" >
                    <tr>
                        <th >#</th>
                        <th >Grupo</th>
                        <th >Matricula </th>
                        <th >Alumno</th>
                        <th >Correo Institucional</th>
                        <th >Accion</th>
                    </tr>
                </thead>
                        <tbody >
                            @foreach($tutorados as $tutorados)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$tutorados->grupo}}</td>
                                    <td>{{$tutorados->matricula}}</td>
                                    <td>{{$tutorados->nombre_alumno}}</td>
                                    <td>{{$tutorados->email_alumno}}</td>
                                    <td>
                                        <a class="btn btn-outline-secondary" target="" href="{{ url('Tutores/'.$tutorados->id_alumno) }}">
                                            Revicion
                                        </a>

                                        <a class="btn btn-outline-secondary" target="" href="{{ url('docs/'.$tutorados->id_alumno) }}">
                                            Documentacion 
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
            </table>