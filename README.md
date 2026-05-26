# Skill India - Job Search & Professional Platform

A modern Laravel-based job search and professional networking platform designed for the Skill India initiative. This platform connects job seekers with employers, enabling skills-based matching and career development.

## 🎯 Features

- **User Authentication** - Secure login for job seekers and employers
- **Job Listings** - Browse and search for jobs by location, skills, and salary
- **Professional Profiles** - Showcase skills and experience
- **Job Applications** - Apply for jobs and track application status
- **Employer Dashboard** - Post jobs and manage applications
- **Skills Matching** - AI-powered job recommendations based on skills
- **Advanced Search** - Filter jobs by multiple criteria

## 🛠️ Tech Stack

- **Backend**: Laravel 11 (PHP 8.1+)
- **Database**: MySQL/SQLite
- **Authentication**: Laravel Breeze/Sanctum
- **API**: RESTful JSON API
- **Testing**: PHPUnit
- **Frontend**: Blade Templates / Livewire (optional)

## 📋 Requirements

- PHP 8.1 or higher
- Composer
- MySQL 5.7+ or SQLite
- Node.js 18+ (for frontend build tools)

## 🚀 Quick Start

### 1. Clone Repository
```bash
cd /Users/hariomverma/Developer/Project
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database
Edit `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=skill_india
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Start Development Server
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## 📁 Project Structure

```
skill-india/
├── app/
│   ├── Models/              # Database models
│   ├── Http/
│   │   ├── Controllers/    # Application controllers
│   │   └── Requests/       # Form request validations
│   └── Services/           # Business logic services
├── database/
│   ├── migrations/         # Database migrations
│   ├── seeders/            # Database seeders
│   └── factories/          # Model factories
├── routes/
│   ├── api.php            # API routes
│   ├── web.php            # Web routes
│   └── console.php        # Console commands
├── resources/
│   └── views/             # Blade templates
├── tests/
│   ├── Unit/              # Unit tests
│   ├── Feature/           # Feature tests
│   └── TestCase.php       # Base test class
├── config/                # Configuration files
├── storage/               # Logs, uploads, caches
└── public/                # Publicly accessible files
```

## 🗄️ Database Schema

### Users Table
- Stores authentication data and user information
- Roles: job_seeker, employer, admin

### Jobs Table
- Job listings with title, description, location, salary
- Linked to employer (user)

### Job Applications Table
- Tracks applications from job seekers
- Statuses: pending, shortlisted, rejected, accepted

### Professionals Table
- Extended profile for job seekers
- Experience, bio, location information

### Skills Table
- List of available skills
- Can be associated with jobs and professionals

## 💻 Common Commands

### Database
```bash
php artisan migrate              # Run all migrations
php artisan migrate:rollback     # Rollback migrations
php artisan migrate:refresh      # Rollback and re-run
php artisan db:seed             # Seed sample data
```

### Models & Migrations
```bash
php artisan make:model Post -m                    # Model with migration
php artisan make:migration create_table_name     # Migration only
php artisan make:controller PostController       # Controller
```

### Tinker (Interactive Shell)
```bash
php artisan tinker
```

### Testing
```bash
php artisan test                 # Run all tests
php artisan test tests/Unit     # Run specific test suite
```

### Cache & Config
```bash
php artisan config:cache        # Cache configurations
php artisan cache:clear         # Clear application cache
php artisan storage:link        # Create storage symlink
```

## 🔐 Authentication

The application uses Laravel's built-in authentication system with two user types:

- **Job Seekers**: Can browse jobs, apply, and manage profiles
- **Employers**: Can post jobs, view applications, manage listings

To enable authentication:
```bash
php artisan migrate
```

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

Run specific test:
```bash
php artisan test tests/Feature/JobSearchTest.php
```

## 📚 API Documentation

### Authentication
- `POST /api/auth/register` - Register new user
- `POST /api/auth/login` - Login user
- `POST /api/auth/logout` - Logout user

### Jobs
- `GET /api/jobs` - List all jobs
- `POST /api/jobs` - Create job (employer only)
- `GET /api/jobs/{id}` - Get job details
- `PUT /api/jobs/{id}` - Update job (employer only)
- `DELETE /api/jobs/{id}` - Delete job (employer only)

### Applications
- `POST /api/applications` - Apply for job
- `GET /api/applications` - Get user applications
- `PUT /api/applications/{id}` - Update application status

### Professionals
- `GET /api/professionals/{id}` - Get professional profile
- `PUT /api/professionals/{id}` - Update professional profile
- `GET /api/professionals/search` - Search professionals

## 🤝 Contributing

1. Create a feature branch: `git checkout -b feature/my-feature`
2. Make your changes and write tests
3. Commit: `git commit -am 'Add new feature'`
4. Push: `git push origin feature/my-feature`
5. Submit a pull request

## 📝 License

This project is open source and available under the MIT License.

## 🆘 Support & Documentation

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel API Documentation](https://laravel.com/api)
- [MySQL Documentation](https://dev.mysql.com/doc/)

## 🎓 Learning Resources

- [Laravel From Scratch](https://laracasts.com/series/laravel-from-scratch)
- [RESTful API Best Practices](https://restfulapi.net)
- [Database Design Guide](https://www.vertabelo.com/blog/database-design)

---

**Last Updated**: May 21, 2026
**Version**: 1.0.0
**Status**: Development

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# Skill_India_1
