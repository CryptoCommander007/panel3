USE FORO_EMPRENDE;

-- Drop the table if it already exists
DROP TABLE IF EXISTS USERS;

-- Create the USERS table
CREATE TABLE USERS (
    USE_ID INT AUTO_INCREMENT PRIMARY KEY,                        -- Default ID for the user
    USE_INTERNAL_ID VARCHAR(64) NOT NULL UNIQUE,                  -- Unique internal ID (used as foreign key in THREADS)
    USE_EXTERNAL_ID VARCHAR(64) NOT NULL,                         -- External ID (used in APIs or external systems)
    USE_FIRST_NAME VARCHAR(64) NOT NULL,                          -- First name of the user
    USE_LAST_NAME VARCHAR(64) NOT NULL,                           -- Last name of the user
    USE_RUT VARCHAR(12) NOT NULL,                                 -- National ID (RUT or equivalent)
    USE_EMAIL VARCHAR(128) NOT NULL UNIQUE,                       -- Email of the user, must be unique
    USE_PHONE VARCHAR(12),                                        -- Phone number of the user
    USE_USERNAME VARCHAR(20) UNIQUE,                              -- Unique username for the forum
    USE_USER_TYPE ENUM('USUARIO', 'MODERADOR') NOT NULL DEFAULT 'USUARIO', -- User type
    USE_GENDER ENUM('HOMBRE', 'MUJER', 'OTRO', 'NO ESPECIFICADO') DEFAULT 'NO ESPECIFICADO', -- Gender
    USE_BIRTH_DATE DATE,                                          -- Birth date
    USE_SYSTEM_STATUS ENUM('ACTIVE', 'INACTIVE', 'BLOCKED') DEFAULT 'ACTIVE', -- System status of the user
    USE_VERIFICATION_STATUS ENUM('PENDING', 'VERIFIED', 'NOT_VERIFIED') DEFAULT 'NOT_VERIFIED', -- Verification status
    USE_PASSWORD_SALT VARCHAR(64) NOT NULL,                       -- Salt for password hashing
    USE_PASSWORD_HASH VARCHAR(64) NOT NULL,                       -- Hashed password
    USE_PROFILE_IMAGE BLOB,                                       -- Profile image in binary format
    USE_PROFILE_IMAGE_PATH VARCHAR(256),                          -- Path to profile image if stored in file system
    USE_BIO VARCHAR(2048),                                        -- Biography of the user, using VARCHAR(2048)
    USE_NATIONALITY ENUM('MEXICO', 'SPAIN', 'ARGENTINA', 'CHILE', 'COLOMBIA', 
                        'PERU', 'VENEZUELA', 'URUGUAY', 'PARAGUAY', 'BRAZIL', 
                        'USA', 'CANADA', 'UK', 'OTHER') NOT NULL, -- Nationality
    USE_CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,           -- Account creation date
    USE_LAST_LOGIN TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Last login
    USE_FAILED_LOGIN_ATTEMPTS INT DEFAULT 0,                      -- Failed login attempts
    USE_VERIFICATION_TOKEN VARCHAR(128),                          -- Token for email verification
    USE_VERIFIED_AT TIMESTAMP NULL,                               -- Date of verification
    USE_PASSPORT_FRONT_IMAGE BLOB,                                -- Front image of the passport
    USE_PASSPORT_BACK_IMAGE BLOB,                                 -- Back image of the passport
    USE_ID_PHOTO BLOB,                                            -- Photo of the user with ID
    USE_RANGO_USUARIO ENUM( 'BRONCE', 'PLATA', 'ORO', 'PLATINO', 'DIAMANTE') DEFAULT 'BRONCE', -- User rank with default value 'MADERA'
    USE_PUNTOS_DE_REPUTACION INT DEFAULT 0                        -- Reputation points with default value 0
);


USE FORO_EMPRENDE;

-- Drop the table if it already exists
DROP TABLE IF EXISTS CATEGORIES;

CREATE TABLE CATEGORIES (
    CAT_ID INT AUTO_INCREMENT PRIMARY KEY,                           -- Unique ID for each category or subcategory
    CAT_CATEGORY_CODE VARCHAR(64) NOT NULL,                          -- Unique code for the category (hash)
    CAT_CATEGORY_NAME VARCHAR(255) NOT NULL,                         -- Name of the category (text)
    CAT_SUBCATEGORY_CODE VARCHAR(64) NOT NULL UNIQUE,                -- Unique code for the subcategory (hash)
    CAT_SUBCATEGORY_NAME VARCHAR(255)                                -- Name of the subcategory (text)
);










USE FORO_EMPRENDE;

-- Drop the table if it already exists
DROP TABLE IF EXISTS THREADS;

