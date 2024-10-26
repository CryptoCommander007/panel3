USE FORO_EMPRENDE;

-- Drop the table if it already exists
DROP TABLE IF EXISTS CATEGORIES;

CREATE TABLE CATEGORIES (
    CAT_ID INT AUTO_INCREMENT PRIMARY KEY,                           -- Unique ID for each category or subcategory
    CAT_CATEGORY_CODE VARCHAR(64) NOT NULL,                          -- Unique code for the category (hash)
    CAT_CATEGORY_NAME VARCHAR(255) NOT NULL,                         -- Name of the category (text)
    CAT_SUBCATEGORY_CODE VARCHAR(64) NOT NULL UNIQUE,                -- Unique code for the subcategory (hash)
    CAT_SUBCATEGORY_NAME VARCHAR(255),                               -- Name of the subcategory (text)
    CAT_SUBCATEGORY_DESCRIPTION VARCHAR(1024) DEFAULT NULL,           -- Description of the subcategory (text, optional)
    CAT_ICON_CLASS VARCHAR(255) DEFAULT NULL                         -- Icon class for the subcategory (e.g., "fas fa-users")
);

-- Insert the subcategories for the "FORO EMPRENDEDOR" category
INSERT INTO CATEGORIES (CAT_CATEGORY_CODE, CAT_CATEGORY_NAME, CAT_SUBCATEGORY_CODE, CAT_SUBCATEGORY_NAME, CAT_SUBCATEGORY_DESCRIPTION, CAT_ICON_CLASS)
VALUES 
    ('FORO_EMP', 'FORO EMPRENDEDOR', 'FORO_EMP_PRESENT', 'PRESENTATE', '¡Dinos quién eres y qué te trae a la comunidad!', 'fas fa-users'),
    ('FORO_EMP', 'FORO EMPRENDEDOR', 'FORO_EMP_CONSULTAS', 'CONSULTAS GENERALES EMPRENDEDORES', 'Haz tus preguntas sobre emprendimiento.', 'fas fa-question-circle'),
    ('FORO_EMP', 'FORO_EMP_EMPRENDEDOR', 'FORO_EMP_TEMAS_LEGALES', 'TEMAS LEGALES', 'Asesoría legal para emprendedores.', 'fas fa-balance-scale'),
    ('FORO_EMP', 'FORO EMPRENDEDOR', 'FORO_EMP_MARKETING', 'MARKETING-PUBLICIDAD-VENTAS', 'Promoción y ventas para tu negocio.', 'fas fa-bullhorn'),
    ('FORO_EMP', 'FORO EMPRENDEDOR', 'FORO_EMP_PRESENTA_IDEA', 'PRESENTA TU IDEA DE NEGOCIO', 'Comparte tu propuesta de negocio.', 'fas fa-lightbulb'),
    ('FORO_EMP', 'FORO EMPRENDEDOR', 'FORO_EMP_EXPERIENCIA', 'COMPARTE TU EXPERIENCIA COMO EMPRENDEDOR', 'Comparte tus aprendizajes y experiencias.', 'fas fa-briefcase'),
    ('FORO_EMP', 'FORO EMPRENDEDOR', 'FORO_EMP_DENUNCIAS', 'DENUNCIAS-REPORTES-FUNAS-ESTAFAS', 'Reporta conductas inapropiadas o estafas.', 'fas fa-exclamation-triangle'),
    ('FORO_EMP', 'FORO EMPRENDEDOR', 'FORO_EMP_PROPUESTAS', 'PROPUESTA DE IDEAS', 'Presenta ideas nuevas para discusión.', 'fas fa-lightbulb'),
    ('FORO_EMP', 'FORO EMPRENDEDOR', 'FORO_EMP_OTROS', 'OTROS', 'Otros temas relacionados con el emprendimiento.', 'fas fa-ellipsis-h');
