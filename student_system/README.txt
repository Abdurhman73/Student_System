Student Management System (Simple)
---------------------------------
Contents:
- create_db.sql        : SQL script to create database and tables + sample admin user
- db_connect.php       : Database connection file
- login.php            : Login page (for admin and students)
- register.php         : Student self-registration page
- logout.php           : Logout script
- admin_dashboard.php  : Admin dashboard (links to manage pages)
- student_dashboard.php: Student dashboard (links to profile and grades)
- manage_students.php  : Admin: view/add/edit/delete students (basic)
- manage_users.php     : Admin: manage users (create student user manually)
- add_course.php       : Admin: add a new course
- add_grade.php        : Admin: insert a grade for a student
- my_profile.php       : Student: view/edit own profile
- my_grades.php        : Student: view own grades
- assets/              : Optional folder for CSS/images (empty)

How to use:
1. Import create_db.sql into phpMyAdmin or run it in MySQL to create the database and tables.
2. Copy the project folder into your XAMPP/htdocs (or equivalent) and open the site in browser.
3. Default admin login: username=admin  password=12345
4. For production use, change MD5 password usage to password_hash/password_verify.
