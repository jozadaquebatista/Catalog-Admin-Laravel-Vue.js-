# Product Admin (Laravel + Vue.js)
An Fullstack Developer Aplication Test

### What's the Goal
Develop an product adminstration tool, that should contain:
- product's visualization
- option to add a new product
- option to edit a product
- product status definition(pending, reviewing, aproved, reproved)
- API, admin and normal user authentication
- permission level(authorization)
- back-end and front-end product filtering

### This project is done with
- [x] **Sqlite** - Just for testing
- [x] **PHP 7.4**
- [x] **Laravel Framework 7**
- [x] **Vue.js 2.0**
    - [x] Vue Router
    - [x] Vuex
    - [x] Vuetify
- [x] **Axios**
- [x] **Croppa**

### How to Start the Server
You just need to execute the following commands:
1) **php artisan migrate** = do all migrations to the database.sqlite file in database/database.sqlite
2) **php artisan db:seed** = pre loading of products information "**fake info**"
3) **php artisan serve** = starts the server

### How to compile Vue.js components for testing
To compile the components you just should write the bellow instruction on a command line:
1) **npm run watch** = compile and bundle vue.js files


## Final Result

### Login
<kbd>
    
![Login Screen](https://raw.githubusercontent.com/jozadaquebatista/Catalog-Admin-Laravel-Vue.js-/master/cover/screen1.PNG)

</kbd>
---------

### Home Screen
<kbd>

![Home Screen](https://raw.githubusercontent.com/jozadaquebatista/Catalog-Admin-Laravel-Vue.js-/master/cover/screen2.PNG)

</kbd>
---------

### Product Register
<kbd>

![Product Register](https://raw.githubusercontent.com/jozadaquebatista/Catalog-Admin-Laravel-Vue.js-/master/cover/screen3.PNG)

</kbd>
