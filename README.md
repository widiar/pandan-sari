## Cara Install

- [Intall Git](https://git-scm.com/downloads)
- [Install Composer](https://getcomposer.org/download/)
- Clone ini menggunakan perintah **git clone https://github.com/widiar/pandan-sari.git**
- Setelah di clone, gunakan **composer install**
- Install **[wkhtml](https://wkhtmltopdf.org/downloads.html)** set installasinya di folder "C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe"
- Buat database bernama **pandan-sari**
- Copy file .env.example menjadi .env
- Isikan di file .env MAIL_USERNAME dan MAIL_CONTACT itu email yang akan digunakan
- Isikan di file .env MAIL_PASSWORD itu password dari email
- Buka cmd atau git bash, ketikkan **php artisan key:generate**
- Buka cmd atau git bash, ketikkan **php artisan migrate --seed**

## Cara run
- Buka cmd atau git bash, ketikkan **php artisan serve**
