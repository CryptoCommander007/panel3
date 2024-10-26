USE FORO_EMPRENDE;

-- Drop tables if they already exist
DROP TABLE IF EXISTS CONVERSATION_MESSAGES;
DROP TABLE IF EXISTS USER_CONVERSATIONS;
DROP TABLE IF EXISTS USER_MESSAGES;

-- Table to store user conversations (private and group)
CREATE TABLE USER_CONVERSATIONS (
    CONV_ID INT AUTO_INCREMENT PRIMARY KEY,                   -- Unique ID for each conversation
    CONV_CREATOR_ID VARCHAR(64) NOT NULL,                     -- ID of the user who created the conversation (foreign key to USERS)
    CONV_PARTICIPANT_IDS JSON NOT NULL,                       -- IDs of the users in the conversation (JSON array for multiple participants)
    IS_PRIVATE ENUM('SI', 'NO') DEFAULT 'NO',                 -- Whether the conversation is between two users
    IS_GROUP ENUM('SI', 'NO') DEFAULT 'NO',                   -- Whether the conversation is a group conversation
    CONV_CREATED_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP,    -- Timestamp when the conversation was created
    CONV_LAST_UPDATED TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Last update (new message)

    -- Foreign key
    FOREIGN KEY (CONV_CREATOR_ID) REFERENCES USERS(USER_INTERNAL_ID)  -- Links to the creator of the conversation
);

-- Table to store messages within conversations
CREATE TABLE CONVERSATION_MESSAGES (
    MSG_ID INT AUTO_INCREMENT PRIMARY KEY,                   -- Unique ID for each message
    CONV_ID INT NOT NULL,                                    -- ID of the conversation (foreign key to USER_CONVERSATIONS)
    MSG_SENDER_ID VARCHAR(64) NOT NULL,                      -- ID of the user sending the message (foreign key to USERS)
    MSG_CONTENT TEXT NOT NULL,                               -- Message content
    MSG_IMAGE_1 BLOB,                                        -- First image
    MSG_IMAGE_1_NAME VARCHAR(64),                            -- Name of the first image
    MSG_IMAGE_2 BLOB,                                        -- Second image
    MSG_IMAGE_2_NAME VARCHAR(64),                            -- Name of the second image
    MSG_IMAGE_3 BLOB,                                        -- Third image
    MSG_IMAGE_3_NAME VARCHAR(64),                            -- Name of the third image
    MSG_SENT_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP,       -- Timestamp when the message was sent
    MSG_IS_READ ENUM('SI', 'NO') DEFAULT 'NO',               -- Whether the message has been read

    -- Foreign keys
    FOREIGN KEY (CONV_ID) REFERENCES USER_CONVERSATIONS(CONV_ID),    -- Links to the conversation
    FOREIGN KEY (MSG_SENDER_ID) REFERENCES USERS(USER_INTERNAL_ID)   -- Links to the sender of the message
);

-- Index to ensure a user can only react once to an answer at a time
CREATE UNIQUE INDEX idx_user_answer_reaction
ON CONVERSATION_MESSAGES (MSG_SENDER_ID, CONV_ID);
