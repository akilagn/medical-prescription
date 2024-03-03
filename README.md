# Medical Prescription Upload Laravel Project

This Laravel project aims to provide a platform for users to upload their medical prescriptions securely. It offers a convenient way for users to store and manage their prescriptions digitally.

## Features

- User authentication: Allows users to register, login, and manage their accounts securely.
- Prescription upload: Users can upload images or documents of their medical prescriptions.
- Secure storage: Prescription files are securely stored on the server.
- User dashboard: Users can view and manage their uploaded prescriptions.
- Admin panel: Administrators can manage user accounts and prescriptions.

## Installation

1. Clone the repository to your local machine:
        - [https://github.com/akilagn/medical-prescription](https://github.com/akilagn/medical-prescription.git)

2. Navigate to the project directory:
        - cd medical-prescription

3. Install dependencies using Composer:
        - composer install

4. Generate application key:
        - php artisan key:generate

5. Create a symbolic link from public/storage to storage/app/public for storing prescription files:
        - php artisan storage:link

6. Configure your database settings in the .env file:
        - DB_CONNECTION=mysql
        - DB_HOST=127.0.0.1
        - DB_PORT=3306
        - DB_DATABASE=your_database(replace your database name)
        - DB_USERNAME=your_username(replace)
        - DB_PASSWORD=your_password(replace)

7. Serve the application:
        - php artisan serve
