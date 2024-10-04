<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MinervaLaController extends Controller
{
    public function showAula($id)
    {
        // Inicializar las variables
        $aulaData = null;
        $zonaRelacionada = null;
        $imagenes = [];
        $latitude = '13.4834';  // Coordenada predeterminada
        $longitude = '-88.1834';  // Coordenada predeterminada

        // Obtener datos del aula
        $aulaResponse = Http::get('https://ues-api-production.up.railway.app/aulas/' . $id);
        $zonasResponse = Http::get('https://ues-api-production.up.railway.app/zonas');
        $fotosAulaResponse = Http::get('https://ues-api-production.up.railway.app/aula_fotos');

        if ($aulaResponse->successful() && !empty($aulaResponse->json()['data'])) {
            $aulaData = $aulaResponse->json()['data'];
            $zonaRelacionada = collect($zonasResponse->json()['data'])->firstWhere('id', $aulaData['zona']);

            // Filtrar las fotos que correspondan al aula
            $imagenes = collect($fotosAulaResponse->json()['data'])
                ->where('aula_id', $id)
                ->pluck('foto.url_foto')
                ->toArray();

            // Extraer las coordenadas si están disponibles
            if (isset($zonaRelacionada['coordenadas'])) {
                $coordenadas = explode(',', $zonaRelacionada['coordenadas']);
                $latitude = $coordenadas[0] ?? $latitude;
                $longitude = $coordenadas[1] ?? $longitude;
            }
        }

        // Pasar los datos a la vista
        return view('minerva-la', compact('aulaData', 'imagenes', 'zonaRelacionada', 'latitude', 'longitude'));
    }

    public function showReferencia($id)
    {
        // Inicializar las variables
        $referenciaData = null;
        $zonaRelacionada = null;
        $imagenes = [];
        $latitude = '13.4834';  // Coordenada predeterminada
        $longitude = '-88.1834';  // Coordenada predeterminada

        // Obtener datos de la referencia
        $referenciaResponse = Http::get('https://ues-api-production.up.railway.app/referencias/' . $id);
        $zonasResponse = Http::get('https://ues-api-production.up.railway.app/zonas');
        $fotosReferenciaResponse = Http::get('https://ues-api-production.up.railway.app/fotos_referencias');

        if ($referenciaResponse->successful() && !empty($referenciaResponse->json()['data'])) {
            $referenciaData = $referenciaResponse->json()['data'];
            $zonaRelacionada = collect($zonasResponse->json()['data'])->firstWhere('id', $referenciaData['zona']);

            // Filtrar las fotos que correspondan a la referencia
            $imagenes = collect($fotosReferenciaResponse->json()['data'])
                ->where('referencia_id', $id)
                ->pluck('foto.url_foto')
                ->toArray();

            // Extraer las coordenadas si están disponibles
            if (isset($referenciaData['coordenadas'])) {
                $coordenadas = explode(',', $referenciaData['coordenadas']);
                $latitude = $coordenadas[0] ?? $latitude;
                $longitude = $coordenadas[1] ?? $longitude;
            }
        }

        // Pasar los datos a la vista
        return view('minerva-la', compact('referenciaData', 'imagenes', 'zonaRelacionada', 'latitude', 'longitude'));
    }

}
