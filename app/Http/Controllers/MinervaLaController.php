<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MinervaLaController extends Controller
{
    public function showAula($id)
    {
        // Inicializar variables
        $aulaData = null;
        $zonaRelacionada = null;
        $imagenes = [];
        $videoUrl = null; // Para almacenar el enlace del video
        $latitude = '13.4834';  // Coordenada predeterminada
        $longitude = '-88.1834';  // Coordenada predeterminada

        // Obtener los datos del aula
        $aulaResponse = Http::get('https://ues-api-production.up.railway.app/aulas/' . $id);
        $zonasResponse = Http::get('https://ues-api-production.up.railway.app/zonas');
        $fotosAulaResponse = Http::get('https://ues-api-production.up.railway.app/aula_fotos');
        $aulaVideoResponse = Http::get('https://ues-api-production.up.railway.app/aula_video'); // Pivote aula-video
        $videosResponse = Http::get('https://ues-api-production.up.railway.app/videos'); // Lista de videos

        if ($aulaResponse->successful() && !empty($aulaResponse->json()['data'])) {
            $aulaData = $aulaResponse->json()['data']; // Datos del aula
            $zonaRelacionada = collect($zonasResponse->json()['data'])->firstWhere('id', $aulaData['zona']); // Obtener la zona

            // Filtrar las fotos correspondientes al aula
            $imagenes = collect($fotosAulaResponse->json()['data'])
                ->where('aula_id', $id)
                ->pluck('foto.url_foto')
                ->toArray();

            // Obtener el video_id correspondiente al aula desde el pivote
            $aulaVideo = collect($aulaVideoResponse->json()['data'])
                ->firstWhere('aula_id', $id);

            if ($aulaVideo) {
                // Si existe una relación aula-video, obtener el video_id y buscar el video
                $videoId = $aulaVideo['video_id'];
                $videoUrl = collect($videosResponse->json()['data'])
                    ->firstWhere('id', $videoId)['url'] ?? null;

                // Detectar si es un YouTube Short y convertir el enlace para embed
                if ($videoUrl) {
                    if (strpos($videoUrl, 'shorts') !== false) {
                        // Si es un Short, convertir el enlace para embed
                        $videoUrl = str_replace('youtube.com/shorts/', 'youtube.com/embed/', $videoUrl);
                    } else {
                        // Si es un vídeo regular, convertir el enlace al formato de embed
                        $videoUrl = str_replace('watch?v=', 'embed/', $videoUrl);
                    }
                }
            }

            // Extraer las coordenadas de la zona
            if (isset($zonaRelacionada['coordenadas'])) {
                $coordenadas = explode(',', $zonaRelacionada['coordenadas']);
                $latitude = $coordenadas[0] ?? $latitude;
                $longitude = $coordenadas[1] ?? $longitude;
            }
        }

        // Pasar los datos a la vista
        return view('minerva-la', compact('aulaData', 'imagenes', 'zonaRelacionada', 'latitude', 'longitude', 'videoUrl'));
    }

    public function showReferencia($id)
    {
        // Inicializar variables
        $referenciaData = null;
        $zonaRelacionada = null;
        $imagenes = [];
        $videoUrl = null; // Para almacenar el enlace del video
        $latitude = '13.4834';  // Coordenada predeterminada
        $longitude = '-88.1834';  // Coordenada predeterminada

        // Obtener los datos de la referencia
        $referenciaResponse = Http::get('https://ues-api-production.up.railway.app/referencias/' . $id);
        $zonasResponse = Http::get('https://ues-api-production.up.railway.app/zonas');
        $fotosReferenciaResponse = Http::get('https://ues-api-production.up.railway.app/fotos_referencias');
        $videoReferenciaResponse = Http::get('https://ues-api-production.up.railway.app/video_referencias'); // Pivote referencia-video
        $videosResponse = Http::get('https://ues-api-production.up.railway.app/videos'); // Lista de videos

        if ($referenciaResponse->successful() && !empty($referenciaResponse->json()['data'])) {
            $referenciaData = $referenciaResponse->json()['data']; // Datos de la referencia
            $zonaRelacionada = collect($zonasResponse->json()['data'])->firstWhere('id', $referenciaData['zona']); // Obtener la zona

            // Filtrar las fotos correspondientes a la referencia
            $imagenes = collect($fotosReferenciaResponse->json()['data'])
                ->where('referencia_id', $id)
                ->pluck('foto.url_foto')
                ->toArray();

            // Obtener el video_id correspondiente a la referencia desde el pivote
            $referenciaVideo = collect($videoReferenciaResponse->json()['data'])
                ->firstWhere('referencia_id', $id);

            if ($referenciaVideo) {
                // Si existe una relación referencia-video, obtener el video_id y buscar el video
                $videoId = $referenciaVideo['video_id'];
                $videoUrl = collect($videosResponse->json()['data'])
                    ->firstWhere('id', $videoId)['url'] ?? null;

                // Detectar si es un YouTube Short y convertir el enlace para embed
                if ($videoUrl) {
                    if (strpos($videoUrl, 'shorts') !== false) {
                        // Si es un Short, convertir el enlace para embed
                        $videoUrl = str_replace('youtube.com/shorts/', 'youtube.com/embed/', $videoUrl);
                    } else {
                        // Si es un vídeo regular, convertir el enlace al formato de embed
                        $videoUrl = str_replace('watch?v=', 'embed/', $videoUrl);
                    }
                }
            }

            // Extraer las coordenadas de la referencia
            if (isset($referenciaData['coordenadas'])) {
                $coordenadas = explode(',', $referenciaData['coordenadas']);
                $latitude = $coordenadas[0] ?? $latitude;
                $longitude = $coordenadas[1] ?? $longitude;
            }
        }

        // Pasar los datos a la vista
        return view('minerva-la', compact('referenciaData', 'imagenes', 'zonaRelacionada', 'latitude', 'longitude', 'videoUrl'));
    }
}