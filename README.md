# ChocoCart_Ecommerce_Website

ChocoCart is a simple yet complete e-commerce website designed for selling chocolates online. The project is built using:

- **Frontend:** HTML, CSS, JavaScript, and Bootstrap (for responsive design)  
- **Backend:** PHP  
- **Database:** MySQL  
- **Email Integration:** PHPMailer for sending OTPs, invoices, and contact form replies

The goal of ChocoCart is to provide chocolate lovers with a smooth and enjoyable online shopping experience.

---

## Features

- User registration and login with email OTP verification using PHPMailer  
- Browse chocolates with organized product listings  
- Shopping cart and checkout system  
- Automated invoice generation and email sending after purchase  
- Contact Us form with automatic email replies  
- Responsive design using Bootstrap to support desktop and mobile devices  
- Persistent data storage using MySQL  

---

## Important Note on PHPMailer Credentials

The project includes PHPMailer for email-related functionalities such as OTP verification and sending invoices.  
**For security reasons, all email credentials (email ID and password) have been removed from the project files.**

### To enable email functionality, you must:  
1. Open the PHP file(s) where PHPMailer is configured (e.g., `client/checkout.php` or relevant backend files).  
2. Replace the placeholder Senders Email Address and Emails App Password with your own valid email credentials.  
3. Ensure your email provider allows SMTP access and “less secure app” access if needed.  

---

## Prerequisites

- PHP installed on your local machine or server (PHP 6.x or higher recommended)  
- MySQL server installed and running  
- A web server like Apache (XAMPP, WAMP, or LAMP recommended)  
- Internet connection for Bootstrap CDN or download Bootstrap locally  

---

## Setup Instructions

1. **Clone or Download** this repository to your local machine.  
2. **Import Database:**  
   - Locate the SQL file (e.g., `chococart.sql`) included in the project folder.  
   - Import it into your MySQL server using phpMyAdmin or command line:  
     ```
     mysql -u your_username -p your_database_name < chococart.sql
     ```  
3. **Configure Database Connection:**  
   - Open the PHP configuration file responsible for DB connection (e.g., `connection.php`).  
   - Update the database host, username, password, and database name according to your local setup.  
4. **Configure PHPMailer:**  
   - Open the PHP files handling email (e.g., `client/register.php`, `client/checkout.php` and `admin/contact.php`).  
   - Add your email credentials as explained above.  
5. **Run the Project:**  
   - Start your local server (Apache & MySQL).  
   - Access the website via `http://localhost/your_project_folder` in your browser.  

---

## How to Use

- Register a new user with your email — you will receive an OTP to verify your account.  
- Log in using your registered credentials.  
- Browse chocolates, add items to your cart, and proceed to checkout.  
- After purchasing, an invoice will be sent automatically to your email.  
- Use the Contact Us form to send messages and receive automated email responses.  

---

## Folder Structure (Example)
```bash
ChocoCart/                       # Main project folder
│
├── admin/                       # Admin panel related files
│
├── assets/                      # All static assets except bootstrap
│   ├── css/
│   │   ├── admin/               # Admin-specific stylesheets
│   │   └── client/              # Client/user-facing stylesheets
│   ├── images/                  # All images (products, UI elements)
│   └── js/                     # JavaScript files
│
├── bootstrap/                   # Bootstrap framework files (CSS, JS)
│
├── client/                      # Client-facing PHP files (index, checkout, cart, etc.)
│
├── Database/                    # Database File
│
├── includes/                    # PHP Includes:--> connection, functions and PHPMailer
│
└── README.md                    # Project documentation
```
---

## Technologies Used

- PHP  
- MySQL  
- HTML, CSS, JavaScript  
- Bootstrap 5  
- PHPMailer  

---

## Troubleshooting

- Make sure PHP and MySQL are running properly on your server.  
- Verify your email credentials and SMTP settings in PHPMailer.  
- Check that your database connection parameters are correct.  
- For email issues, check firewall or antivirus settings that might block SMTP.  
- Use browser developer tools and PHP error logs to debug frontend/backend issues.  

---

## License

This project is open-source and free to use for learning and development purposes.

---

Thank you for checking out ChocoCart! If you have questions or want to contribute, feel free to open issues or pull requests.
### Developed By: Aniket Kumar Jha
