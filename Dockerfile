# Gunakan image resmi PHP dengan Apache bawaan
FROM php:8.2-apache

# Salin semua file project ke dalam container Apache
COPY . /var/www/html/

# Atur direktori kerja
WORKDIR /var/www/html/

# Aktifkan mod_rewrite (dibutuhkan untuk routing MVC kamu)
RUN a2enmod rewrite

# Pastikan permission file benar
RUN chmod -R 755 /var/www/html/

# Buka port 8080 untuk Railway
EXPOSE 8080

# Jalankan Apache di port 8080
CMD ["apache2-foreground"]