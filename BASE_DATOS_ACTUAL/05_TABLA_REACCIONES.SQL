USE FORO_EMPRENDE;

-- Drop table if it already exists for thread reactions
DROP TABLE IF EXISTS THREAD_REACTIONS;

-- Table to store reactions to threads
CREATE TABLE THREAD_REACTIONS (
    REACTION_ID INT AUTO_INCREMENT PRIMARY KEY,                -- Unique ID for each reaction
    REACTOR_USER_ID VARCHAR(64) NOT NULL,                      -- ID of the user who reacted
    THREAD_ID INT NOT NULL,                                    -- ID of the thread (foreign key to THREADS)
    REACTION_TYPE ENUM('LIKE', 'LOVE', 'HAHA', 'WOW', 'SAD', 'ANGRY', 'CLOWN') NOT NULL, -- Type of reaction
    REACTION_STATUS ENUM('REACCIONADO', 'DESECHO') DEFAULT 'REACCIONADO', -- Status of the reaction
    REACTION_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP,         -- Timestamp of the reaction
    
    -- Foreign keys
    FOREIGN KEY (REACTOR_USER_ID) REFERENCES USERS(USER_INTERNAL_ID), -- User who gave the reaction
    FOREIGN KEY (THREAD_ID) REFERENCES THREADS(THD_ID)                -- ID of the thread being reacted to
);

-- Drop table if it already exists for answer reactions
DROP TABLE IF EXISTS ANSWER_REACTIONS;

-- Table to store reactions to answers
CREATE TABLE ANSWER_REACTIONS (
    REACTION_ID INT AUTO_INCREMENT PRIMARY KEY,                -- Unique ID for each reaction
    REACTOR_USER_ID VARCHAR(64) NOT NULL,                      -- ID of the user who reacted
    ANSWER_ID INT NOT NULL,                                    -- ID of the answer (foreign key to ANSWER_THREADS)
    REACTION_TYPE ENUM('LIKE', 'LOVE', 'HAHA', 'WOW', 'SAD', 'ANGRY', 'CLOWN') NOT NULL, -- Type of reaction
    REACTION_STATUS ENUM('REACCIONADO', 'DESECHO') DEFAULT 'REACCIONADO', -- Status of the reaction
    REACTION_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP,         -- Timestamp of the reaction
    
    -- Foreign keys
    FOREIGN KEY (REACTOR_USER_ID) REFERENCES USERS(USER_INTERNAL_ID), -- User who gave the reaction
    FOREIGN KEY (ANSWER_ID) REFERENCES ANSWER_THREADS(ANS_THD_ID)     -- ID of the answer being reacted to
);

-- Indexes to ensure a user can only have one reaction per thread or answer at a time
CREATE UNIQUE INDEX idx_user_thread_reaction
ON THREAD_REACTIONS (REACTOR_USER_ID, THREAD_ID);

CREATE UNIQUE INDEX idx_user_answer_reaction
ON ANSWER_REACTIONS (REACTOR_USER_ID, ANSWER_ID);
