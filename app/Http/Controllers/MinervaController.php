<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MinervaController extends Controller
{
    public function index()
    {
        // Consumir la API de zonas, referencias, aulas, fotos de aulas y fotos de referencias
        $zonasResponse = Http::get('https://ues-api-production.up.railway.app/zonas');
        $referenciasResponse = Http::get('https://ues-api-production.up.railway.app/referencias');
        $aulasResponse = Http::get('https://ues-api-production.up.railway.app/aulas');
        $fotosAulasResponse = Http::get('https://ues-api-production.up.railway.app/aula_fotos');
        $fotosReferenciasResponse = Http::get('https://ues-api-production.up.railway.app/fotos_referencias');

        $departments = [];

        // Verificar que todas las respuestas fueron exitosas
        if ($zonasResponse->successful() && $referenciasResponse->successful() && $aulasResponse->successful() && $fotosAulasResponse->successful() && $fotosReferenciasResponse->successful()) {
            $zonasData = $zonasResponse->json()['data']; // Zonas
            $referenciasData = $referenciasResponse->json()['data']; // Referencias
            $aulasData = $aulasResponse->json()['data']; // Aulas
            $fotosAulasData = $fotosAulasResponse->json()['data']; // Fotos de aulas
            $fotosReferenciasData = $fotosReferenciasResponse->json()['data']; // Fotos de referencias

            // Agrupar referencias y aulas por zona
            foreach ($zonasData as $zona) {
                $zonaId = $zona['id'];
                $zonaNombre = $zona['nombre'];
                $zonaCoordenadas = $zona['coordenadas']; // Extraer las coordenadas de la zona

                // Filtrar las referencias que coincidan con la zona actual
                $filteredReferencias = array_filter($referenciasData, function($ref) use ($zonaId) {
                    return $ref['zona'] == $zonaId;
                });

                // Añadir fotos a las referencias correspondientes
                foreach ($filteredReferencias as &$referencia) {
                    $referenciaId = $referencia['id'];
                    $referenciaFotos = array_filter($fotosReferenciasData, function($foto) use ($referenciaId) {
                        return $foto['referencia_id'] == $referenciaId;
                    });

                    // Extraer las URLs de las fotos
                    $referencia['fotos'] = [];
                    foreach ($referenciaFotos as $foto) {
                        $referencia['fotos'][] = $foto['foto']['url_foto'];
                    }
                }

                // Filtrar las aulas que coincidan con la zona actual
                $filteredAulas = array_filter($aulasData, function($aula) use ($zonaId) {
                    return $aula['zona'] == $zonaId;
                });

                // Añadir fotos a las aulas correspondientes
                foreach ($filteredAulas as &$aula) {
                    $aulaId = $aula['id'];
                    $aulaFotos = array_filter($fotosAulasData, function($foto) use ($aulaId) {
                        return $foto['aula_id'] == $aulaId;
                    });

                    // Extraer las URLs de las fotos
                    $aula['fotos'] = [];
                    foreach ($aulaFotos as $foto) {
                        $aula['fotos'][] = $foto['foto']['url_foto'];
                    }

                    // Cambiar 'numero' a 'nombre' y asignar coordenadas de la zona
                    $aula['nombre'] = $aula['numero']; 
                    $aula['coordenadas'] = $zonaCoordenadas;
                }

                // Combinar las referencias y aulas en un solo array
                $combinedData = array_merge($filteredReferencias, $filteredAulas);

                // Ordenar alfabéticamente por nombre
                usort($combinedData, function($a, $b) {
                    $nombreA = isset($a['nombre']) ? $a['nombre'] : '';
                    $nombreB = isset($b['nombre']) ? $b['nombre'] : '';
                    return strcmp($nombreA, $nombreB);
                });

                // Añadir las referencias y aulas agrupadas al departamento correspondiente
                $departments[$zonaNombre] = $combinedData;
            }
        }

        // Pasar los datos de $departments a la vista
        return view('minerva', compact('departments'));
    }
}
