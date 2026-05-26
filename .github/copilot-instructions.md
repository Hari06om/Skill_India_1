# Skill India - Job Search & Professional Platform

A Laravel-based job search and professional networking platform built for the Skill India initiative.

## Project Overview

**Skill India** is a comprehensive job search and professional development platform that connects job seekers with employers, enabling skills-based job matching and career growth.

## Key Features

- User authentication and profile management
- Job listings and advanced search
- Job applications and tracking
- Professional profiles with skills
- Employer dashboard
- Job recommendations
- Application status tracking

## Project Structure

```
app/
├── Models/
│   ├── User.php
│   ├── Job.php
│   ├── JobApplication.php
│   ├── Professional.php
│   └── Skill.php
├── Http/
│   └── Controllers/
│       ├── JobController.php
│       ├── ApplicationController.php
│       ├── ProfessionalController.php
│       └── AuthController.php
database/
├── migrations/
│   ├── create_users_table.php
│   ├── create_jobs_table.php
│   ├── create_job_applications_table.php
│   ├── create_professionals_table.php
│   └── create_skills_table.php
routes/
├── web.php
├── api.php
resources/views/ - User interface templates
```

## Database Models

### Users
- id, name, email, password, user_type (job_seeker/employer), created_at, updated_at

### Jobs
- id, title, description, location, salary_range, company_id, required_skills, posted_by, created_at, updated_at

### Job Applications
- id, user_id, job_id, status (pending/accepted/rejected), applied_at, updated_at

### Professionals
- id, user_id, bio, experience_years, location, skills, created_at, updated_at

### Skills
- id, name, category, description, created_at, updated_at

## Setup Instructions

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL or SQLite
- Node.js (optional, for frontend assets)

### Installation Steps

1. **Install Dependencies**
   ```bash
   composer install
   ```

2. **Create Environment File**
   ```bash
   cp .env.example .env
   ```

3. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

4. **Configure Database**
   - Edit `.env` and set your database credentials
   - Database name: `skill_india`
   - Default user: `root`

5. **Run Migrations**
   ```bash
   php artisan migrate
   ```

6. **Seed Database (Optional)**
   ```bash
   php artisan db:seed
   ```

## Development Commands

- **Start Development Server**
  ```bash
  php artisan serve
  ```
  Access at: `http://localhost:8000`

- **Create Migration**
  ```bash
  php artisan make:migration migration_name
  ```

- **Create Model with Migration**
  ```bash
  php artisan make:model ModelName -m
  ```

- **Create Controller**
  ```bash
  php artisan make:controller ControllerName
  ```

- **Run Tests**
  ```bash
  php artisan test
  ```

- **Clear Caches**
  ```bash
  php artisan cache:clear
  php artisan config:clear
  ```

## API Endpoints (Planned)

- `GET /api/jobs` - List all jobs
- `POST /api/jobs` - Create new job (employer only)
- `GET /api/jobs/{id}` - Get job details
- `POST /api/applications` - Apply for job
- `GET /api/applications` - View user applications
- `GET /api/professionals/{id}` - Get professional profile
- `POST /api/professionals` - Update profile

## Development Workflow

1. Create migrations for new database tables
2. Create corresponding models
3. Create controllers for business logic
4. Define routes in `routes/api.php` or `routes/web.php`
5. Write tests for new features
6. Update this documentation

## Technologies Used

- **Framework**: Laravel 11
- **Database**: MySQL/SQLite
- **Authentication**: Laravel Built-in Auth
- **API**: RESTful JSON API
- **Testing**: PHPUnit

## Next Steps

1. Run database migrations
2. Create seeders for sample data
3. Implement job search functionality
4. Build user authentication UI
5. Create professional profile pages
6. Implement job application workflow
