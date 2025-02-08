# Employee Management - v1.0 (alpha 🤣)

## 📌 About the Project

**Employee Management** is a system to management your employees in your business! It was build using PHP and the **MVC** architecture methodology. Users can register, login and see, edit their profile!
Administrators has special access permissions to management their employees. 

## 🚀 Features

### 📝 Authentication

- User register;
- Auth verification in login;
- Access permissions based on your user type.

### 👤 User Profile

- View your profile;
- Edit profile information.

### 🏢 Management

- List of all registred employees;
- Administrators can edit all the data from users.

### 🔒 Acsess Permissions

- **Guests**: Access to home, register and login page. 
- **User**: Access to menu and profile page.
- **Administrator**: Access to menu, profile, employees, and other profile pages.

### 🛜 Friendly URLs

- This project uses **.htaccess** to manipulate the urls. So, it doesn't need to use query string params!
- Before: employee-management/public/?page=menu;
- Now: employee-management/menu

## 🛠️ Technologies

- **HTML**;
- **CSS**;
- **JavaScript**;
- **PHP**;
- **MySQL**;
- **Twig**;
- **Composer**;
- **Arquitetura MVC**;

## 📂 Project Structure:

```
/employee-management
│── src/
│   ├── app/
│   │   ├── connection/
│   │   │   ├── connection.php
│   │   ├── controller/
│   │   │   ├── AdminController.php
│   │   │   ├── AuthController.php
│   │   │   ├── EmployeeController.php
│   │   │   ├── ErrorController.php
│   │   │   ├── HomeController.php
│   │   ├── core/
│   │   │   ├── Core.php
│   │   ├── model/
│   │   │   ├── Admin.php
│   │   │   ├── Employee.php
│   │   │   ├── User.php
│   │   ├── router/
│   │   │   ├── Router.php
│   │   ├── template/
│   │   │   ├── template.html
│   │   ├── view/
│   │   │   ├── admin/
│   │   │   │   ├── menu.html
│   │   │   ├── auth/
│   │   │   │   ├── login.html
│   │   │   │   ├── register.html
│   │   │   ├── user/
│   │   │   │   ├── employee.html
│   │   │   │   ├── menu.html
│   │   │   │   ├── profile.html
│   │   │   │   ├── update_account.html
│   │   │   ├── home.html
│   ├── assets/
│       ├── database
│       │   ├── employee-management.sql
│       ├── images
│           ├── profile_pic
│               ├── default.svg
│── public/
│   ├── scripts/
│   │   ├── auth.js
│   │   ├── toCamelCase.js
│   │   ├── updatePicture.js
│   ├── styles/
│   │   ├── auth.css
│   │   ├── employees.css
│   │   ├── global.css
│   │   ├── menu.css
│   │   ├── auth.css
│   │── index.php
│── .htaccess
│── composer.json
│── composer.lock
│── composer.phar
```

## 🛠️ How to Install?

1. Clone this repository:
   ```sh
   git clone https://github.com/gfloriano11/employee-management.git
   ```
2. Install composer:
   <a href="https://getcomposer.org/Composer-Setup.exe">Download</a>

3. Create "composer.json" in project root [If doesn't exists!]

4. Put this code in composer.json
   ```sh
   {
     "require": {
      
     }
   }
   ```

5. Install "composer.phar":
  <a href="https://getcomposer.org/composer.phar">Download</a>

6. Put composer.phar in project root

7. IN the terminal (CMD or VSCode) enter in the project root and write:
   ```sh
   composer install
   ```

8. In the terminal (CMD or VSCode) enter in the project root and write:
   ```sh
   php composer.phar install
   ```

9. In the terminal (CMD or VSCode) enter in the project root and write:
   ```sh
   composer require twig/twig
   ```
Now, you can use my Employee-Management APP. Thanks!

## ✨ Contribuition

If you want, you can contribute to the project, open an issue or a Pull Request! 😁

---

📌 Developed by **Gustavo Floriano** <a href="github.com/gfloriano11">Github Profile</a> 🚀
