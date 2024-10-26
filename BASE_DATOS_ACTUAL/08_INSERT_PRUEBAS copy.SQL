Excelente.
ahora vamos a crear el sistema de respuestas.
lo primero:
un archivo php:
thread.php
un archivo php:
get_data_thread.php
get_data_thread.php obtendra todos los campos de ta tabla:

Textos completos
THD_ID
THD_EXTERNAL_ID
THD_INTERNAL_ID
THD_CREATOR_INTERNAL_ID
THD_CATEGORY_CODE
THD_SUBCATEGORY_CODE
THD_TITLE
THD_CONTENT
THD_RESOURCE_BASE_PATH
THD_IMAGE_1
THD_IMAGE_1_NAME
THD_IMAGE_2
THD_IMAGE_2_NAME
THD_IMAGE_3
THD_IMAGE_3_NAME
THD_IMAGE_4
THD_IMAGE_4_NAME
THD_IMAGE_5
THD_IMAGE_5_NAME
THD_IMAGE_6
THD_IMAGE_6_NAME
THD_IMAGE_7
THD_IMAGE_7_NAME
THD_VIDEO_URL_1
THD_VIDEO_URL_2
THD_VIDEO_URL_3
THD_CREATION_DATE
THD_LAST_UPDATE_DATE
THD_STATUS
THD_TYPE
THD_VISIBILITY
THD_IS_PINNED
THD_IS_EDITABLE
THD_IS_APPROVED
THD_APPROVER_INTERNAL_ID
THD_POLL_OPTION_1
THD_POLL_OPTION_2
THD_POLL_OPTION_3
THD_POLL_OPTION_4
THD_POLL_OPTION_5

con esta informacion, muestra todos los hilos en hilos.php
Muestralos como si fueran UN HILO DE UN FORO.

lleva toda la info a 
thread.php agrega un boton en el hilo:
"comentar" o "votar"
segun corresponda. depende del tipo de hilo
el boton es solo visual sin funcionalidad.