@echo off
:: Cambia el directorio al del proyecto
cd /d %~dp0

:: Actualiza el repositorio desde GitHub
echo Actualizando el repositorio...
git pull origin main

:: Agrega los cambios
echo Agregando cambios...
git add .

:: Crea un commit con mensaje personalizado
echo Ingrese el mensaje del commit:
set /p commitMessage=
git commit -m "%commitMessage%"

:: Envía los cambios al repositorio
echo Enviando los cambios al repositorio...
git push origin main

echo Actualización completada.
pause
