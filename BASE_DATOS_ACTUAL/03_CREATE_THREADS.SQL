USE FORO_EMPRENDE;

-- Drop the table if it already exists
DROP TABLE IF EXISTS THREADS;

CREATE TABLE THREADS (
    THD_ID INT AUTO_INCREMENT PRIMARY KEY,                          -- Unique thread ID
    THD_EXTERNAL_ID VARCHAR(64) NOT NULL,                           -- External ID for the thread
    THD_INTERNAL_ID VARCHAR(64) NOT NULL,                           -- Internal ID for the thread
    THD_CREATOR_INTERNAL_ID VARCHAR(64) NOT NULL,                   -- Internal ID of the thread creator

    -- Category and Subcategory fields
    THD_CATEGORY_CODE VARCHAR(64) NOT NULL,                         -- Code for the category
    THD_SUBCATEGORY_CODE VARCHAR(64) NOT NULL,                      -- Code for the subcategory
    
    -- Other fields for the thread
    THD_TITLE VARCHAR(255) NOT NULL,                                -- Title of the thread
    THD_CONTENT TEXT NOT NULL,                                      -- Content of the thread
    THD_RESOURCE_BASE_PATH VARCHAR(255),                            -- Base path for resources related to the thread

    -- Related images
    THD_IMAGE_1 BLOB,                                               -- First image related to the thread
    THD_IMAGE_1_NAME VARCHAR(64),                                   -- Name of the first image
    THD_IMAGE_2 BLOB,                                               -- Second image related to the thread
    THD_IMAGE_2_NAME VARCHAR(64),                                   -- Name of the second image
    THD_IMAGE_3 BLOB,                                               -- Third image related to the thread
    THD_IMAGE_3_NAME VARCHAR(64),                                   -- Name of the third image
    THD_IMAGE_4 BLOB,                                               -- Fourth image related to the thread
    THD_IMAGE_4_NAME VARCHAR(64),                                   -- Name of the fourth image
    THD_IMAGE_5 BLOB,                                               -- Fifth image related to the thread
    THD_IMAGE_5_NAME VARCHAR(64),                                   -- Name of the fifth image
    THD_IMAGE_6 BLOB,                                               -- Sixth image related to the thread
    THD_IMAGE_6_NAME VARCHAR(64),                                   -- Name of the sixth image
    THD_IMAGE_7 BLOB,                                               -- Seventh image related to the thread
    THD_IMAGE_7_NAME VARCHAR(64),                                   -- Name of the seventh image

    -- Related videos (YouTube URLs)
    THD_VIDEO_URL_1 VARCHAR(255),                                   -- First YouTube video URL
    THD_VIDEO_URL_2 VARCHAR(255),                                   -- Second YouTube video URL
    THD_VIDEO_URL_3 VARCHAR(255),                                   -- Third YouTube video URL

    -- Timestamps for creation and update
    THD_CREATION_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP,          -- Thread creation date
    THD_LAST_UPDATE_DATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Last update date

    -- Status and visibility fields
    THD_STATUS ENUM('ABIERTO', 'CERRADO', 'PERPETUO', 'ELIMINADO') DEFAULT 'ABIERTO',
    THD_DELETION_REASON VARCHAR(255) DEFAULT NULL,
    THD_TYPE ENUM('HILO_SIMPLE', 'HILO_VOTACION', 'ANUNCIO_OFREZCO_SERVICIOS', 
              'ANUNCIO_BUSCO_SERVICIOS', 'ANUNCIO_OFREZCO_PRODUCTO', 
              'ANUNCIO_BUSCO_PRODUCTO', 'ANUNCIO_PRODUCTO_MAYORISTAS_PARA_EMPRENDEDORES') 
    DEFAULT 'HILO_SIMPLE',
    THD_IMPORTANCE ENUM('ALTA', 'BAJA') DEFAULT 'BAJA',
    

    THD_VISIBILITY ENUM('VISIBLE', 'ARCHIVED') DEFAULT 'VISIBLE',   -- Visibility of the thread (visible or archived)
    THD_IS_PINNED ENUM('SI', 'NO') DEFAULT 'NO',                    -- Whether the thread is pinned ('SI' or 'NO')
    THD_IS_EDITABLE ENUM('SI', 'NO') DEFAULT 'SI',                  -- Whether the thread is editable ('SI' or 'NO')
    THD_IS_APPROVED ENUM('SI', 'NO') DEFAULT 'NO',                  -- Whether the thread is approved ('SI' or 'NO')
    THD_APPROVER_INTERNAL_ID VARCHAR(64),                           -- Internal ID of the approver



    THD_COUNTER_VIEWS INT DEFAULT 0,
    THD_COUNTER_LIKES INT DEFAULT 0 ,                           -- Thumbs up count (applies to profile)
    THD_COUNTER_LOVES INT DEFAULT 0 ,                          -- Love count (applies to profile)
    THD_COUNTER_HAHA INT DEFAULT 0 ,                           -- Haha count (applies to profile)
    THD_COUNTER_WOWS INT DEFAULT 0 ,                           -- Wow count (applies to profile)
    THD_COUNTER_SADS INT DEFAULT 0 ,                           -- Sad count (applies to profile)
    THD_COUNTER_ANGRY INT DEFAULT 0 ,                          -- Angry count (applies to profile)
    THD_COUNTER_CLOWNS INT DEFAULT 0 ,                         -- Clown count (applies to profile)

    -- Poll options (if thread is a poll)
    THD_POLL_OPTION_1 VARCHAR(64),                                  -- First poll option
    THD_POLL_OPTION_2 VARCHAR(64),                                  -- Second poll option
    THD_POLL_OPTION_3 VARCHAR(64),                                  -- Third poll option
    THD_POLL_OPTION_4 VARCHAR(64),                                  -- Fourth poll option
    THD_POLL_OPTION_5 VARCHAR(64),                                  -- Fifth poll option
    

    -- Foreign keys
    FOREIGN KEY (THD_CREATOR_INTERNAL_ID) REFERENCES USERS(USER_INTERNAL_ID),  -- Links to the internal ID of the thread creator
    FOREIGN KEY (THD_SUBCATEGORY_CODE) REFERENCES CATEGORIES(CAT_SUBCATEGORY_CODE) -- Links to the subcategory code
);
