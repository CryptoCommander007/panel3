USE FORO_EMPRENDE;

-- Drop the table if it already exists
DROP TABLE IF EXISTS ANSWER;

CREATE TABLE ANSWER (
    ANS_ID INT AUTO_INCREMENT PRIMARY KEY,                          -- Default ID for the thread
    ANS_EXTERNAL_ID_ANSWER VARCHAR(64) NOT NULL,                           -- External ID for the thread
    ANS_INTERNAL_ID_ANSWER VARCHAR(64) NOT NULL,                           -- Internal unique identifier
    ANS_THD_CREATOR_INTERNAL_ID VARCHAR(64) NOT NULL, --- ID DEL USUARIO DE LA RESPUESTA( EL QUE RESPONDE)
    --- ALGUN CAMPO QUE INDIQUE SI LA RESPUESTA ES AL HILO PRINCIPAL O A OTRO USUARIO
    --- ANS_THD_USUARIO_RESPONDIDO_ID EN CASO DE QUE SEA UNA RESPUESTA ES AL HILO, SERA EL USUARIO CREADOR
    -- DEL HILO, EN OTRO CASO, SE ASIGNARA EL USUARIO AL QUE SE LE RESPONDE
    ANS_THD_USUARIO_RESPONDIDO_ID(ADAPTA NOMBRE A AINGLES, DALE UN NOMBRE MAS REPRESENTATIVO)
    -- Other fields for the thread
    THD_CONTENT VARCHAR(4096) NOT NULL,                             -- Content of the thread

    -- Related images (limited to 7)
    THD_IMAGE_1 BLOB,
    THD_IMAGE_1_PATH VARCHAR(64),
    THD_IMAGE_2 BLOB,
    THD_IMAGE_2_PATH VARCHAR(64),
    THD_IMAGE_3 BLOB,
    THD_IMAGE_3_PATH VARCHAR(64),
    THD_IMAGE_4 BLOB,
    THD_IMAGE_4_PATH VARCHAR(64),
    THD_IMAGE_5 BLOB,
    THD_IMAGE_5_PATH VARCHAR(64),
    THD_IMAGE_6 BLOB,
    THD_IMAGE_6_PATH VARCHAR(64),
    THD_IMAGE_7 BLOB,
    THD_IMAGE_7_PATH VARCHAR(64),

    -- Related videos (YouTube URLs, limited to 3)
    THD_VIDEO_URL_1 VARCHAR(255), -- YouTube video URL 1
    THD_VIDEO_URL_2 VARCHAR(255), -- YouTube video URL 2
    THD_VIDEO_URL_3 VARCHAR(255), -- YouTube video URL 3

    THD_CREATION_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP,           -- Creation date of the thread
    THD_LAST_UPDATE_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Last update date
    THD_TOTAL_THUMBS_UP_REACTIONS INT DEFAULT 0,                     -- Total thumbs up reactions
    THD_TOTAL_THUMBS_DOWN_REACTIONS INT DEFAULT 0,                   -- Total thumbs down reactions
    THD_TOTAL_FUNNY_REACTIONS INT DEFAULT 0,                         -- Total funny reactions
    THD_TOTAL_CLOWN_REACTIONS INT DEFAULT 0,                         -- Total clown reactions

    -- Thread status, visibility, and approval fields
    THD_IS_EDITABLE TINYINT(1) DEFAULT 1,                            -- Editable status (1 = editable, 0 = not editable)
    THD_HAS_POLL TINYINT(1) DEFAULT 0,                               -- If the thread contains a poll (1 = yes, 0 = no)
    -- ALGUN CAMPO PARA SABER SI LA RESPUESTA ESTA HABILIDATA PARA SER VISTA O NO, DEPENDE DE :
    -- POR EJEMPO, PUEDE NO ESTAR VISIBLE POR INCUMPLIR NORMAS

    AQUI VAMOS A PONER 
    -- Poll options (only if the thread has a poll)
    THD_POLL_OPTION SELECCIONADA
    -- SOLO APLICA SI ES LA RESPUESA A UNA ENCUESTA
    SLO PUEDE SER:THD_POLL_OPTION1,THD_POLL_OPTION2... HASTA EL 5


    -- Foreign keys to link with USERS and CATEGORIES tables
);
