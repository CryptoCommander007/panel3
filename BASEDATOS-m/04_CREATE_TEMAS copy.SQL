CREATE TABLE THREADS (
    THREAD_ID INT AUTO_INCREMENT PRIMARY KEY,                        -- Default ID for the thread
    THREAD_EXTERNAL_ID VARCHAR(64) NOT NULL,                         -- External ID for the thread
    THREAD_INTERNAL_ID VARCHAR(64) NOT NULL,                         -- Internal unique identifier
    THREAD_CREATOR_INTERNAL_ID VARCHAR(64) NOT NULL,                 -- Internal ID of the user who created the thread

    -- Category and Subcategory fields (text)
    THREAD_CATEGORY_NAME VARCHAR(255) NOT NULL,                      -- Main category name (text)
    THREAD_SUBCATEGORY_NAME VARCHAR(255),                            -- Subcategory name (text)

    -- Relational fields (linked by code)
    THREAD_CATEGORY_CODE VARCHAR(64),                                -- Category code (related to CATEGORIES table)
    THREAD_SUBCATEGORY_CODE VARCHAR(64),                             -- Subcategory code (related to CATEGORIES table)
    
    -- Other fields remain unchanged
    THREAD_TITLE VARCHAR(255) NOT NULL,                              -- Title of the thread
    THREAD_CONTENT VARCHAR(4096) NOT NULL,                           -- Content of the thread
    -- ... (other fields like images, videos, reactions, etc.)
    TOTAL_VIEWS_COUNT INT DEFAULT 0,                                  -- Total number of views
    THREAD_STATUS ENUM('OPEN', 'CLOSED', 'PERPETUAL') DEFAULT 'OPEN', -- Status of the thread
    THREAD_VISIBILITY ENUM('VISIBLE', 'ARCHIVED') DEFAULT 'VISIBLE',  -- Visibility of the thread
    -- (other fields continue as per previous definition)
    
    -- Adding foreign keys to link with categories
    FOREIGN KEY (THREAD_CATEGORY_CODE) REFERENCES CATEGORIES(CATEGORY_CODE),
    FOREIGN KEY (THREAD_SUBCATEGORY_CODE) REFERENCES CATEGORIES(SUBCATEGORY_CODE)
);