CREATE TABLE THREADS (
    THD_ID INT AUTO_INCREMENT PRIMARY KEY,                          
    THD_EXTERNAL_ID_THREADS VARCHAR(64) NOT NULL,                   
    THD_INTERNAL_ID_THREADS VARCHAR(64) NOT NULL,                   
    THD_CREATOR_INTERNAL_ID VARCHAR(64) NOT NULL,                   

    -- Category and Subcategory fields
    THD_CATEGORY_CODE VARCHAR(64) NOT NULL,                        
    THD_SUBCATEGORY_CODE VARCHAR(64) NOT NULL,                     
    
    -- Other fields for the thread
    THD_TITLE VARCHAR(255) NOT NULL,                                
    THD_CONTENT TEXT NOT NULL,                                      
    THD_RESOURCE_BASE_PATH VARCHAR(255),                            

    -- Related images
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

    -- Related videos (YouTube URLs)
    THD_VIDEO_URL_1 VARCHAR(255),                                   
    THD_VIDEO_URL_2 VARCHAR(255),                                   
    THD_VIDEO_URL_3 VARCHAR(255),                                   

    THD_CREATION_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP,          
    THD_LAST_UPDATE_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    THD_STATUS ENUM('OPEN', 'CLOSED', 'PERPETUAL') DEFAULT 'OPEN',  
    THD_TIP ENUM('HILO', 'ENCUESTA') DEFAULT 'HILO',                
    THD_VISIBILITY ENUM('VISIBLE', 'ARCHIVADO') DEFAULT 'VISIBLE',   
    THD_IS_PINNED TINYINT(1) DEFAULT 0,                             
    THD_IS_EDITABLE TINYINT(1) DEFAULT 1,                           
    THD_IS_APPROVED TINYINT(1) DEFAULT 0,                           
    THD_APPROVER_INTERNAL_ID VARCHAR(64),                           
    
    FOREIGN KEY (THD_CREATOR_INTERNAL_ID) REFERENCES USERS(USE_INTERNAL_ID),   
    FOREIGN KEY (THD_SUBCATEGORY_CODE) REFERENCES CATEGORIES(CAT_SUBCATEGORY_CODE)
);



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


USE FORO_EMPRENDE;

-- Drop the procedure if it already exists
DROP PROCEDURE IF EXISTS SP_AUTHENTICATE_USER;

-- Create the stored procedure for user authentication
DELIMITER $$

CREATE PROCEDURE SP_AUTHENTICATE_USER (
    IN P_EMAIL VARCHAR(128),
    IN P_PASSWORD VARCHAR(64),
    OUT P_RESULT INT, -- 1 if authentication is successful, 0 if not
    OUT P_EXTERNAL_ID VARCHAR(64) -- External ID if successful, empty if not
)
BEGIN
    DECLARE V_PASSWORD_SALT VARCHAR(64);
    DECLARE V_PASSWORD_HASH VARCHAR(64);
    DECLARE V_EXTERNAL_ID VARCHAR(64);

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SET P_RESULT = 0;
        SET P_EXTERNAL_ID = '';
    END;

    -- Retrieve the SALT and hashed password of the user with the provided email
    SELECT USE_PASSWORD_SALT, USE_PASSWORD_HASH, USE_EXTERNAL_ID INTO V_PASSWORD_SALT, V_PASSWORD_HASH, V_EXTERNAL_ID
    FROM USERS
    WHERE USE_EMAIL = P_EMAIL;

    -- If the user was not found
    IF V_PASSWORD_SALT IS NULL THEN
        SET P_RESULT = 0;
        SET P_EXTERNAL_ID = '';
    ELSE
        -- Generate the hash of the input password using the retrieved salt
        IF SHA2(CONCAT(P_PASSWORD, V_PASSWORD_SALT), 256) = V_PASSWORD_HASH THEN
            -- If the passwords match, return 1 and the external ID
            SET P_RESULT = 1;
            SET P_EXTERNAL_ID = V_EXTERNAL_ID;
        ELSE
            -- If they don't match, return 0 and an empty external ID
            SET P_RESULT = 0;
            SET P_EXTERNAL_ID = '';
        END IF;
    END IF;
END $$

DELIMITER ;


USE FORO_EMPRENDE;
DELIMITER $$

-- DELETE THE PROCEDURE IF IT ALREADY EXISTS
DROP PROCEDURE IF EXISTS SP_GLOBAL_GET_ID_INTERNAL_USER $$

-- CREATE THE PROCEDURE
CREATE PROCEDURE SP_GLOBAL_GET_ID_INTERNAL_USER (
    IN P_EXTERNAL_ID VARCHAR(64), -- PARAMETER FOR THE EXTERNAL ID
    OUT P_INTERNAL_ID VARCHAR(64) -- OUTPUT PARAMETER FOR THE INTERNAL ID
)
BEGIN
    -- INITIALIZE THE INTERNAL ID TO 0 IN CASE THE USER IS NOT FOUND
    SET P_INTERNAL_ID = 0;

    -- SEARCH FOR THE USER WITH THE GIVEN EXTERNAL ID
    SELECT USE_INTERNAL_ID 
    INTO P_INTERNAL_ID
    FROM USERS
    WHERE USE_EXTERNAL_ID = P_EXTERNAL_ID
    LIMIT 1;

    -- IF NO USER IS FOUND, THE INTERNAL ID WILL REMAIN AS 0
    IF P_INTERNAL_ID IS NULL THEN
        SET P_INTERNAL_ID = 0;
    END IF;
