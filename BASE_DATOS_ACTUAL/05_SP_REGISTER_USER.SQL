USE FORO_EMPRENDE;

-- Drop the procedure if it already exists
DROP PROCEDURE IF EXISTS SP_AUTHENTICATE_USER;

-- Create the stored procedure for user authentication
DELIMITER $$

CREATE PROCEDURE SP_AUTHENTICATE_USER (
    IN P_EMAIL_OR_USERNAME VARCHAR(128),  -- Email or Username for login
    IN P_PASSWORD VARCHAR(64),            -- Input password in plain text
    OUT P_RESULT INT,                     -- 1 if authentication is successful, 0 if not
    OUT P_EXTERNAL_ID VARCHAR(64)         -- External ID if successful, empty if not
)
BEGIN
    DECLARE V_PASSWORD_SALT VARCHAR(64);
    DECLARE V_PASSWORD_HASH VARCHAR(64);
    DECLARE V_CALCULATED_HASH VARCHAR(64);
    DECLARE V_EXTERNAL_ID VARCHAR(64);
    DECLARE USER_COUNT INT;

    -- Handler for SQL exceptions
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SET P_RESULT = 0;
        SET P_EXTERNAL_ID = '';
    END;

    -- Check if the user exists (by email or username)
    SELECT COUNT(*) INTO USER_COUNT
    FROM USERS
    WHERE USER_EMAIL = P_EMAIL_OR_USERNAME OR USER_USERNAME = P_EMAIL_OR_USERNAME;

    -- If no user was found, return 0
    IF USER_COUNT = 0 THEN
        SET P_RESULT = 0;
        SET P_EXTERNAL_ID = '';
    ELSE
        -- Retrieve the SALT, hashed password, and external ID of the user
        SELECT USER_PASSWORD_SALT, USER_PASSWORD_HASH, USER_EXTERNAL_ID
        INTO V_PASSWORD_SALT, V_PASSWORD_HASH, V_EXTERNAL_ID
        FROM USERS
        WHERE USER_EMAIL = P_EMAIL_OR_USERNAME OR USER_USERNAME = P_EMAIL_OR_USERNAME;

        -- Generate the hash of the input password using the retrieved salt
        SET V_CALCULATED_HASH = SHA2(CONCAT(V_PASSWORD_SALT, P_PASSWORD), 256);

        -- Compare the calculated hash with the stored hash
        IF V_CALCULATED_HASH = V_PASSWORD_HASH THEN
            -- If the password matches, return success and the external ID
            SET P_RESULT = 1;
            SET P_EXTERNAL_ID = V_EXTERNAL_ID;
        ELSE
            -- If the password doesn't match, return failure
            SET P_RESULT = 0;
            SET P_EXTERNAL_ID = '';
        END IF;
    END IF;

END $$

DELIMITER ;
