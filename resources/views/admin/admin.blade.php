<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <title>@yield('title') | Administration</title>
    <style>
        @layer reset{
            button{
                all : unset
            }
        }
        .htmlx-indicator{
            display: none;
        }
        .htmlx-request .htmlx-indicator{
            display: inline-block;
        }
        .htmlx-request.htmlx-indicator{
            display: inline-block;
        }
        
        nav{
            background: #fff;

        }
        nav a{
            text-decoration: none;
            color: #555555;
            padding: 10px;
        }
        .identity{
            display: block;
            /* align-items: center; */
        }

    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container">
            <a href="/" class="navbar-brand identity">                
                <img src="{{ asset('logo/papabailleur.png') }}" alt="logo" width="90"  class="d-flex">
                <span class="text_identity" >{{ config('app.name')}}</span>
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" >
                <span class="navbar-toggler-icon"></span>
            </button>
            @php
                $route = request()->route()->getName();
            @endphp
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav" style="color: black; ">
                    <li class="nav-item">
                        <a href="{{route('admin.area.index')}}">
                            Les Communes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.quarter.index')}}">
                            Les quarters
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.category.index')}}">
                            Les catégories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.property.index')}}" >
                            Les biens
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.owner.index')}}" >
                            Les Bailleurs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.follower.index')}}" >
                            Les Abonnés
                        </a>
                    </li>
                </ul>
                <div class="ms-auto">
                    @auth
                        <ul class="navbar-nav navProfil">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{auth()->user()->username ? auth()->user()->username : 'Profile'}}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">                                    
                                    @if (auth()->user()->role== 'admin')
                                        <li class="nav-item m-2 ">
                                            <a href="{{route('admin.dashboard')}}">Dashboard</a>    
                                        </li>                                
                                    @endif
                                    @if (auth()->user()->role== 'owner')
                                        <li class="nav-item m-2 ">
                                            <a href="{{route('owner.dashboard')}}">Dashboard</a>    
                                        </li>                                
                                    @endif
                                    <li>
                                        <a class="dropdown-item" href="{{route('profile.edit')}}">
                                            Editer Profile
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <form action="{{route('logout')}}" method="POST">
                                                @csrf                                    
                                                <button class="nav-link text-danger"  style="border: none; background-color:white; color:black">
                                                    Se Déconnecter
                                                </button>
                                            </form>
                                    </a>
                                </li>
                                </ul>
                            </li>
                        </ul>

                    @endauth
                </div>
            </div>
        </div>
    </nav>    
    {{-- <nav class="navbar navbar-expand-lg navbar-dark d-block w-100" style="position: fixed; top:0; z-index:999999; background-color: white; box-shadow:0 2px 5px rgb(230, 230, 230)">
        <div class="container-fluid">
            <a href="/" class="navbar-brand">                
                <img src="{{ asset('logo/papabailleur.png') }}" alt="" width="90"  class="d-flex">
                <span class=" fw-bold text-dark" style="font-size:15px; position: absolute; top:65px; left:15px">{{ config('app.name')}}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggeler-icon"></span>
            </button>
            @php
                $route = request()->route()->getName();
            @endphp
            <div class="navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item" >
                        <a href="{{route('admin.area.index')}}">
                            Les Communes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.quarter.index')}}">
                            Les quarters
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.category.index')}}">
                            Les catégories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.property.index')}}" >
                            Les property
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.owner.index')}}" >
                            Les Bailleurs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.follower.index')}}" >
                            Les Abonnés
                        </a>
                    </li>
                </ul>
                <div class="ms-auto">
                    @auth
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{route('profile.edit')}}">  
                                    <span class="nav-link"  style="border: none; background-color:white; color:black">
                                        {{auth()->user()->username ? auth()->user()->username : 'Profile'}}
                                    </span>
                                </a>
                            </li> -
                            <li class="nav-item">
                                <form action="{{route('logout')}}" method="POST">
                                    @csrf                                    
                                    <button class="nav-link"  style="border: none; background-color:white; color:black">
                                        Se Déconnecter
                                    </button>
                                </form>
                            </li>
                        </ul>

                    @endauth
                </div>
            </div>
        </div>
    </nav> --}}
    {{-- @include('shared.flash') --}}
    <div class="container"  style="z-index: -9999999; margin-top:100px">
        @include('shared.flash')
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="shca384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        new TomSelect('select[multiple]', {plugins: {remove_button: {title: 'Supprimer'}}})
    </script>
</body>
</html>