END $$

DELIMITER ;



USE FORO_EMPRENDE;

-- DELETE THE PROCEDURE IF IT ALREADY EXISTS
DROP PROCEDURE IF EXISTS SP_REGISTER_USER;

-- CREATE THE STORED PROCEDURE TO REGISTER A USER WITH JUST EMAIL AND PASSWORD
DELIMITER $$

CREATE PROCEDURE SP_REGISTER_USER (
    IN P_EMAIL VARCHAR(128),
    IN P_PASSWORD VARCHAR(64),
    OUT P_RESULT INT -- 1 IF REGISTRATION IS SUCCESSFUL, 0 IF IT FAILS
)
BEGIN
    DECLARE V_INTERNAL_ID VARCHAR(64);
    DECLARE V_EXTERNAL_ID VARCHAR(64);
    DECLARE V_USERNAME VARCHAR(20);
    DECLARE V_PASSWORD_SALT VARCHAR(64);
    DECLARE V_PASSWORD_HASH VARCHAR(64);

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SET P_RESULT = 0;
        ROLLBACK; -- ROLLBACK THE TRANSACTION IN CASE OF ERROR
    END;

    -- VALIDATE IF THE EMAIL IS ALREADY REGISTERED
    IF (SELECT COUNT(*) FROM USERS WHERE USE_EMAIL = P_EMAIL) > 0 THEN
        SET P_RESULT = 0; -- EMAIL ALREADY REGISTERED, RETURN 0
    ELSE
        -- GENERATE INTERNAL AND EXTERNAL IDs
        SET V_INTERNAL_ID = SHA2(CONCAT(UUID(), NOW(), RAND()), 256); -- INTERNAL HASH
        SET V_EXTERNAL_ID = SHA2(CONCAT(UUID(), NOW(), RAND()), 256); -- EXTERNAL HASH

        -- GENERATE USERNAME: USE0 + HASH OF 16 CHARACTERS
        SET V_USERNAME = CONCAT('USE0', LEFT(SHA2(CONCAT(UUID(), RAND()), 256), 16));

        -- GENERATE SALT FOR THE PASSWORD
        SET V_PASSWORD_SALT = SHA2(CONCAT(UUID(), NOW(), RAND()), 256);

        -- GENERATE THE HASHED PASSWORD WITH SALT
        SET V_PASSWORD_HASH = SHA2(CONCAT(P_PASSWORD, V_PASSWORD_SALT), 256);

        -- START THE TRANSACTION
        START TRANSACTION;

        -- INSERT THE USER INTO THE DATABASE
        INSERT INTO USERS (
            USE_INTERNAL_ID, USE_EXTERNAL_ID, USE_EMAIL, USE_USERNAME,
            USE_PASSWORD_SALT, USE_PASSWORD_HASH
        ) VALUES (
            V_INTERNAL_ID, V_EXTERNAL_ID, P_EMAIL, V_USERNAME,
            V_PASSWORD_SALT, V_PASSWORD_HASH
        );

        COMMIT; -- COMMIT THE TRANSACTION

        -- RETURN SUCCESS
        SET P_RESULT = 1;
    END IF;
END $$

DELIMITER ;



USE FORO_EMPRENDE;

-- Definir variables de entrada
SET @P_EMAIL = 'usuario@example.com';
SET @P_PASSWORD = 'password_segura';

-- Definir una variable de salida para el resultado del registro
SET @P_RESULT = 0;

-- Llamar al procedimiento almacenado para registrar al usuario
CALL SP_REGISTER_USER(@P_EMAIL, @P_PASSWORD, @P_RESULT);

-- Comprobar el resultado
SELECT @P_RESULT AS Resultado;


-- Insertar categoría "EMPRESAS CHILE" y las subcategorías asociadas
INSERT INTO CATEGORIES (CAT_CATEGORY_CODE, CAT_CATEGORY_NAME, CAT_SUBCATEGORY_CODE, CAT_SUBCATEGORY_NAME)
VALUES 
(SHA2('EMPRESAS CHILE', 256), 'EMPRESAS CHILE', SHA2('CREACION-GESTION-MANTENCION EMPRESA', 256), 'CREACION-GESTION-MANTENCION EMPRESA'),
(SHA2('EMPRESAS CHILE', 256), 'EMPRESAS CHILE', SHA2('NORMATIVA CHILENA', 256), 'NORMATIVA CHILENA'),
(SHA2('EMPRESAS CHILE', 256), 'EMPRESAS CHILE', SHA2('GUIA DEL EMPRENDEDOR', 256), 'GUIA DEL EMPRENDEDOR');
