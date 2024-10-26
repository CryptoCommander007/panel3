INICIAR PROCEDIMIENTO SP_REGISTER_USER(
    ENTRADA: P_USER_NAME,         -- Nombre de usuario ingresado por el usuario
    ENTRADA: P_EMAIL,             -- Correo electrónico ingresado por el usuario
    ENTRADA: P_PASSWORD,          -- Contraseña ingresada por el usuario (sin encriptar)
    ENTRADA: P_COUNTRY,           -- País de origen del usuario
    ENTRADA: P_IP_ADDRESS,        -- Dirección IP desde donde el usuario se está registrando
    ENTRADA: P_DEVICE_ID,         -- ID del dispositivo desde donde el usuario se está registrando
    SALIDA: P_RESULT              -- Resultado del registro: 1 (éxito) o 0 (fallo)
)
INICIAR
    -- Declarar variables locales
    DECLARAR V_COUNT COMO ENTERO INICIALIZADO EN 0        -- Variable para contar registros en la tabla de validación
    DECLARAR V_USER_INTERNAL_ID COMO CADENA               -- Almacenar el ID interno generado aleatoriamente
    DECLARAR V_USER_EXTERNAL_ID COMO CADENA               -- Almacenar el ID externo generado aleatoriamente
    DECLARAR BASE_USER_INTERNAL_ID COMO CADENA            -- Base fija para el ID interno
    DECLARAR BASE_USER_EXTERNAL_ID COMO CADENA            -- Base fija para el ID externo

    -- Inicializar bases para los IDs internos y externos
    ASIGNAR BASE_USER_INTERNAL_ID = '674O356GhHJLE0'
    ASIGNAR BASE_USER_EXTERNAL_ID = '74253FHJ6hH9FJ'

    -- PASO 1: Verificar si el nombre de usuario o el correo ya existen en la tabla USERS_VALIDATION
    SELECCIONAR el número de registros en USERS_VALIDATION
    DONDE USERNAME = P_USER_NAME O EMAIL = P_EMAIL
    ALMACENAR el resultado en V_COUNT

    -- Si ya existe el nombre de usuario o el correo, se establece que el registro ha fallado
    SI V_COUNT ES MAYOR QUE 0 ENTONCES
        ASIGNAR P_RESULT = 0         -- No se puede registrar, el usuario ya existe
        TERMINAR EL PROCEDIMIENTO    -- Salir del procedimiento
    FIN SI

    -- PASO 2: Generar IDs internos y externos únicos de manera aleatoria
    GENERAR V_USER_INTERNAL_ID concatenando:
        - BASE_USER_INTERNAL_ID
        - Un número aleatorio
        - La fecha y hora actual (formato: YYYYMMDDHHMMSS)
    
    GENERAR V_USER_EXTERNAL_ID concatenando:
        - BASE_USER_EXTERNAL_ID
        - Un número aleatorio
        - La fecha y hora actual (formato: YYYYMMDDHHMMSS)

    -- PASO 3: Registrar al usuario en la tabla USERS
    INSERTAR un nuevo registro en la tabla USERS con los siguientes valores:
        - V_USER_INTERNAL_ID    (ID interno generado aleatoriamente)
        - V_USER_EXTERNAL_ID    (ID externo generado aleatoriamente)
        - P_USER_NAME           (Nombre de usuario proporcionado)
        - P_EMAIL               (Correo electrónico proporcionado)
        - P_COUNTRY             (País proporcionado)
        - P_IP_ADDRESS          (Dirección IP proporcionada)
        - P_DEVICE_ID           (ID del dispositivo proporcionado)
        - UUID()                (Sal generada automáticamente para la contraseña)
        - SHA2(P_PASSWORD, 256) (Contraseña encriptada utilizando SHA-256)

    -- PASO 4: Registrar la validación del nombre de usuario y correo en USERS_VALIDATION
    INSERTAR un nuevo registro en la tabla USERS_VALIDATION con:
        - P_USER_NAME           (Nombre de usuario proporcionado)
        - P_EMAIL               (Correo electrónico proporcionado)
        - NULL (Teléfono, que no fue proporcionado)

    -- PASO 5: Establecer que el registro fue exitoso
    ASIGNAR P_RESULT = 1      -- Indica que el registro fue exitoso

FIN DEL PROCEDIMIENTO
