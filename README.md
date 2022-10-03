# Szallas.hu Backend feladat

## Előfeltételek

- PHP 7.3
- MySQL 5.7
- Composer

## Telepítés

- Composer csomagok telepítése
```shell
composer install
```

- `.env` fájl létrehozása (az `.env.example` fájl alapján)
```shell
cp .env.example .env
```

- App kulcs generálás
```shell
php artisan key:generate
```

- `.env.testing` fájl létrehozása (tesztek futtatásához)
```shell
cp .env .env.testing
```

- Migrációk futtatása
```shell
php artisan migrate:fresh
```

- Adatok importálása CSV fájlból
```shell
# Ha a fájl a gyökérkönyvtáron kívül helyezkedik el, akkor a teljes elérési utat kell megadni
php artisan import:companies <path-to-csv>

# Windows-os környezetben idézőjelek közé kell tenni az elérési utat (a visszaperjel miatt)
php artisan import:companies "C:\path-to-csv\companies.csv"
```

- Tesztek futtatása
```shell
php artisan test
```

- Kiszolgáló indítása
```shell
php artisan serve
```
