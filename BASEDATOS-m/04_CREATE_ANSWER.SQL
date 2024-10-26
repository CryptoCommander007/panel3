USE FORO_EMPRENDE;

-- Drop the table if it already exists
DROP TABLE IF EXISTS ANSWER_THREADS;

CREATE TABLE ANSWER_THREADS (
    ANS_ID INT AUTO_INCREMENT PRIMARY KEY,                          -- Default ID for the answer
    ANS_EXTERNAL_ID_ANSWER VARCHAR(64) NOT NULL,                    -- External ID for the answer
    ANS_INTERNAL_ID_ANSWER VARCHAR(64) NOT NULL,                    -- Internal unique identifier
    ANS_USER_RESPONDER_ID VARCHAR(64) NOT NULL,                     -- ID of the user who is responding (the one who posts the answer)
    ANS_THREAD_ID INT NOT NULL,                                     -- ID of the thread this answer belongs to (foreign key to THREADS)
    
    -- Field to indicate if the answer is directed to the thread creator or another user
    ANS_USER_REPLIED_TO_ID VARCHAR(64),                             -- ID of the user being replied to (thread creator or another user)

    -- Answer content and related media
    ANS_CONTENT VARCHAR(4096) NOT NULL,                             -- Content of the answer

    -- Related images (limited to 7)
    ANS_IMAGE_1 BLOB,
    ANS_IMAGE_1_PATH VARCHAR(64),
    ANS_IMAGE_2 BLOB,
    ANS_IMAGE_2_PATH VARCHAR(64),
    ANS_IMAGE_3 BLOB,
    ANS_IMAGE_3_PATH VARCHAR(64),
    ANS_IMAGE_4 BLOB,
    ANS_IMAGE_4_PATH VARCHAR(64),
    ANS_IMAGE_5 BLOB,
    ANS_IMAGE_5_PATH VARCHAR(64),
    ANS_IMAGE_6 BLOB,
    ANS_IMAGE_6_PATH VARCHAR(64),
    ANS_IMAGE_7 BLOB,
    ANS_IMAGE_7_PATH VARCHAR(64),

    -- Related videos (YouTube URLs, limited to 3)
    ANS_VIDEO_URL_1 VARCHAR(255),                                   -- YouTube video URL 1
    ANS_VIDEO_URL_2 VARCHAR(255),                                   -- YouTube video URL 2
    ANS_VIDEO_URL_3 VARCHAR(255),                                   -- YouTube video URL 3

    ANS_CREATION_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP,           -- Creation date of the answer
    ANS_LAST_UPDATE_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Last update date

    -- Reactions to the answer
    ANS_TOTAL_THUMBS_UP_REACTIONS INT DEFAULT 0,                     -- Total thumbs up reactions
    ANS_TOTAL_THUMBS_DOWN_REACTIONS INT DEFAULT 0,                   -- Total thumbs down reactions
    ANS_TOTAL_FUNNY_REACTIONS INT DEFAULT 0,                         -- Total funny reactions
    ANS_TOTAL_CLOWN_REACTIONS INT DEFAULT 0,                         -- Total clown reactions

    -- Status and visibility fields for the answer
    ANS_IS_EDITABLE TINYINT(1) DEFAULT 1,                            -- Editable status (1 = editable, 0 = not editable)
    ANS_IS_VISIBLE TINYINT(1) DEFAULT 1,                             -- Visibility status (1 = visible, 0 = hidden due to violations or moderation)

    -- Poll-related field (only applies if the answer is to a poll)
    ANS_POLL_OPTION_SELECTED ENUM('THD_POLL_OPTION1', 'THD_POLL_OPTION2', 'THD_POLL_OPTION3', 'THD_POLL_OPTION4', 'THD_POLL_OPTION5'), -- Selected poll option (if applicable)

    -- Foreign keys
    FOREIGN KEY (ANS_USER_RESPONDER_ID) REFERENCES USERS(USE_INTERNAL_ID),  -- Links to the user who posted the answer
    FOREIGN KEY (ANS_USER_REPLIED_TO_ID) REFERENCES USERS(USE_INTERNAL_ID), -- Links to the user being replied to
    FOREIGN KEY (ANS_THREAD_ID) REFERENCES THREADS(THD_ID)                  -- Links the answer to its thread
);
