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
    USE_EMAIL VARCHAR(64) NOT NULL UNIQUE,                       -- Email of the user, must be unique
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
    USE_RANGO_USUARIO ENUM( 'BRONCE', 'PLATA', 'ORO', 'PLATINO', 'DIAMANTE') DEFAULT 'MADERA', -- User rank with default value 'MADERA'
    USE_PUNTOS_DE_REPUTACION INT DEFAULT 0                        -- Reputation points with default value 0
    USE_ACCESO_USUARIO_HABILITADO  boleano o (1 o 0)
);
