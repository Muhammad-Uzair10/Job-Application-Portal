# Job-Application-Portal
This repository contains a job application portal built using PHP, MySQL, HTML, and CSS. The portal provides features for users to view job listings, apply for jobs, and manage their job applications. It is designed to run locally using XAMPP.

## Features

- **Job Listings:** View available job positions.
- **Job Applications:** Apply for jobs with relevant details.
- **Admin Panel:** Manage job listings and view applications.
- **User Authentication:** Register and log in to manage job applications.

## Technologies Used

- PHP
- MySQL
- HTML
- CSS
- XAMPP

## Getting Started

### Prerequisites

- XAMPP (includes Apache, MySQL, and PHP)
- Web browser (e.g., Chrome, Firefox)

### Installation

1. **Install XAMPP:**
   Download and install XAMPP from [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).

2. **Clone the repository:**

   ```bash
   git clone https://github.com/yourusername/job-application-portal.git
   cd job-application-portal

3. **Move the project to XAMPP's htdocs directory:**
cp -r job-application-portal /path/to/xampp/htdocs/

**Start Apache and MySQL:**
Open the XAMPP Control Panel and start the Apache and MySQL services.

**Create the database:**

Open your web browser and go to http://localhost/phpmyadmin.
Create a new database named job_portal.
Import the SQL file located at /path/to/xampp/htdocs/job-application-portal/db/job_portal.sql.

**Configure the database connection:**

Open config.php file in the project directory.

**Update the database credentials as needed:**
<?php
$servername = "localhost";
$username = "root"; // default XAMPP username
$password = ""; // default XAMPP password
$dbname = "job_portal";
?>


