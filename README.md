**User Management System:**<br/>
This is a Laravel-based user management system that allows you to perform CRUD operations on users, including basic authentication, user listing, creation, updating, and deletion. The system also supports soft delete functionality and user profile photo upload.

**Setup Instructions:**<br>
Follow these steps to set up and run the user management system:
Clone Repository: Clone this repository to your local machine using the following command:
`git clone https://github.com/riazcs/senior_laravel_backend_assessment.git` <br>
Navigate to Project Directory: Change your current directory to the cloned project folder:


`cd user-management-system`<br>
Install Dependencies: Install the project dependencies using Composer:
`composer install`<br>
Set Up Environment File: Create a copy of the .env.example file and rename it to .env. Update the database connection details in the .env file according to your environment settings.

Generate Application Key: Generate the Laravel application key:<br>
`php artisan key:generate`<br>
Run Migrations: Run database migrations to create the necessary tables:


`php artisan migrate`<br>
Seed Database (Optional): If you want to populate the database with sample data, run the database seeder:


`php artisan db:seed`
Start Development Server: Start the Laravel development server:

`php artisan serve`
Access the Application: Once the server is running, you can access the application in your web browser at http://localhost:8000.

**Usage:**<br>
Authentication: The application includes built-in authentication. You can register a new user or login with existing credentials.
User Management: After logging in, you can manage users by performing CRUD operations. Users can be listed, created, updated, and deleted.
Soft Delete: Deleted users are not permanently removed from the database but are soft deleted. You can restore or permanently delete soft-deleted users.
Profile Photo Upload: When creating or updating a user, you can upload a profile photo.
Folder Structure
app: Contains application-specific code.
database: Includes database migrations and seeders.
resources: Contains views, assets, and frontend components.
routes: Defines application routes.
License
This project is licensed under the MIT License. See the LICENSE file for details.

**Contributing**
Feel free to contribute to this project by submitting pull requests or reporting issues. Contributions are welcome!

**Credits**
This user management system is developed by Riazul Islam.

For more information, please contact riazul.cse.mbstu@gmail.com.# senior_laravel_backend_assessment
