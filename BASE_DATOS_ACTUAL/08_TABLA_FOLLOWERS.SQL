USE FORO_EMPRENDE;

-- Eliminar la tabla de seguidores si ya existe
DROP TABLE IF EXISTS USER_FOLLOWERS;

-- Crear la tabla de seguidores
CREATE TABLE USER_FOLLOWERS (
    FOLLOW_ID INT AUTO_INCREMENT PRIMARY KEY,                   -- Identificador único del seguimiento
    FOLLOWER_USER_ID VARCHAR(64) NOT NULL,                      -- ID del usuario que sigue (foreign key to USERS)
    FOLLOWED_USER_ID VARCHAR(64) NOT NULL,                      -- ID del usuario seguido (foreign key to USERS)
    FOLLOW_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP,            -- Fecha en la que comenzó a seguir
    IS_ACTIVE ENUM('SI', 'NO') DEFAULT 'SI',                    -- Estado del seguimiento (activo o no)
    
    -- Foreign keys
    FOREIGN KEY (FOLLOWER_USER_ID) REFERENCES USERS(USER_INTERNAL_ID),  -- Usuario que sigue
    FOREIGN KEY (FOLLOWED_USER_ID) REFERENCES USERS(USER_INTERNAL_ID),  -- Usuario seguido

    -- Evitar que un usuario siga a otro más de una vez
    UNIQUE (FOLLOWER_USER_ID, FOLLOWED_USER_ID)
);

-- Trigger para incrementar el contador de seguidores después de seguir a un usuario
DELIMITER //

CREATE TRIGGER TRG_AFTER_FOLLOW_USER
AFTER INSERT ON USER_FOLLOWERS
FOR EACH ROW
BEGIN
    -- Incrementar el contador de seguidores del usuario seguido
    UPDATE USERS
    SET USER_FOLLOWERS_COUNT = USER_FOLLOWERS_COUNT + 1
    WHERE USER_INTERNAL_ID = NEW.FOLLOWED_USER_ID;
END //

DELIMITER ;

-- Trigger para decrementar el contador de seguidores después de dejar de seguir a un usuario
DELIMITER //

CREATE TRIGGER TRG_AFTER_UNFOLLOW_USER
AFTER UPDATE ON USER_FOLLOWERS
FOR EACH ROW
BEGIN
    -- Decrementar el contador de seguidores cuando el estado del seguimiento cambia a 'NO'
    IF NEW.IS_ACTIVE = 'NO' THEN
        UPDATE USERS
        SET USER_FOLLOWERS_COUNT = USER_FOLLOWERS_COUNT - 1
        WHERE USER_INTERNAL_ID = OLD.FOLLOWED_USER_ID;
    END IF;
END //

DELIMITER ;
