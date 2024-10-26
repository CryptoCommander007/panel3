-- Paso 1: Borrar la base de datos FORO_EMPRENDE si ya existe y luego crearla
DROP DATABASE IF EXISTS FORO_EMPRENDE;
CREATE DATABASE FORO_EMPRENDE;

-- Paso 2: Usar la nueva base de datos
USE FORO_EMPRENDE;


-- Paso 3: Crear la tabla USERS, incluyendo la creación del índice único para el teléfono dentro de la misma sentencia
CREATE TABLE USERS (
    USER_ID INT AUTO_INCREMENT PRIMARY KEY,                        -- Identificador único del usuario (clave primaria)
    USER_INTERNAL_ID VARCHAR(64) NOT NULL UNIQUE,                  -- ID interno único del usuario para el sistema
    USER_EXTERNAL_ID VARCHAR(64) NOT NULL UNIQUE,                  -- ID externo único del usuario, generalmente para integración con sistemas externos
    USER_FIRST_NAME VARCHAR(64),                                   -- Nombre del usuario
    USER_LAST_NAME VARCHAR(64),                                    -- Apellido del usuario
    USER_USERNAME VARCHAR(20) UNIQUE,                              -- Nombre de usuario único para login o identificación
    USER_EMAIL VARCHAR(64) NOT NULL UNIQUE,                        -- Correo electrónico único del usuario
    USER_PHONE VARCHAR(12) DEFAULT NULL,                           -- Teléfono del usuario, permite NULL pero debe ser único si se ingresa
    USER_NATIONAL_ID VARCHAR(12),                                  -- Número de identificación nacional del usuario (DNI, Cédula, etc.)
    USER_BIRTH_DATE DATE,                                          -- Fecha de nacimiento del usuario
    USER_GENDER ENUM('MASCULINO', 'FEMENINO', 'OTRO', 'NO_ESPECIFICADO') DEFAULT 'NO_ESPECIFICADO', -- Género del usuario
    USER_COUNTRY ENUM('MEXICO', 'ESPAÑA', 'ARGENTINA', 'CHILE', 'COLOMBIA', 
                      'PERÚ', 'VENEZUELA', 'URUGUAY', 'PARAGUAY', 'BRASIL', 
                      'BOLIVIA', 'ECUADOR', 'GUATEMALA', 'HONDURAS', 'EL_SALVADOR',
                      'COSTA_RICA', 'PANAMÁ', 'CUBA', 'REPÚBLICA_DOMINICANA', 'PUERTO_RICO', 
                      'EEUU', 'CANADÁ', 'REINO_UNIDO', 'OTRO') DEFAULT 'OTRO',  -- País de residencia del usuario
    USER_BIO VARCHAR(2048),                                        -- Breve biografía o descripción del usuario
    USER_PROFILE_IMAGE BLOB,                                       -- Imagen de perfil en formato binario
    USER_PROFILE_IMAGE_PATH VARCHAR(256),                          -- Ruta de la imagen de perfil si se almacena externamente
    USER_PASSWORD_SALT VARCHAR(64) NOT NULL,                       -- Sal utilizada para encriptar la contraseña
    USER_PASSWORD_HASH VARCHAR(64) NOT NULL,                       -- Contraseña encriptada del usuario
    USER_TWO_FACTOR_ENABLED ENUM('SI', 'NO') DEFAULT 'NO',         -- Si la autenticación de dos factores está habilitada
    USER_LAST_PASSWORD_CHANGE DATE,                                -- Fecha del último cambio de contraseña
    USER_PASSWORD_EXPIRY DATE,                                     -- Fecha de expiración de la contraseña
    USER_LAST_PASSWORD_RESET DATE,                                 -- Última vez que se restableció la contraseña
    USER_PASSWORD_CHANGE_REQUIRED ENUM('SI', 'NO') DEFAULT 'NO',   -- Indica si el usuario debe cambiar la contraseña en el próximo inicio de sesión
    
    -- Código de verificación y validación
    USER_VERIFICATION_CODE VARCHAR(6),                             -- Código de verificación enviado por correo
    USER_VERIFICATION_REQUIRED ENUM('SI', 'NO') DEFAULT 'NO',      -- Indica si el código de verificación debe ser validado
    
    -- Token de recuperación de contraseña
    USER_RECOVERY_TOKEN VARCHAR(128),                              -- Token para recuperación de contraseña
    USER_RECOVERY_EXPIRY DATETIME,                                 -- Fecha de expiración del token de recuperación
    USER_RECOVERY_USED ENUM('SI', 'NO') DEFAULT 'NO',              -- Indica si el token ya ha sido utilizado
    
    -- Estado y verificación del acceso
    USER_EMAIL_VERIFIED ENUM('SI', 'NO') DEFAULT 'NO',             -- Estado de verificación del correo electrónico
    USER_PHONE_VERIFIED ENUM('SI', 'NO') DEFAULT 'NO',             -- Estado de verificación del teléfono
    USER_VERIFICATION_STATUS ENUM('PENDIENTE', 'VERIFICADO', 'NO_VERIFICADO') DEFAULT 'NO_VERIFICADO', -- Estado de verificación general del usuario
    USER_ACCESS_ENABLED ENUM('SI', 'NO') DEFAULT 'SI',             -- Indica si el acceso al sistema está habilitado o deshabilitado
    USER_SYSTEM_STATUS ENUM('ACTIVO', 'INACTIVO', 'BLOQUEADO') DEFAULT 'ACTIVO', -- Estado del sistema para el usuario (ej. bloqueado)
    
    -- Intentos fallidos y seguridad
    USER_FAILED_LOGIN_ATTEMPTS INT DEFAULT 0,                      -- Número de intentos fallidos de inicio de sesión
    
    -- Tipo de cuenta: Demo o Productiva
    USER_ACCOUNT_MODE ENUM('DEMO', 'PRODUCTIVA') DEFAULT 'DEMO',   -- Diferencia si la cuenta es demo o productiva

    -- Tipo de cuenta y suscripción
    USER_ACCOUNT_TYPE ENUM('GRATIS', 'PREMIUM') DEFAULT 'GRATIS',  -- Tipo de cuenta del usuario (ej. gratuita o premium)
    USER_RANK ENUM('HIERRO', 'BRONCE', 'PLATA', 'ORO', 'PLATINO', 'DIAMANTE', 'MAESTRO') DEFAULT 'HIERRO', -- Rango del usuario en el sistema
    USER_REFERRAL_CODE VARCHAR(64),                                -- Código de referencia para usuarios recomendados
    USER_AFFILIATE_CODE VARCHAR(64),                               -- Código promocional afiliado al usuario
    USER_SALDO INT DEFAULT 0,

    
    -- Publicaciones y reputación
    USER_MAX_DAILY_THREADS INT DEFAULT 8,                          -- Maximum number of daily threads or posts allowed
    USER_REPUTATION_POINTS INT DEFAULT 0,                          -- User reputation points
    USER_FOLLOWERS_COUNT INT DEFAULT 0,                            -- Number of followers
    USER_THUMBS_UP_COUNT INT DEFAULT 0,                            -- Thumbs up count (applies to profile)
    USER_THUMBS_DOWN_COUNT INT DEFAULT 0 ,                          -- Thumbs down count (applies to profile)

    -- Información relacionada con acceso y dispositivos
    USER_LAST_IP_ADDRESS VARCHAR(64),                              -- Última dirección IP utilizada por el usuario
    USER_LAST_DEVICE_ID VARCHAR(64),                               -- Último dispositivo utilizado por el usuario
    USER_ONLINE_STATUS ENUM('SI', 'NO') DEFAULT 'NO',              -- Estado en línea del usuario
    USER_LAST_LOCATION_ACCESS VARCHAR(64),                         -- Última ubicación de acceso
    
    -- Preferencias y personalización
    USER_THEME ENUM('CLARO', 'OSCURO') DEFAULT 'CLARO',            -- Tema de preferencia del usuario
    USER_LANGUAGE VARCHAR(5) DEFAULT 'ES',                         -- Idioma preferido del usuario
    USER_TIMEZONE VARCHAR(64) DEFAULT 'America/Santiago',          -- Zona horaria del usuario
    USER_NOTIFICATIONS_ENABLED ENUM('SI', 'NO') DEFAULT 'SI',      -- Indica si las notificaciones están habilitadas
    
    -- Autenticación externa y exclusión de correos
    USER_SSO_PROVIDER ENUM('EMAIL', 'GOOGLE', 'FACEBOOK') DEFAULT 'EMAIL', -- Proveedor de autenticación externa
    USER_EMAIL_OPT_OUT DATE,                                       -- Fecha de exclusión voluntaria de correos

    -- Fechas importantes
    USER_CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,           -- Fecha de creación de la cuenta
    USER_LAST_LOGIN TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha y hora del último inicio de sesión
    USER_VERIFIED_AT TIMESTAMP NULL,                               -- Fecha de verificación del usuario

    -- Documentos e imágenes
    USER_PASSPORT_FRONT_IMAGE BLOB,                                -- Imagen frontal del pasaporte
    USER_PASSPORT_BACK_IMAGE BLOB,                                 -- Imagen trasera del pasaporte
    USER_ID_PHOTO BLOB,                                            -- Foto del usuario con su documento de identificación

    -- Datos bancarios
    USER_DOCUMENT_TYPE ENUM('PASAPORTE', 'CARNET', 'OTRO'),        -- Tipo de documento de identificación
    USER_BANK_NAME VARCHAR(64),                                    -- Nombre del banco
    USER_BANK_ACCOUNT_TYPE ENUM('AHORROS', 'CORRIENTE'),           -- Tipo de cuenta bancaria del usuario
    USER_BANK_ACCOUNT_NUMBER VARCHAR(64),                          -- Número de cuenta bancaria del usuario

    -- Rol del usuario
    USER_ROLE ENUM('USUARIO', 'MODERADOR') DEFAULT 'USUARIO',      -- Rol del usuario en el sistema
    
    -- Índice único para el teléfono
    UNIQUE (USER_PHONE)
);



