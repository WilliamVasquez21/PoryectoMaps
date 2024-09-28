<?php

    $images = [
        ['src' => 'https://via.placeholder.com/502x481', 'alt' => 'Imagen 1'],
        ['src' => 'https://via.placeholder.com/502x481', 'alt' => 'Imagen 2'],
        ['src' => 'https://via.placeholder.com/502x481', 'alt' => 'Imagen 3'],
        ['src' => 'https://via.placeholder.com/1025x509', 'alt' => 'Imagen grande'],
        ['src' => 'https://via.placeholder.com/502x481', 'alt' => 'Imagen 4'],
        ['src' => 'https://via.placeholder.com/502x481', 'alt' => 'Imagen 5']
    ];

?>

@extends('base')

@section('title')


@section('content')
    <!-- Botón de retorno en la parte superior izquierda -->
    <a href="javascript:history.back()" class="circle-button">
        <div class="inner-circle">
            <!-- Icono de retorno usando FontAwesome -->
            <i class="fas fa-arrow-left"></i>
        </div>
    </a>

    <div class="container">
        <div class="content">
            <!-- Usamos un foreach para iterar sobre las imágenes recibidas -->
            @foreach($images as $index => $image)
                @if($index % 2 == 0)
                    <!-- Abrimos una nueva fila cada dos imágenes -->
                    <div class="image-row">
                @endif

                <!-- Mostramos la imagen -->
                <img class="image" src="{{ $image['src'] }}" alt="{{ $image['alt'] }}" />

                @if($index % 2 == 1 || $index == count($images) - 1)
                    <!-- Cerramos la fila si tenemos dos imágenes o si es la última imagen -->
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <!-- Footer al final del contenido -->
@endsection