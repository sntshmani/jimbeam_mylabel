@echo off
setlocal
set TEST_NAME=HTML2PDFTest
set PATH=..\..\..\PDFNetC\Lib;%PATH%
php.exe %TEST_NAME%.php
endlocal
