USE FORO_EMPRENDE;

DELIMITER $$

-- Eliminar el procedimiento almacenado si ya existe
DROP PROCEDURE IF EXISTS SP_CREATE_THREAD $$

CREATE PROCEDURE SP_CREATE_THREAD (
    IN P_EXTERNAL_ID VARCHAR(64),       -- ID externo del usuario
    IN P_TITLE VARCHAR(255),            -- Título del hilo
    IN P_CONTENT TEXT,                  -- Contenido del hilo
    IN P_TYPE VARCHAR(10),              -- Tipo de hilo (HILO o ENCUESTA)
    IN P_CATEGORY_CODE VARCHAR(64),     -- Código de la categoría
    IN P_SUBCATEGORY_CODE VARCHAR(64),  -- Código de la subcategoría
    IN P_VIDEO_URL_1 VARCHAR(255),      -- URL del video 1 (puede ser NULL)
    IN P_VIDEO_URL_2 VARCHAR(255),      -- URL del video 2 (puede ser NULL)
    IN P_VIDEO_URL_3 VARCHAR(255),      -- URL del video 3 (puede ser NULL)
    IN P_IMAGE_1 BLOB,                  -- Imagen 1 (puede ser NULL)
    IN P_IMAGE_1_PATH VARCHAR(64),      -- Ruta de la imagen 1 (puede ser NULL)
    IN P_IMAGE_2 BLOB,                  -- Imagen 2 (puede ser NULL)
    IN P_IMAGE_2_PATH VARCHAR(64),      -- Ruta de la imagen 2 (puede ser NULL)
    IN P_IMAGE_3 BLOB,                  -- Imagen 3 (puede ser NULL)
    IN P_IMAGE_3_PATH VARCHAR(64),      -- Ruta de la imagen 3 (puede ser NULL)
    IN P_IMAGE_4 BLOB,                  -- Imagen 4 (puede ser NULL)
    IN P_IMAGE_4_PATH VARCHAR(64),      -- Ruta de la imagen 4 (puede ser NULL)
    IN P_IMAGE_5 BLOB,                  -- Imagen 5 (puede ser NULL)
    IN P_IMAGE_5_PATH VARCHAR(64),      -- Ruta de la imagen 5 (puede ser NULL)
    IN P_IMAGE_6 BLOB,                  -- Imagen 6 (puede ser NULL)
    IN P_IMAGE_6_PATH VARCHAR(64),      -- Ruta de la imagen 6 (puede ser NULL)
    IN P_IMAGE_7 BLOB,                  -- Imagen 7 (puede ser NULL)
    IN P_IMAGE_7_PATH VARCHAR(64),      -- Ruta de la imagen 7 (puede ser NULL),
    OUT P_RESULT INT                    -- Resultado de la operación (0 o 1)
)
BEGIN
    DECLARE V_INTERNAL_ID VARCHAR(64);
    DECLARE V_EXTERNAL_ID_THREADS VARCHAR(64);
    DECLARE V_INTERNAL_ID_THREADS VARCHAR(64);
    DECLARE V_RESOURCE_BASE_PATH VARCHAR(64);

    -- Obtener el ID interno usando SP_GLOBAL_GET_ID_INTERNAL_USER
    CALL SP_GLOBAL_GET_ID_INTERNAL_USER(P_EXTERNAL_ID, V_INTERNAL_ID);

    -- Si no se encuentra el ID interno, retornar fallo
    IF V_INTERNAL_ID = 0 THEN
        SET P_RESULT = 0;
        LEAVE PROCEDURE;
    END IF;

    -- Generar IDs únicos para el hilo
    SET V_EXTERNAL_ID_THREADS = SHA2(CONCAT('BASE_ID_EXTERNO', RAND(), NOW()), 256); -- ID externo del hilo
    SET V_INTERNAL_ID_THREADS = SHA2(CONCAT('BASE_ID_INTERNO', RAND(), NOW()), 256); -- ID interno del hilo

    -- Generar ruta base para recursos
    SET V_RESOURCE_BASE_PATH = SHA2(CONCAT(UUID(), NOW(), RAND()), 256); -- Ruta de recursos (hash)

    -- Iniciar la transacción
    START TRANSACTION;

    -- Insertar el hilo en la tabla THREADS
    INSERT INTO THREADS (
        THD_TITLE, THD_CONTENT, THD_TIP, THD_CATEGORY_CODE, THD_SUBCATEGORY_CODE, 
        THD_VIDEO_URL_1, THD_VIDEO_URL_2, THD_VIDEO_URL_3, 
        THD_IMAGE_1, THD_IMAGE_1_PATH, THD_IMAGE_2, THD_IMAGE_2_PATH, 
        THD_IMAGE_3, THD_IMAGE_3_PATH, THD_IMAGE_4, THD_IMAGE_4_PATH, 
        THD_IMAGE_5, THD_IMAGE_5_PATH, THD_IMAGE_6, THD_IMAGE_6_PATH, 
        THD_IMAGE_7, THD_IMAGE_7_PATH, THD_CREATOR_INTERNAL_ID, 
        THD_EXTERNAL_ID_THREADS, THD_INTERNAL_ID_THREADS, THD_RESOURCE_BASE_PATH
    )
    VALUES (
        P_TITLE, P_CONTENT, P_TYPE, P_CATEGORY_CODE, P_SUBCATEGORY_CODE, 
        P_VIDEO_URL_1, P_VIDEO_URL_2, P_VIDEO_URL_3, 
        P_IMAGE_1, P_IMAGE_1_PATH, P_IMAGE_2, P_IMAGE_2_PATH, 
        P_IMAGE_3, P_IMAGE_3_PATH, P_IMAGE_4, P_IMAGE_4_PATH, 
        P_IMAGE_5, P_IMAGE_5_PATH, P_IMAGE_6, P_IMAGE_6_PATH, 
        P_IMAGE_7, P_IMAGE_7_PATH, V_INTERNAL_ID, 
        V_EXTERNAL_ID_THREADS, V_INTERNAL_ID_THREADS, V_RESOURCE_BASE_PATH
    );

    -- Confirmar la transacción
    COMMIT;

    -- Retornar éxito
    SET P_RESULT = 1;
END $$

DELIMITER ;
