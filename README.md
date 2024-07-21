This project has 2 separate Laravel Folder. One is for User scenario and one for admin scenario.
To see the content, you will need:
1. Laragon
2. groq-php 0.0.4
3. groq-laravel 0.0.4

The following steps you need to do in order to run the system:
1. import kawalanggaran.sql to laragon's database.
2. move both KawalAnggaran and KawalAnggaranAdmin to www folder, which is inside laragon folder.
3. install groq-php 0.0.4 and groq-laravel 0.0.4 on the terminal.
4. run a separate terminal each for KawalAnggaran and KawalAnggaranAdmin
5. for each terminal, type the command: cd KawalAnggaran //(or in the other terminal, cd KawalAnggaranAdmin)
6. after that, one of them type: php artisan serve
7. the other: php artisan serve --port=8001
8. open localhost based on their port
