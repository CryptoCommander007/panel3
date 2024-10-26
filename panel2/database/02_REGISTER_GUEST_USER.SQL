USE GUEST_SYSTEM;

-- Borra el SP si ya existe
DROP PROCEDURE IF EXISTS AUTHENTICATE_GUEST_USER;

-- Crea el SP para autenticar al usuario con variables de salida
DELIMITER $$

CREATE PROCEDURE AUTHENTICATE_GUEST_USER(
    IN p_USER_CODE VARCHAR(64),
    IN p_PASSWORD VARCHAR(64),
    OUT resultado INT,  -- Variable de salida para el resultado
    OUT codigo_externo VARCHAR(64)  -- Variable de salida para el código externo
)
BEGIN
    DECLARE v_SALT VARCHAR(64);
    DECLARE v_STORED_PASSWORD VARCHAR(64);
    DECLARE v_EXTERNAL_ID VARCHAR(64);

    -- Inicializar el valor de salida
    SET resultado = 0;
    SET codigo_externo = '';

    -- Recuperar la salt y la contraseña almacenada del usuario
    SELECT SALT, PASSWORD, EXTERNAL_ID INTO v_SALT, v_STORED_PASSWORD, v_EXTERNAL_ID
    FROM GUEST_USER
    WHERE USER_CODE = p_USER_CODE;

    -- Si no se encuentra el usuario, retornar 0
    IF v_SALT IS NULL THEN
        SET resultado = 0;
        SET codigo_externo = '';
    ELSE
        -- Hashear la contraseña ingresada con el salt
        SET p_PASSWORD = SHA2(CONCAT(p_PASSWORD, v_SALT), 256);

        -- Comparar la contraseña ingresada con la almacenada
        IF p_PASSWORD = v_STORED_PASSWORD THEN
            -- Autenticación exitosa
            SET resultado = 1;
            SET codigo_externo = v_EXTERNAL_ID;
        ELSE
            -- Contraseña incorrecta
            SET resultado = 0;
            SET codigo_externo = '';
        END IF;
    END IF;

END$$

DELIMITER ;
