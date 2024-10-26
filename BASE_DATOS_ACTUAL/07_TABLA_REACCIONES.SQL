USE FORO_EMPRENDE;

-- Drop tables if they already exist
DROP TABLE IF EXISTS USER_NOTIFICATIONS;

CREATE TABLE USER_NOTIFICATIONS (
    NOTIF_ID INT AUTO_INCREMENT PRIMARY KEY,                   -- Unique ID for each notification
    USER_ID VARCHAR(64) NOT NULL,                              -- ID of the user receiving the notification (foreign key to USERS)
    NOTIF_TYPE ENUM('MESSAGE', 'REACTION', 'MENTION', 'INVITATION', 'RESPONSE', 'CITATION', 'OTHER') NOT NULL, -- Type of the notification
    NOTIF_REACTION_TYPE ENUM('LIKE', 'LOVE', 'HAHA', 'WOW', 'SAD', 'ANGRY', 'CLOWN') DEFAULT NULL, -- Reaction type, if applicable
    NOTIF_CONTENT VARCHAR(255),                                -- Short description of the notification
    EVENT_LINK VARCHAR(255),                                   -- Link to the event (message, thread, reaction, etc.)
    IS_READ ENUM('SI', 'NO') DEFAULT 'NO',                     -- Whether the notification has been read
    IS_IMPORTANT ENUM('SI', 'NO') DEFAULT 'NO',                -- If the notification is marked as important
    CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,            -- Timestamp when the notification was created
    
    -- Foreign key linking to the user receiving the notification
    FOREIGN KEY (USER_ID) REFERENCES USERS(USER_INTERNAL_ID)
);
