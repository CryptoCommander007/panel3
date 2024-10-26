USE FORO_EMPRENDE;

-- Drop the table if it already exists
DROP TABLE IF EXISTS ANSWER_REACTIONS;

-- Table to store reactions to answers
CREATE TABLE ANSWER_REACTIONS (
    REACTION_ID INT AUTO_INCREMENT PRIMARY KEY,                -- Unique ID for each reaction
    REACTOR_USER_ID VARCHAR(64) NOT NULL,                      -- ID of the user who reacted
    ANSWER_ID INT NOT NULL,                                    -- ID of the answer (foreign key to THREAD_ANSWERS)
    REACTION_TYPE ENUM('ME_GUSTA', 'ME_ENCANTA', 'ME_RIÓ', 'ME_ASOMBRA', 'ME_ENTRISTECE', 'ME_ENFADA', 'PAYASO') NOT NULL,
    REACTION_STATUS ENUM('REACCIONADO', 'DESECHO') DEFAULT 'REACCIONADO', -- Status of the reaction (reacted or undone)
    REACTION_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP,         -- Timestamp of the reaction
    
    -- Foreign keys
    FOREIGN KEY (REACTOR_USER_ID) REFERENCES USERS(USER_INTERNAL_ID), -- User who gave the reaction
    FOREIGN KEY (ANSWER_ID) REFERENCES THREAD_ANSWERS(ANS_THD_ID)     -- The answer being reacted to
);

-- Index to ensure a user can only react once to an answer at a time
CREATE UNIQUE INDEX idx_user_answer_reaction
ON ANSWER_REACTIONS (REACTOR_USER_ID, ANSWER_ID);
