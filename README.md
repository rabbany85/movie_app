# Searchlight Security Backend Test

This project is created for Searchlight Security as a part of the recruitment process. The system deals with User and Movie models and allows CRUD operation. 

## Installation

The test project was written in PHP Laravel. You would require Laravel dev enviornment to run the application. Once you have the local dev env, create a database and update the .env file and run the following commands.

```bash

pip artisan migrate:fresh --seed
php artisan passport:install

```

## API end-points

```php


post /login
post /signup

get /users
get /user/{ID}
post /user_new
post /user_edit/{ID}
delete /user_delete/{ID}

get /movies
get /movie/{ID}
post /movie_new
post /movie_edit/{ID}
delete /movie_delete/{ID}





```


## User post example
```
http://127.0.0.1:8000/api/user_new


 {
    "title" : "Mr",
    "first_name" : "Abu",
    "last_name" : "Bakkar",
    "email" : "rabbany85@gmail.com",
    "password" : "tesT321",
    "phone" : "07480476097"
  }


```

## User editable fields
```
http://127.0.0.1:8000/api/user_edit


 {
    "title" : "Mr",
    "first_name" : "Abu",
    "last_name" : "Bakkar",
    "phone" : "07480476097"
  }


```



## Movie post example
```
http://127.0.0.1:8000/api/movie_new

{
 "title" : "XYZ123",
 "description" : "This is a test",
 "release_date" : "2020/02/18",
 "movie_file" : "mimes:mp4,ogx,oga,ogv,ogg,webm | max:20000"
}

```



