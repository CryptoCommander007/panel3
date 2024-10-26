USE GUEST_SYSTEM;

-- Borra el SP si ya existe
DROP PROCEDURE IF EXISTS AUTHENTICATE_GUEST_USER;

-- Crea el SP para autenticar al usuario con validación de contraseña
DELIMITER $$

CREATE PROCEDURE AUTHENTICATE_GUEST_USER(
    IN p_USER_CODE VARCHAR(64),  -- Nombre de usuario
    IN p_PASSWORD VARCHAR(64),   -- Contraseña ingresada
    OUT resultado INT,           -- Resultado de la autenticación (1 o 0)
    OUT codigo_externo VARCHAR(64)  -- Código externo del usuario si es exitoso
)
BEGIN
    DECLARE v_SALT VARCHAR(64);               -- Para almacenar el salt del usuario
    DECLARE v_STORED_PASSWORD VARCHAR(64);    -- Para almacenar la contraseña hasheada en la BD
    DECLARE v_EXTERNAL_ID VARCHAR(64);        -- Para almacenar el EXTERNAL_ID del usuario

    -- Inicializar las variables de salida
    SET resultado = 0;
    SET codigo_externo = '';

    -- Recuperar la salt, la contraseña almacenada y el external_id del usuario
    SELECT SALT, PASSWORD, EXTERNAL_ID INTO v_SALT, v_STORED_PASSWORD, v_EXTERNAL_ID
    FROM GUEST_USER
    WHERE USER_CODE = p_USER_CODE;

    -- Si el usuario no existe, no hay salt
    IF v_SALT IS NULL THEN
        -- Retornar 0 y vacío si el usuario no existe
        SET resultado = 0;
        SET codigo_externo = '';
    ELSE
        -- Hashear la contraseña ingresada con el salt recuperado
        SET p_PASSWORD = SHA2(CONCAT(p_PASSWORD, v_SALT), 256);

        -- Comparar la contraseña ingresada hasheada con la contraseña almacenada
        IF p_PASSWORD = v_STORED_PASSWORD THEN
            -- Si la contraseña es correcta, retornar 1 y el EXTERNAL_ID
            SET resultado = 1;
            SET codigo_externo = v_EXTERNAL_ID;
        ELSE
            -- Si la contraseña es incorrecta, retornar 0 y vacío
            SET resultado = 0;
            SET codigo_externo = '';
        END IF;
    END IF;
END$$

DELIMITER ;
