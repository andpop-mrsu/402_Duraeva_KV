@echo off
chcp 65001>nul
where sqlite3>nul 2>nul
if %ERRORLEVEL% NEQ 0 ( echo Команда sqlite3 не найдена & pause & exit ) 
echo create table if not exists dbfortask01(User varchar(10), Date text default current_timestamp); | sqlite3 dbfortask01.db
echo insert into dbfortask01 values('%USERNAME%', datetime('now', 'localtime')); | sqlite3 dbfortask01.db

echo Имя программы: %~nx0
echo|<nul set /p="Количество запусков: "
echo select count(*) from dbfortask01; | sqlite3 dbfortask01.db
echo|<nul set /p="Первый запуск: "
echo select Date from dbfortask01 order by Date asc limit 1; | sqlite3 dbfortask01.db

echo.
echo select * from dbfortask01; | sqlite3 -table dbfortask01.db
echo. 

pause