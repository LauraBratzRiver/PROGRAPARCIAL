@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Car Wash') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto CAR WASH</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
    
</head>

<body class="p-3 mb-2 bg-danger text-white" >
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">::.CAR WASH.::</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                  
            <li class="nav-item active">
            <a class="nav-link" href="#"> <span class="sr-only"></span></a>
                
            <li class="nav-item">
            <a @click="abrirForm('Cliente')" class="nav-link" href="C:\xampp\htdocs\PROGRAPARCIAL\CarWash\resources\js\components\ClienteComponent.vue">Clientes</>
           </li>
                  
          <li class="nav-item">
          <a @click="abrirForm('Reservacion')" class="nav-link"href="#">Reservacion</href=>
          </li>
                    
         </ul>
                
            </div>
        </div>
        <a class="navbar-brand" href="/">
<img src="https://img4.grocerymeta.com/773/381/4923291067733818.jpg#.Ym7yU6XjUic.link" width="100" height="100" class="d-inline-block align-top" alt="">
</a>

    </nav>
    
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/vue-select@latest"></script>
    <script src="https://unpkg.com/vue-select@latest/dist/vue-select.js"></script>
    
    <Cliente-component v-bind:form="forms" ref="Cliente" v-show="forms['Cliente'].mostrar" ></-component>
    <Reservacion-component v-bind:form="forms" ref="Reservacion" v-show="forms['Reservacion'].mostrar" ></-component>
    
</body>
     </div>
     </div>
     </div>
    </div>
</div>
@endsection
