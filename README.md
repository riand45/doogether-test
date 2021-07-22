# Doogether Test application
System Design code using repository pattern, and database using existing from Doogether

## Getting Started
```sh
composer install
```

```sh
add file .env copy from .env example
```

configuration
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=doogether
DB_USERNAME=root
DB_PASSWORD=
```

Generate secret key
This will update .env file with something like JWT_SECRET=foobar

```sh
php artisan jwt:secret
```

Run application
```sh
php artisan serve
```

### Example Request Response
#### Authentication at port 127.0.0.1:8000
- Register Request - {endpoint}/api/v1/auth/register
  > Sample Request Body
  > {
  >   "name": "Riand Pratama",
  >   "email": "riandpratamaputraaa@gmail.com",
  >   "password": "adminmaster",
  >   "password_confirmation": "adminmaster"
  > }
- Register Expected Response
  > {
  >  "message": "User successfully registered",
  >  "user": {
  >      "name": "Riand Pratama",
  >      "email": "riandpratamaputraaa@gmail.com",
  >      "updated": "2021-07-22T03:16:03.000000Z",
  >      "created": "2021-07-22T03:16:03.000000Z",
  >      "id": 4
  >  }
  > }
- Login Request {endpoint}/api/v1/auth/login
  > Sample Request Body
  > {
  >   "name": "Riand Pratama",
  >   "email": "riandpratamaputraaa@gmail.com",
  > }
- Login Expected Response
  > {
  >  "access_token":  "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9eyJpc3MiOiJodHRwOlwvXC9kb29nZXRoZXItdGVzdC50ZXN0XC9hcGlcL3YxXC9hdXRoXC9sb2dpbiIsImlhdCI6MTYyNjkyNTI0OCwiZXhwIjoxNjI2OTI4ODQ4LCJuYmYiOjE2MjY5MjUyNDgsImp0aSI6IldGY0prYThKenI3bGtJeTciLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.LlgzIWhAODmB9cDx6LcP0Cttjn7IG07SoduaQRgVrKE",
  >  "token_type": "bearer",
  >  "user": {
  >      "ID": 2
  >      "name": "Riand Pratama",
  >      "email": "riandpratamaputraaa@gmail.com",
  >      "updated": "2021-07-22T03:16:03.000000Z",
  >      "created": "2021-07-22T03:16:03.000000Z",
  >  }
  > }
- List Session GET {endpoint}/api/v1/session?search=&sortKey=id&sortValue=asc
  > Sample Request Params
  > {
  >   "search": "Riand",
  >   "sortKey": "id",
  >   "sortValue": "asc"
  > }
- Expected Response
  > {
  >   "current_page": 1,
  >   "data": [
  >      {
  >          "ID": 1,
  >          "UserID": 1,
  >          "name": "Zumba with Ahmad Sulaca",
  >          "description": "Zumba with Ahmad Sulaca is one of best Zumba in Depok",
  >          "start": "2020-12-31 13:00:00",
  >          "duration": 60,
  >          "created": "2020-11-17 13:52:10",
  >          "updated": "2020-11-17 13:52:10",
  >          "user_name": "Ahmad Sulaca Tes",
  >          "email": "ahmad.sulaca@mail.com"
  >      },
  >   ],
  >  "first_page_url": "{endpoint}/api/v1/session?page=1",
  >  "from": 1,
  >  "last_page": 1,
  >  "last_page_url": "{endpoint}/api/v1/session?page=1",
  >  "links": [
  >       {
  >          "url": null,
  >          "label": "&laquo; Previous",
  >          "active": false
  >      },
  >      {
  >          "url": "{endpoint}/api/v1/session?page=1",
  >          "label": "1",
  >          "active": true
  >      },
  >      {
  >          "url": null,
  >          "label": "Next &raquo;",
  >          "active": false
  >      }
  >  ],
  >  "next_page_url": null,
  >  "path": "{endpoint}/api/v1/session",
  >  "per_page": 15,
  >  "prev_page_url": null,
  >  "to": 4,
  >  "total": 4
  > }

- > Show Session GET {endpoint}/api/v1/session/1
- > Create Session POST {endpoint}/api/v1/session
- > Update Session PATCH {endpoint}/api/v1/session/1
- > Delete Session DELETE {endpoint}/api/v1/session/1

## Feature
- Authentication, and CRUD Session
- Using JWT