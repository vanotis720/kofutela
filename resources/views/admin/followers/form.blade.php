@extends('admin.admin')

@section('title', 'Devenez Followers')
@section('content')

    <div class="container">

        <h1>@yield('title')</h1>
        <p>
            Suivi toutes les actualités de la plateforme.
        </p>
        
        @include('shared.flash')
        <form class="vstack gap-2" action="{{ route($follower->exists ? 'admin.follower.update' : 'admin.follower.store', $follower) }}" method="POST">
            @csrf
            @method($follower->exists ? 'put' : 'post')
    
            <div class="container m-3">
                <div class="container">
                    <div class="col container">
            
                        @include('shared.input', ['label' => 'Nom', 'class' => 'col', 'name' => 'nom', 'value' => $follower?->nom])
                        @include('shared.input', ['label' => 'Post-nom', 'class' => 'col', 'name' => 'postnom', 'value' => $follower?->postnom])
                        @include('shared.input', ['label' => 'Prenom', 'class' => 'col', 'name' => 'prenom', 'value' => $follower?->prenom])
                        @include('shared.input', ['label' => 'Email', 'type' => 'email', 'class' => 'col', 'name' => 'email', 'value' => $follower->email])
                        @include('shared.input', ['label' => 'Téléphone', 'type' => 'tel','class' => 'col', 'name' => 'phone', 'value' => $follower->phone])
                    </div>
                    
                </div>
                <div class="m-3">
                    <button class="btn btn-dark">
                        @if ($follower->exists)
                            Modifier
                        @else
                            Créer
                        @endif
                    </button>
                </div>
    
            </div>
        </form>
    </div>

@endsection