@echo off
:: Cambia el directorio al del proyecto
cd /d %~dp0

:: Verifica si la carpeta .git existe y la elimina
if exist ".git" (
    echo Eliminando la carpeta .git...
    rmdir /s /q .git
) else (
    echo La carpeta .git no existe.
)

:: Elimina el archivo .gitignore si existe
if exist ".gitignore" (
    echo Eliminando el archivo .gitignore...
    del /f /q .gitignore
) else (
    echo El archivo .gitignore no existe.
)

:: Elimina el archivo .gitattributes si existe
if exist ".gitattributes" (
    echo Eliminando el archivo .gitattributes...
    del /f /q .gitattributes
) else (
    echo El archivo .gitattributes no existe.
)

:: Confirmación de que la limpieza está completa
echo Configuración de Git eliminada. El proyecto está listo para ser inicializado desde cero.
pause
