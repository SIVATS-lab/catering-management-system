# Catering Management System

A professional-grade, responsive web application for managing catering services with PHP/MySQL backend and modern frontend.

## Features

- User registration and authentication
- Step-by-step booking wizard
- Admin panel with full CRUD operations
- Real-time data fetching with AJAX
- Responsive design with Bootstrap
- Reports and analytics

## Setup Instructions

1. **Prerequisites**
   - PHP 7.4 or higher
   - MySQL 5.7 or higher
   - Apache/Nginx web server (or XAMPP/WAMP for local development)

2. **Database Setup**
   - Create a MySQL database named `catering_system`
   - Import the `catering_system.sql` file into your database
   - Alternatively, run `installer.php` to create tables automatically

3. **Configuration**
   - Update `db.php` with your database credentials:
     ```php
     $host = 'localhost';
     $user = 'your_username';
     $pass = 'your_password';
     $dbname = 'catering_system';
     ```

4. **Deployment**
   - Place all files in your web server's document root (e.g., `htdocs` for XAMPP)
   - Ensure the web server has write permissions for the directory

5. **Access**
   - Frontend: `http://localhost/catering-management-system/`
   - Admin Panel: `http://localhost/catering-management-system/admin_login.php`
     - Username: `admin`
     - Password: `password`

## File Structure

- `index.php` - Landing page
- `register.php` - User registration
- `login.php` - User login
- `booking.php` - Booking wizard
- `view_booking.php` - View user bookings
- `admin_dashboard.php` - Admin dashboard
- `manage_bookings.php` - Manage bookings (admin)
- `manage_menu.php` - Manage menu items (admin)
- `manage_users.php` - Manage users (admin)
- `admin_reports.php` - Reports (admin)
- `get_booking_details.php` - AJAX endpoint for booking details
- `get_user_details.php` - AJAX endpoint for user details
- `contact_submit.php` - AJAX endpoint for contact form
- `logout.php` - Logout script
- `installer.php` - Database setup script
- `db.php` - Database connection
- `catering_system.sql` - Database schema and sample data

## Security Notes

- Change the default admin password after first login
- Use HTTPS in production
- Validate and sanitize all user inputs
- Use prepared statements for database queries

## Technologies Used

- PHP 7.4+
- MySQL 5.7+
- Bootstrap 5.3
- jQuery 3.6
- HTML5/CSS3

## Troubleshooting

- Ensure PHP sessions are enabled
- Check file permissions for uploads if adding images
- Verify database connection settings
- Clear browser cache if experiencing issues

For support, please check the code comments or contact the developer.