bin\curl.exe -d "webFunction=download" -X POST http://localhost/demo/cve/tools/cveTool.php
bin\curl.exe -d "webFunction=update" -X POST http://localhost/demo/cve/tools/cveTool.php
echo %date% %time% >> curl.log