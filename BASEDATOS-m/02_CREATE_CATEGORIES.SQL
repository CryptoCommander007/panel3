USE FORO_EMPRENDE;

-- Drop the table if it already exists
DROP TABLE IF EXISTS CATEGORIES;

CREATE TABLE CATEGORIES (
    CAT_ID INT AUTO_INCREMENT PRIMARY KEY,                           -- Unique ID for each category or subcategory
    CAT_CATEGORY_CODE VARCHAR(64) NOT NULL,                          -- Unique code for the category (hash)
    CAT_CATEGORY_NAME VARCHAR(255) NOT NULL,                         -- Name of the category (text)
    CAT_SUBCATEGORY_CODE VARCHAR(64) NOT NULL UNIQUE,                -- Unique code for the subcategory (hash)
    CAT_SUBCATEGORY_NAME VARCHAR(255)                                -- Name of the subcategory (text)
);
