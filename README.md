Student: TRAN YEN NHI
TROY ID: 1694587
Course: Web Application Development

Project Overview
SocialNet is a lightweight social networking application designed for connecting users, viewing personal profiles, and managing account details. The project was developed in a Linux environment (Ubuntu VM) using the LAMP Stack architecture.

				Key Features
Authentication System: Secure Sign-up, Sign-in, and Sign-out using PHP sessions.

Home Page (Explore): Discover and view a list of all registered users in the system.

User Profile: Detailed personal profile view for every user.

Account Settings: * Update "About Me" description.

Change Profile Avatar with an Instant Image Preview feature.

Smooth, non-intrusive status notifications (Update success message).

About Page: Dedicated section for author and project information.

				Installation & Setup
Follow these steps to run the project on your local Ubuntu machine or VMware:

1. Prerequisites
Ensure Nginx/Apache, PHP, and MySQL are installed.

Project directory: /var/www/html/socialnet.

2. Database Setup
Log in to MySQL: sudo mysql -u root -p.

Create the database: CREATE DATABASE socialnet;.

Import the provided data file:

Bash
mysql -u root -p socialnet < database.sql

3. Source Code Configuration
Clone the repository:

Bash
git clone https://github.com/Tanie04/socialnet.git
Grant permissions for the image upload folder (Crucial):

Bash
sudo chmod -R 777 /var/www/html/socialnet/uploads

4. Database Connection
Verify and edit db_connect.php to match your local MySQL username and password.

Security Implementation
The project implements several basic security measures:

SQL Injection Prevention: Uses Prepared Statements (MySQLi) for all database queries.

Linux Permissions: Strict directory-level access control.

Session Validation: Mandatory session checks on all internal pages to prevent unauthorized access.
