@extends('base')

@section('title')

@section('content')
<!-- Contenedor del menú -->
<div class="menu-container">
    @if(isset($departments) && count($departments) > 0)
        @foreach($departments as $department => $cards) <!-- Aquí obtienes la clave y los datos -->
            <a href="#{{ strtolower(str_replace(' ', '', $department)) }}" class="menu-item">{{ $department }}</a> <!-- $department es la clave (nombre de la zona) -->
        @endforeach
    @else
        <p>No hay departamentos disponibles en este momento.</p>
    @endif
</div>

<!-- Sección con las tarjetas -->
<div class="container-fluid">
    <div class="row  m-5">
        @foreach($departments as $department => $cards)
            <div class="col-12 mb-6" id="{{ strtolower(str_replace(' ', '', $department)) }}">
                <h2 class="section-title">{{ $department }}</h2>
                <div class="row">
                    @foreach(array_slice($cards, 0, 8) as $card)
                    <div class="col-md-3 mb-4 ">
                        <div class="card h-100 d-flex flex-column ">
                            <a href="{{ route('minerva-la') }}" class="text-decoration-none ">
                                <img src="{{ explode(',', $card['foto'])[0] }}" class="card-img-top img-fluid" alt="{{ $card['nombre'] }}">
                                <div class=" mt-5">
                                    <h5 class="card-title title-card">{{ $card['nombre'] }}</h5>
                                    <p class="card-text text-card">{{ $card['descripcion'] }}</p>
                                    <p class="card-text text-card">Coordenadas: {{ $card['coordenadas'] }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                

                @if(count($cards) > 8)
                <div class="col-13 mb-4" id="more-{{ strtolower(str_replace(' ', '', $department)) }}" style="display: none;">
                    <div class="row">
                        @foreach(array_slice($cards, 8) as $card)
                        <div class="col-md-3 mb-4 card-container">
                            <div class="card h-100">
                                <a href="{{ route('minerva-la') }}" class="text-decoration-none text-dark">
                                    <img src="{{ explode(',', $card['foto'])[0] }}" class="card-img-top img-fluid" alt="{{ $card['nombre'] }}">
                                    <div class="card-body d-flex flex-column justify-content-end">
                                        <h5 class="card-title title-card">{{ $card['nombre'] }}</h5>
                                        <p class="card-text text-card">{{ $card['descripcion'] }}</p>
                                        <p class="text-card">Coordenadas: {{ $card['coordenadas'] }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn" id="toggle-{{ strtolower(str_replace(' ', '', $department)) }}" onclick="showMoreCards('more-{{ strtolower(str_replace(' ', '', $department)) }}', this)">Ver más</button>
                </div>
                @endif
            </div>
        @endforeach
    </div>
</div>

@endsection