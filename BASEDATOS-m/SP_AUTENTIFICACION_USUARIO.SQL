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
