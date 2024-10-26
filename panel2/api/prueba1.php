<?php

// URL de la solicitud, incluyendo los parámetros de liga y bookmaker
$url = "https://api-football-v1.p.rapidapi.com/v2/odds/league/865927/bookmaker/5?page=2";

// Inicializar la sesión de cURL
$curl = curl_init();

// Configurar las opciones de cURL
curl_setopt_array($curl, [
    CURLOPT_URL => $url,                 // URL de la solicitud
    CURLOPT_RETURNTRANSFER => true,      // Devuelve el resultado como string
    CURLOPT_FOLLOWLOCATION => true,      // Permitir redirecciones
    CURLOPT_HTTPHEADER => [              // Encabezados HTTP
        "x-rapidapi-host: api-football-v1.p.rapidapi.com",  // Host de la API
        "x-rapidapi-key: aa43904298mshb9b2ce3279ejns5b78cdd1a9"  // Tu clave de RapidAPI
    ],
]);

// Ejecutar la solicitud cURL
$response = curl_exec($curl);

// Verificar si hubo errores en la solicitud
if (curl_errno($curl)) {
    echo 'Error en la solicitud: ' . curl_error($curl);
}

// Cerrar la sesión de cURL
curl_close($curl);

// Decodificar la respuesta JSON de la API
$data = json_decode($response, true);

// Ver los datos devueltos por la API
echo '<pre>';
print_r($data);
echo '</pre>';

?>