-- Tabla de validación para nombres de usuario, correos electrónicos y teléfonos
CREATE TABLE USERS_VALIDATION (
    VALIDATION_ID INT AUTO_INCREMENT PRIMARY KEY,
    USERNAME VARCHAR(20) UNIQUE,            -- Nombres de usuario
    EMAIL VARCHAR(64) UNIQUE,               -- Correos electrónicos
    PHONE VARCHAR(12) UNIQUE                -- Teléfonos, con unicidad condicional
);

-- Disparador para insertar en USERS_VALIDATION cuando se inserta en USERS
DELIMITER //

CREATE TRIGGER TRG_AFTER_INSERT_USER
AFTER INSERT ON USERS
FOR EACH ROW
BEGIN
    INSERT INTO USERS_VALIDATION (USERNAME, EMAIL, PHONE)
    VALUES (NEW.USER_USERNAME, NEW.USER_EMAIL, NEW.USER_PHONE);
END //

-- Disparador para actualizar USERS_VALIDATION cuando se actualizan USER_USERNAME, USER_EMAIL o USER_PHONE
CREATE TRIGGER TRG_AFTER_UPDATE_USER
AFTER UPDATE ON USERS
FOR EACH ROW
BEGIN
    IF NEW.USER_USERNAME != OLD.USER_USERNAME OR NEW.USER_EMAIL != OLD.USER_EMAIL OR NEW.USER_PHONE != OLD.USER_PHONE THEN
        UPDATE USERS_VALIDATION 
        SET USERNAME = NEW.USER_USERNAME, EMAIL = NEW.USER_EMAIL, PHONE = NEW.USER_PHONE
        WHERE USERNAME = OLD.USER_USERNAME OR EMAIL = OLD.USER_EMAIL OR PHONE = OLD.USER_PHONE;
    END IF;
END //

DELIMITER ;
