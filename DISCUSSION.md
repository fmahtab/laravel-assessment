#Section-1
After running php artisan serve, it is throwing 500,
Checked laravel.log and found 
[2026-11-11 14:05:32] production.ERROR: No application encryption key has been specified. {"exception":"[object] (Illuminate\\Encryption\\MissingAppKeyException(code: 0): No application encryption key has been specified. at C:/Users/fouzi/Desktop/Projects/laravel-assessment/vendor/laravel/framework/src/Illuminate/Encryption/EncryptionServiceProvider.php:83)
[stacktrace]

Running php artisan key:generate
The .env didn't exist, copying .env.example to a new file .env

#Section-2

1. Removed the hardcoded data and connected it with real database
 
2. Results page is throwing implode(): Argument #2 ($array) must be of type ?array, string given
The activities in the database is in string, casting it to array in the model. 

3. The API seems to working fine, 1 improvement I can make is adding pagination in case of the endpoint returning large no data.

Testint after the pagination: 
curl.exe -i -H "Accept: application/json" "http://laravel-assessment.test/api/destinations?page=u&page_size=104"ssment>
HTTP/1.1 422 Unprocessable Content
Server: nginx/1.25.2
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.5.12
Cache-Control: no-cache, private
Date: Wed, 11 Nov 2026 16:43:48 GMT
Access-Control-Allow-Origin: *

{"message":"The page size field must not be greater than 100.","errors":{"page_size":["The page size field must not be greater than 100."]}}

PR for Section-2: https://github.com/fmahtab/laravel-assessment/pull/1

#Section-3
1. The search feature is case-sensitive and also breaks when we enter a blank space before or after the string.
Replacing the str_contains with stripos and adding trim() for the search term.
2. The sorting order gets lost in the search result and after reset.
Created useSortingLogic() helper function to preserve the sorting order after the search and reset.
3. Display "No result found" when the search doesn't returns any result.
4. Display "Sorted By" under the search box.

