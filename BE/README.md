<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Setting Up projet
Step 1--> Create a Database with the name of salesdock
Step 2--> run php artisan serve inside project folder to run Backend
Step 3--> run migrations (php artisan migrate) and seeders (php artisan db:seed
) 
API and details
1--> API for admin Login
url : http://127.0.0.1:8000/api/login-user
Request:
Body :
{"username":"admin", "password" : "Test1234!"}
Rsponse:
{ "status": true, "message": null, "details": { "user": { "id": 2, "username": "admin", "name": "admin", "email": "admin@gmail.com", "email_verified_at": null, "created_at": null, "updated_at": null, "avatar": null }, "token": "92|tKu36h8WWjKBMWpYJGnadS3mX5sli0ypSxKMkLUD" } }

2--> inject customer contact info 

Authorization : Bearer token getting from Login API
Url : http://127.0.0.1:8000/api/inject-customer
Method : POST
Request :
{
  "customer_id": "2"
}

Response :
{"status":true,"message":"Customer data injected into contacts table","details":[]}


3--> inject lead contact info 

Authorization : Bearer token getting from Login API
Url : http://127.0.0.1:8000/api/inject-lead
Method : POST
Request :
{
  "lead_id": "3"
}

Response :
{
    "status": true,
    "message": "Lead data injected into contacts table",
    "details": []
}

Run UNIT TEST 
php artisan test app/tests/Unit/InjectionServiceTest.php

