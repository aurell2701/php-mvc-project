<<<<<<< HEAD
# php_modern_mvc
=======
# Proyek mvc_user

## Cara Pakai di Laragon

1. **Klik kanan icon Laragon → Menu → www → project-mvc**

2. **Atau buat Pretty URL:**
- - Klik kanan icon Laragon
- - Menu → Apache → sites-enabled
- - Buat file project-mvc.conf:

```bash
<VirtualHost *:80>
       DocumentRoot "C:/laragon/www/project-mvc/public"
       ServerName mvc.test
       ServerAlias *.mvc.test
       <Directory "C:/laragon/www/project-mvc/public">
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
```

3. **Restart Apache dari Laragon**

4. **Akses:**
```bash
   http://mvc.test
```
>>>>>>> 85ca1ce (init)
