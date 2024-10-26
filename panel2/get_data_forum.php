<?php
require 'config_db.php'; // Conexión a la base de datos

// Función para obtener las categorías del foro junto con la cantidad de temas, respuestas, y el último tema/usuario
function get_forum_categories() {
    $connection = connectDB();

    // Consulta SQL actualizada para obtener cantidad de temas, respuestas, el último tema y el usuario
    $query = "
        SELECT 
            CAT.CAT_ICON_CLASS, 
            CAT.CAT_SUBCATEGORY_NAME, 
            CAT.CAT_SUBCATEGORY_DESCRIPTION, 
            CAT.CAT_SUBCATEGORY_CODE,
            COUNT(DISTINCT THD.THD_ID) AS total_temas, 
            COUNT(DISTINCT ANS.ANS_THD_ID) AS total_respuestas,
            -- Obtener el último tema no eliminado
            (
                SELECT THD.THD_TITLE
                FROM THREADS THD
                WHERE THD.THD_SUBCATEGORY_CODE = CAT.CAT_SUBCATEGORY_CODE
                AND THD.THD_STATUS != 'ELIMINADO'
                ORDER BY THD.THD_CREATION_DATE DESC
                LIMIT 1
            ) AS ultimo_tema,
            -- Obtener el nombre del usuario que publicó el último tema
            (
                SELECT CONCAT(U.USER_FIRST_NAME, ' ', U.USER_LAST_NAME)
                FROM THREADS THD
                INNER JOIN USERS U ON THD.THD_CREATOR_INTERNAL_ID = U.USER_INTERNAL_ID
                WHERE THD.THD_SUBCATEGORY_CODE = CAT.CAT_SUBCATEGORY_CODE
                AND THD.THD_STATUS != 'ELIMINADO'
                ORDER BY THD.THD_CREATION_DATE DESC
                LIMIT 1
            ) AS ultimo_usuario
        FROM CATEGORIES CAT
        LEFT JOIN THREADS THD 
            ON CAT.CAT_SUBCATEGORY_CODE = THD.THD_SUBCATEGORY_CODE 
            AND THD.THD_STATUS != 'ELIMINADO'
        LEFT JOIN THREAD_ANSWERS ANS 
            ON THD.THD_ID = ANS.ANS_THD_THREAD_ID 
            AND ANS.ANS_THD_STATUS != 'ELIMINADO'
        GROUP BY CAT.CAT_SUBCATEGORY_CODE
    ";

    $result = $connection->query($query);
    $categories = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }

    $connection->close();
    return $categories;
}
?>
