@extends('layouts.app')
@section('content')

    <form action="{{ url('/fileUpDrBx') }}" method="post" style="display:inline;" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="file"  id="file" class="form-control" accept="application/pdf, .doc, .docx" >
        <button type="submit">Simon</button>
    </form>

    @isset($tableDrBx)
        <table class="table">
            <tr>
                <td>nombre</td>
                <td>tamaño</td>
                <td>extension</td>
                <td>url</td>
            </tr>
            
                @foreach ($tableDrBx as $e)
                <tr>
                    <td >{{ $e->name }}</td>
                    <td >{{ $e->size }}</td>
                    <td >{{ $e->extension }}</td>
                    <td><a  href="{{ $e->public_url  }}">{{ $e->public_url }}</a></td>
                </tr>
                @endforeach 
            
            
        </table>
    @endisset
    
@endsection