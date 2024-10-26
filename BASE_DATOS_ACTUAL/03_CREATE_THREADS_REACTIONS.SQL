USE FORO_EMPRENDE;

-- Drop the table if it already exists
DROP TABLE IF EXISTS THREAD_REACTIONS;

-- Table to store reactions to threads
CREATE TABLE THREAD_REACTIONS (
    REACTION_ID INT AUTO_INCREMENT PRIMARY KEY,                -- Unique ID for each reaction
    REACTOR_USER_ID VARCHAR(64) NOT NULL,                      -- ID of the user who reacted
    THREAD_ID INT NOT NULL,                                    -- ID of the thread (foreign key to THREADS)
    REACTION_TYPE ENUM('ME_GUSTA', 'ME_ENCANTA', 'ME_RIÓ', 'ME_ASOMBRA', 'ME_ENTRISTECE', 'ME_ENFADA', 'PAYASO') NOT NULL,
    REACTION_STATUS ENUM('REACCIONADO', 'DESECHO') DEFAULT 'REACCIONADO', -- Status of the reaction (reacted or undone)
    REACTION_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP,         -- Timestamp of the reaction
    
    -- Foreign keys
    FOREIGN KEY (REACTOR_USER_ID) REFERENCES USERS(USER_INTERNAL_ID), -- User who gave the reaction
    FOREIGN KEY (THREAD_ID) REFERENCES THREADS(THD_ID)                -- Thread being reacted to
);

-- Index to ensure a user can only react once to a thread at a time
CREATE UNIQUE INDEX idx_user_thread_reaction
ON THREAD_REACTIONS (REACTOR_USER_ID, THREAD_ID);
