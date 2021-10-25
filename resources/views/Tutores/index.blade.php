@extends('layouts.app')

@section('content')
<head>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  
</head>

<body>
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="tutorados-tab" data-toggle="tab" href="#tutorados" role="tab" aria-controls="tutorados" aria-selected="true">Tutorados</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="file-tab" data-toggle="tab" href="#file" role="tab" aria-controls="profile" aria-selected="true">Archivos</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tutorados" role="tabpanel" aria-labelledby="tutorados-tab">
                @include('Tutores.tutorados')
            </div>
        
            <div class="tab-pane fade" id="file" role="tabpanel" aria-labelledby="file-tab">
                   @include('Tutores.archivo')  
            </div>
        </div>
    </div>
</body>


@endsection
