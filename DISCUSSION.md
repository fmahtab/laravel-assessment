#Section1
After running php artisan serve, it is throwing 500,
Checked laravel.log and found 
[2026-11-11 14:05:32] production.ERROR: No application encryption key has been specified. {"exception":"[object] (Illuminate\\Encryption\\MissingAppKeyException(code: 0): No application encryption key has been specified. at C:/Users/fouzi/Desktop/Projects/laravel-assessment/vendor/laravel/framework/src/Illuminate/Encryption/EncryptionServiceProvider.php:83)
[stacktrace]

Running php artisan key:generate
The .env didn't exist, copying .env.example to a new file .env


