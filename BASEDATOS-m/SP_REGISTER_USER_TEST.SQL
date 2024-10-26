USE FORO_EMPRENDE;

-- Definir variables de entrada
SET @P_EMAIL = 'usuario@example.com';
SET @P_PASSWORD = 'password_segura';

-- Definir una variable de salida para el resultado del registro
SET @P_RESULT = 0;

-- Llamar al procedimiento almacenado para registrar al usuario
CALL SP_REGISTER_USER(@P_EMAIL, @P_PASSWORD, @P_RESULT);

-- Comprobar el resultado
SELECT @P_RESULT AS Resultado;
