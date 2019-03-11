# API REST BileMo

This project has been realized as part of project 7 **Openclassroom** training.

### Server Requirements of the Web App
- Application Server PHP 7.1 or higher
- Database MySQL >= 5.7.11

Installation
-----------------
- Clone the master branch

        $ git clone git@github.com:gdpweb/bilemo.git
- Install dependencies with:
    
        $ composer install
- Create database: 

        $ bin/console doctrine:database:create
- Update database:

        $ bin/console doctrine:migrations:migrate
- Load data fixtures:

        $ bin/console doctrine:fixtures:load
- Run PHP's built-in Web Server: 

        $ bin/console server:run
- Navigate to: localhost:8000


Generate the SSH keys with JWT
-----------------
    $ mkdir -p config/jwt 
    $ openssl genrsa -out config/jwt/private.pem -aes256 4096
    $ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem

Test Api BileMo with Postman
-----------------
#### Authentication JWT
- In the input field with the POST method, enter the following url : your_domain/api/login_check
- In the body, select raw and JSON(application/json), write : 

        {
            "username" : "client1",
            "password" : "bilemo"
        }

- In the authorization tab, use the bearer authorization and stick your token
- **Documentation Postman** : [getpostman.com]( https://www.getpostman.com/)
- **Documentation JWT** :  [LexikJWTAuthentication](https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md)
#### Available operations
   
   1. GET /api/phones  
   2. GET /api/phones/{id}     
   3. GET /api/users   
   4. GET /api/users/{id}   
   5. POST /api/users   
   6. DELETE /api/users/{id}
   
Licence
--------
[![Open Source Love](https://badges.frapsoft.com/os/v2/open-source.png?v=103)](https://github.com/ellerbrock/open-source-badges/)

#### Maintainability

[![Maintainability](https://api.codeclimate.com/v1/badges/570786c6e4aa90d0627c/maintainability)](https://codeclimate.com/github/gdpweb/bilemo/maintainability)
