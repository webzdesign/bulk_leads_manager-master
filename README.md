# Bulk Leads Manager

A comprehensive Laravel-based application for managing bulk lead imports, processing, ordering, and distribution to clients. This system handles CSV file imports, lead validation, duplicate detection, order management, and automated lead distribution via email.

## Table of Contents

- [Project Overview](#project-overview)
- [Tech Stack](#tech-stack)
- [Features](#features)
- [Folder Structure](#folder-structure)
- [Application Flow](#application-flow)
- [API & Third-Party Integrations](#api--third-party-integrations)
- [Setup & Installation](#setup--installation)
- [Environment Variables](#environment-variables)
- [Running the Project](#running-the-project)
- [Cron Jobs / Background Tasks](#cron-jobs--background-tasks)
- [Common Use Cases](#common-use-cases)
- [Known Limitations](#known-limitations)
- [Future Improvements](#future-improvements)
- [Contribution Guidelines](#contribution-guidelines)
- [License](#license)

## Project Overview

Bulk Leads Manager is a lead management system designed to:
- Import and process bulk CSV files containing lead data
- Validate, deduplicate, and categorize leads by type and age groups
- Manage clients and create orders with specific lead criteria
- Automatically distribute leads to clients via email
- Track import history and generate statistics
- Automatically archive and delete old leads based on configurable rules

The system supports multiple lead types, age-based categorization, geographic filtering (states/cities), and prevents duplicate lead distribution to the same client.

## Tech Stack

### Backend
- **Framework:** Laravel 12.0
- **PHP Version:** 8.2+
- **Database:** MySQL (default), PostgreSQL, SQLite supported
- **Authentication:** Laravel Sanctum

### Key Dependencies
- **Excel/CSV Processing:**
  - `maatwebsite/excel` (^3.1) - Excel file handling and import/export
  - `rap2hpoutre/fast-excel` (^5.6) - Fast CSV import/export for large files
- **Data Tables:** `yajra/laravel-datatables-oracle` (12.0) - Server-side data tables
- **Queue System:** Laravel Queues (database driver by default)
- **Notifications:** Laravel Notifications for real-time upload progress

### Frontend
- **Build Tool:** Vite 7.x
- **CSS Framework:** Tailwind CSS 4.0
- **JavaScript:** Axios for AJAX requests
- **Data Visualization:** DataTables (server-side processing)
- **Development:** Concurrently for running multiple processes

### Development Tools
- **Code Style:** Laravel Pint
- **Testing:** PHPUnit 11.5
- **Logging:** Laravel Pail
- **Development Server:** Laravel Sail (optional)

## Features

### Lead Management
- **CSV Import:** Upload and process bulk CSV files with configurable column mapping
- **Lead Validation:** Automatic validation for required fields (phone number)
- **Duplicate Detection:** Phone number-based duplicate detection across the system
- **Age Group Assignment:** Automatic age calculation and categorization based on date generated
- **Geographic Data:** Support for Country, State, and City with auto-creation of new entries
- **Lead Filtering:** Filter leads by type, age group, gender, state, and other criteria
- **Bulk Operations:** Bulk deletion of selected leads
- **Lead Tracking:** Track lead upload progress with real-time notifications
- **Age Restrictions:** Configurable limits on importing leads older than specified months

### Lead Types & Age Groups
- Create and manage multiple lead types (e.g., Australian Bulk Leads, US Bulk Leads)
- Define age groups (e.g., 0-30 days, 31-60 days) for each lead type
- Automatic age group assignment during import based on lead age (calculated from date_generated)
- Soft delete support for age groups

### Client Management
- Client CRUD operations with email uniqueness validation
- Client email autocomplete/search functionality
- Track client order history and last order details
- Filter clients by state
- Soft delete support for clients

### Order Management
- Create orders with specific criteria:
  - Lead type and age group selection
  - Quantity specification
  - Gender filtering (Male/Female/All)
  - State filtering (multiple states support)
- Automatic lead availability calculation (excludes already-sent leads)
- Order status tracking (Pending/Completed)
- Download completed order files as CSV
- Resend order functionality
- Prevents sending duplicate leads to the same client
- Configurable maximum number of times a lead can be downloaded

### Import History
- Track all CSV imports with status (Pending/Processing/Success/Error)
- View import statistics (total rows, duplicates, invalid, imported, rejected)
- Download original and duplicate files
- View age group distribution per import
- Real-time upload progress tracking via notifications

### Statistics & Reporting
- Dashboard with key metrics:
  - Total leads by type and age group
  - Leads added in last 24 hours, 7 days, 30 days
  - Inventory of unsent leads
  - Percentage calculations and trends
- Recent orders and imports display
- Detailed statistics view with filtering capabilities

### Settings
- **Site Settings:**
  - Auto-delete records after X months
  - Disallow import of leads older than X months
  - Frequency of deleted archives (cron schedule configuration)
  - Maximum number of times a lead can be downloaded
- **Email Configuration:**
  - SMTP settings (from address, from name, reply-to, BCC)
  - Email templates with rich text editor support
  - Multiple recipient configuration for deletion notifications
  - Email template management (subject and content)
- **Age Data Updates:** Background process to update lead ages

### Automated Processes
- **Lead Sending:** Automatic order processing and email distribution (cron - every 5 minutes)
- **Lead Deletion:** Scheduled deletion of old leads with email notification (configurable frequency)
- **Background Upload:** Asynchronous CSV processing with progress tracking
- **Notifications:** Real-time upload progress notifications via Laravel Notifications

### User Management
- Admin/user CRUD operations
- Role-based access (authentication required for all routes)
- Password reset functionality
- User authentication via Laravel's default auth system

## Folder Structure

```
bulk_leads_manager/
├── app/
│   ├── Console/
│   │   ├── Commands/          # Artisan commands
│   │   │   ├── LeadDelete.php      # Scheduled lead deletion
│   │   │   ├── LeadSend.php        # Scheduled lead sending
│   │   │   ├── LeadSync.php        # Lead synchronization (available)
│   │   │   ├── LeadUpload.php      # Background CSV processing
│   │   │   └── TestCommand.php     # Testing command
│   │   └── Kernel.php         # Cron job scheduling
│   ├── Exports/               # CSV export classes
│   │   ├── ExportCSV.php
│   │   ├── ImportDownload.php
│   │   ├── LeadDetailsExport.php
│   │   └── LeadStatusDownload.php
│   ├── Http/
│   │   ├── Controllers/       # Application controllers (22 files)
│   │   │   ├── Auth/          # Authentication controllers
│   │   │   ├── AdminsController.php
│   │   │   ├── AgeGroupController.php
│   │   │   ├── ClientController.php
│   │   │   ├── HomeController.php
│   │   │   ├── ImportController.php
│   │   │   ├── ImportHistoryController.php
│   │   │   ├── LeadDeleteController.php
│   │   │   ├── LeadsController.php
│   │   │   ├── LeadTypes.php
│   │   │   ├── NewOrderController.php
│   │   │   ├── OrdersController.php
│   │   │   ├── SettingController.php
│   │   │   └── StatsController.php
│   │   ├── Kernel.php         # HTTP kernel
│   │   ├── Middleware/        # Custom middleware (9 files)
│   │   └── Requests/          # Form request validation
│   ├── Imports/               # CSV import classes
│   │   ├── GetData.php
│   │   └── LeadImport.php
│   ├── Models/                # Eloquent models (16 models)
│   │   ├── AgeGroup.php
│   │   ├── AgeGroupUpdate.php
│   │   ├── City.php
│   │   ├── Client.php
│   │   ├── Country.php
│   │   ├── EmailTemplate.php
│   │   ├── Lead.php
│   │   ├── LeadDetail.php
│   │   ├── LeadFields.php
│   │   ├── LeadType.php
│   │   ├── LeadUploadTrack.php
│   │   ├── Order.php
│   │   ├── OrderDetail.php
│   │   ├── SiteSetting.php
│   │   ├── State.php
│   │   └── User.php
│   ├── Notifications/         # Laravel notifications
│   │   └── UploadLead.php     # Upload progress notifications
│   └── Providers/             # Service providers
├── bootstrap/                 # Application bootstrap files
├── config/                    # Configuration files
├── database/
│   ├── migrations/            # Database migrations (56 files)
│   └── seeders/               # Database seeders (4 files)
├── public/                    # Public assets and entry point
│   ├── app/
│   │   └── import/            # Sample CSV files
│   ├── assets/                # Static assets (CSS, JS, images)
│   └── index.php              # Application entry point
├── resources/
│   ├── views/                 # Blade templates (35 files)
│   ├── js/                    # JavaScript files
│   └── css/                   # Stylesheets
├── routes/
│   ├── web.php                # Web routes
│   ├── api.php                # API routes (minimal)
│   └── console.php            # Console routes
├── storage/
│   ├── app/
│   │   ├── import/            # Uploaded CSV files
│   │   └── leadreport/        # Generated order CSV files
│   ├── framework/             # Framework cache
│   └── logs/                  # Application logs
├── tests/                     # Unit and feature tests
├── artisan                    # Artisan command-line interface
├── composer.json              # PHP dependencies
├── package.json               # Node dependencies
├── vite.config.js             # Vite configuration
└── phpunit.xml                # PHPUnit configuration
```

## Application Flow

### Lead Import Flow
1. **Upload CSV:** Admin uploads a CSV file and selects lead type
2. **Column Mapping:** Admin maps CSV columns to lead fields (email, phone, gender, address, etc.)
3. **Preview:** System shows preview of first 15 rows for validation
4. **Background Processing:** Upload triggers background command (`upload:lead_details`)
5. **Validation & Processing:**
   - Validates required fields (phone number)
   - Detects duplicates based on phone number (checks existing non-duplicate, non-invalid leads)
   - Calculates age from date_generated (supports multiple date formats: d-m-Y, d/m/Y, etc.)
   - Rejects leads older than configured threshold (months)
   - Assigns age groups automatically based on calculated age
   - Creates/links Country/State/City records if they don't exist
   - Processes in batches of 2000 records for performance
6. **Progress Tracking:** Real-time progress updates via Laravel Notifications
7. **Completion:** Import status updated, statistics stored (total, duplicates, invalid, rejected, imported), notification sent

### Order Creation & Processing Flow
1. **Client Selection:** Select existing client or create new one (with email uniqueness check)
2. **Order Criteria:** Select lead type, age group, quantity, gender, states (multiple states supported)
3. **Availability Check:** System calculates available leads (excludes previously sent to client, respects max download limit)
4. **Order Creation:** Order saved with status "Pending" and order date
5. **Automated Processing:** Cron job (`lead:send`) runs every 5 minutes:
   - Fetches pending orders
   - Selects leads matching criteria (excluding already sent to client)
   - Generates CSV file with lead details using database stored procedure
   - Sends email with CSV attachment to client (using configured email template)
   - Updates order status to "Completed"
   - Updates lead `is_send` counter
   - Supports resend functionality for completed orders

### Lead Deletion Flow
1. **Scheduled Execution:** Cron job (`lead:delete`) runs on configured schedule (based on site settings)
2. **Age Calculation:** Finds leads older than configured threshold (based on `date_generated`)
3. **Export:** Creates CSV file with deleted leads (includes all lead details)
4. **Archive:** Creates ZIP file of deleted leads CSV
5. **Email Notification:** Sends ZIP file to configured email addresses (deleted_lead_email_one, deleted_lead_email_two)
6. **Deletion:** Permanently deletes leads from database
7. **Logging:** Outputs success message to console

### Age Group Update Flow
1. **Manual Trigger:** Admin initiates age group update from settings
2. **Background Processing:** Updates age of all leads based on current date and date_generated
3. **Reassignment:** Reassigns age groups based on updated ages
4. **Progress Tracking:** Real-time progress updates via notifications

## API & Third-Party Integrations

### Email Services
The application supports multiple email drivers configured via `.env`:
- **SMTP** (default) - Standard SMTP configuration
- **Mailgun** - Requires `MAILGUN_DOMAIN` and `MAILGUN_SECRET` (not directly configured in code, but Laravel supports it)
- **Amazon SES** - Requires AWS credentials (`AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`)
- **Postmark** - Requires `POSTMARK_API_KEY`
- **Resend** - Requires `RESEND_API_KEY`
- **Sendmail** - Local sendmail configuration
- **Log** - Development/testing (emails logged to files)
- **Array** - Development/testing (emails stored in array)

### File Storage
- **Local Storage:** CSV files stored in `storage/app/import/` and `storage/app/leadreport/`
- **Public Storage:** Deleted lead archives in `public/assets/` (ZIP files)

### Database
- **MySQL** (default) - Primary database
- Uses stored procedure: `order_excel_generate_by_id()` for order CSV generation (referenced in code)
- Database queue driver for background jobs
- Soft deletes for Leads, Clients, and Age Groups

### Notifications
- **Laravel Notifications:** Real-time upload progress and system notifications
- Stored in database (notifications table)
- Broadcast capability (channels configured but minimal use)

## Setup & Installation

### Prerequisites
- PHP 8.2 or higher
- Composer 2.x
- MySQL 5.7+ / MariaDB 10.2+ / PostgreSQL / SQLite
- Node.js 18+ and NPM
- Web server (Apache/Nginx) or PHP built-in server
- Git

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd bulk_leads_manager-master
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   ```bash
   # Copy environment file (if .env.example exists)
   cp .env.example .env
   # OR create .env manually
   
   # Generate application key
   php artisan key:generate
   ```

5. **Configure `.env` file**
   - Set database credentials
   - Configure mail settings
   - Set application URL
   - Configure queue connection (default: database)
   - (See [Environment Variables](#environment-variables) section for details)

6. **Run Database Migrations**
   ```bash
   php artisan migrate
   ```

7. **Run Database Seeders** (if available and needed)
   ```bash
   php artisan db:seed
   ```

8. **Create Storage Symlink** (for public file access)
   ```bash
   php artisan storage:link
   ```

9. **Build Frontend Assets**
   ```bash
   npm run build          # Production build
   # OR for development:
   npm run dev            # Development with hot reload
   ```

10. **Set Directory Permissions** (Linux/Mac)
    ```bash
    chmod -R 775 storage bootstrap/cache
    chown -R www-data:www-data storage bootstrap/cache  # Adjust user/group as needed
    ```

11. **Configure Cron Job**
    Add to crontab (`crontab -e`):
    ```bash
    * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
    ```

12. **Configure Queue Worker** (required for background processing)
    ```bash
    php artisan queue:work
    ```
    Or use a process manager like Supervisor for production.

13. **Initialize Site Settings** (via web interface)
    - Access the application in browser
    - Navigate to Settings
    - Configure site settings, email settings, and email templates

### Quick Setup (Using Composer Script)

The project includes a setup script in `composer.json`:
```bash
composer run setup
```
This runs: composer install, creates .env if missing, generates key, runs migrations, installs npm packages, and builds assets.

## Environment Variables

Create a `.env` file in the root directory with the following variables:

```env
# Application
APP_NAME="Bulk Leads Manager"
APP_ENV=local
APP_KEY=                    # Generated by: php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost
APP_TIMEZONE=UTC

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bulk_leads_db
DB_USERNAME=root
DB_PASSWORD=

# Mail Configuration (SMTP Example)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="${APP_NAME}"

# Mailgun (Alternative)
# MAIL_MAILER=mailgun
# MAILGUN_DOMAIN=your-domain.mailgun.org
# MAILGUN_SECRET=your-mailgun-secret
# MAILGUN_ENDPOINT=api.mailgun.net

# Amazon SES (Alternative)
# MAIL_MAILER=ses
# AWS_ACCESS_KEY_ID=your-access-key
# AWS_SECRET_ACCESS_KEY=your-secret-key
# AWS_DEFAULT_REGION=us-east-1

# Postmark (Alternative)
# MAIL_MAILER=postmark
# POSTMARK_API_KEY=your-postmark-api-key

# Resend (Alternative)
# MAIL_MAILER=resend
# RESEND_API_KEY=your-resend-api-key

# Session & Cache
SESSION_DRIVER=file
SESSION_LIFETIME=120
CACHE_DRIVER=file
CACHE_STORE=file

# Queue
QUEUE_CONNECTION=database
# For production with Redis:
# QUEUE_CONNECTION=redis
# REDIS_HOST=127.0.0.1
# REDIS_PASSWORD=null
# REDIS_PORT=6379

# Logging
LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=debug
LOG_DEPRECATIONS_CHANNEL=null

# Broadcasting (Optional)
BROADCAST_DRIVER=log
```

**Important Notes:**
- `APP_KEY` must be generated using `php artisan key:generate`
- Database credentials must match your MySQL setup
- Mail configuration is required for sending leads and notifications
- Queue connection should be set to `database` (default) or `redis` for production
- For production, set `APP_DEBUG=false` and `APP_ENV=production`

## Running the Project

### Local Development

#### Option 1: Using Composer Dev Script (Recommended)
```bash
composer run dev
```
This runs concurrently:
- PHP development server
- Queue worker
- Laravel Pail (logs)
- Vite dev server

#### Option 2: Manual Setup
1. **Start the development server**
   ```bash
   php artisan serve
   ```
   Application will be available at `http://localhost:8000`

2. **Start queue workers** (required in separate terminal)
   ```bash
   php artisan queue:work
   ```

3. **Watch for frontend changes** (optional, in separate terminal)
   ```bash
   npm run dev
   ```

4. **Watch logs** (optional, in separate terminal)
   ```bash
   php artisan pail
   ```

### Production Deployment

1. **Optimize for production**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   composer install --optimize-autoloader --no-dev
   npm run build
   ```

2. **Set environment**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

3. **Configure web server** (Nginx/Apache) to point to `public/` directory
   - Example Nginx configuration:
     ```nginx
     server {
         listen 80;
         server_name your-domain.com;
         root /path-to-project/public;
         
         add_header X-Frame-Options "SAMEORIGIN";
         add_header X-Content-Type-Options "nosniff";
         
         index index.php;
         
         charset utf-8;
         
         location / {
             try_files $uri $uri/ /index.php?$query_string;
         }
         
         location = /favicon.ico { access_log off; log_not_found off; }
         location = /robots.txt  { access_log off; log_not_found off; }
         
         error_page 404 /index.php;
         
         location ~ \.php$ {
             fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
             fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
             include fastcgi_params;
         }
         
         location ~ /\.(?!well-known).* {
             deny all;
         }
     }
     ```

4. **Ensure cron job is running:**
   ```bash
   * * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
   ```

5. **Set up queue worker** (using Supervisor recommended)
   Create `/etc/supervisor/conf.d/bulk-leads-queue.conf`:
   ```ini
   [program:bulk-leads-queue]
   process_name=%(program_name)s_%(process_num)02d
   command=php /path-to-project/artisan queue:work database --sleep=3 --tries=3 --max-time=3600
   autostart=true
   autorestart=true
   stopasgroup=true
   killasgroup=true
   user=www-data
   numprocs=2
   redirect_stderr=true
   stdout_logfile=/path-to-project/storage/logs/queue-worker.log
   stopwaitsecs=3600
   ```

## Cron Jobs / Background Tasks

The application uses Laravel's task scheduler for automated processes. Configure the cron job as described in the setup section.

### Scheduled Commands

1. **`lead:send`** - Runs every 5 minutes
   - Processes pending orders
   - Selects and distributes leads to clients
   - Generates CSV files and sends emails
   - Updates order status and lead counters
   - **Schedule:** `->everyFiveMinutes()->withoutOverlapping()`
   - **Command:** `php artisan lead:send`

2. **`lead:delete`** - Runs on configurable schedule
   - Deletes leads older than configured threshold
   - Creates archive ZIP file
   - Sends email notification with archived file
   - **Schedule:** `->cron('* * */X * *')` (configurable via site settings: `frequency_of_deleted_archives`)
   - **Command:** `php artisan lead:delete`

3. **`lead:sync`** - Available but currently disabled
   - Currently commented out in Kernel.php: `// $schedule->command('lead:sync')->daily();`
   - Can be enabled for future lead synchronization features

### Manual Command Execution

```bash
# Process pending orders manually
php artisan lead:send

# Delete old leads manually
php artisan lead:delete

# Upload leads manually (typically called internally via ImportController)
php artisan upload:lead_details "{json_data}"

# Test command (if needed)
php artisan test:command
```

### Background Processing

The application uses Laravel Queues for background CSV processing:
- Queue connection: `database` (default)
- Jobs table: `jobs` (created by migration)
- Failed jobs table: `failed_jobs` (created by migration)
- Queue worker must be running: `php artisan queue:work`

## Common Use Cases

### Use Case 1: Importing Bulk Leads
1. Navigate to **Import CSV** page
2. Select lead type (create if needed in Lead Types section)
3. Upload CSV file (max file size: 200MB)
4. Map CSV columns to lead fields (email, phone, gender, address, city, state, country, birth_date, date_generated, ip, zip)
5. Preview sample data (first 15 rows)
6. Start upload process
7. Monitor progress via notifications (real-time updates)
8. Review import history for detailed statistics (total, duplicates, invalid, rejected, imported)

### Use Case 2: Creating and Fulfilling an Order
1. Navigate to **New Order** page
2. Search/select client (or create new client with email, name, location)
3. Select lead type and age group
4. Specify quantity, gender filter (Male/Female/All), and states (optional, multiple selection)
5. Review available leads count (system calculates excluding already-sent leads)
6. Create order (status: Pending)
7. Order automatically processes within 5 minutes via cron (or manually trigger `php artisan lead:send`)
8. Client receives email with CSV file attachment
9. Download order file from **Orders** page if needed
10. Resend order functionality available for completed orders

### Use Case 3: Managing Lead Types and Age Groups
1. Navigate to **Lead Types** page
2. Create new lead type (e.g., "US Bulk Leads", "Australian Bulk Leads")
3. Add age groups for the lead type (e.g., "0-30 days", "31-60 days", "61-90 days")
   - Define age_from and age_to for each group
4. Configure settings (auto-delete frequency, lead download limits, import restrictions)

### Use Case 4: Viewing Statistics
1. Navigate to **Dashboard** (home page)
2. View total leads by type and age group
3. Review recent orders and imports
4. Navigate to **Stats** page for detailed statistics
5. Review leads added in last 24h/7d/30d
6. Check inventory of unsent leads
7. Monitor trends and percentages

### Use Case 5: Managing Settings
1. Navigate to **Settings** page
2. Configure **Site Settings:**
   - Auto-delete records after X months
   - Disallow import of leads older than X months
   - Frequency of deleted archives (cron schedule)
   - Maximum number of times a lead can be downloaded
3. Configure **Email Setup:**
   - From address and name
   - Reply-to address
   - BCC address (optional)
   - Deleted lead notification emails (2 recipients)
4. Manage **Email Templates:**
   - Create/edit email templates with rich text editor
   - Templates: lead-send (for order emails), lead-delete (for deletion notifications)

### Use Case 6: Managing Clients
1. Navigate to **Clients** page
2. View all clients in DataTable (searchable, filterable)
3. Create new client (with email uniqueness validation)
4. Edit client information
5. Delete client (soft delete)
6. Filter clients by state
7. View client order history

### Use Case 7: Managing Leads
1. Navigate to **Leads** page
2. View all leads in DataTable
3. Filter by lead type, age group, gender, state
4. View lead details
5. Bulk delete selected leads
6. View age group distribution

## Known Limitations

1. **Single File Processing:** Only one CSV file can be processed at a time (status check prevents concurrent uploads)

2. **Memory Usage:** Large CSV files may require increased PHP memory limits (handled with `ini_set('memory_limit', '-1')` in upload command)

3. **Duplicate Detection:** Currently based only on phone numbers (not email addresses)

4. **Date Format Support:** Date parsing supports d-m-Y, d/m/Y, and standard formats, but may fail on unusual formats

5. **Email Attachment Size:** Large order CSV files may exceed email attachment size limits (depends on mail provider)

6. **Stored Procedure Dependency:** Order CSV generation relies on database stored procedure (`order_excel_generate_by_id`) - ensure this exists in database

7. **API Routes:** API routes are minimal (only Sanctum auth route); primarily uses web-based authentication

8. **Synchronous Processing:** Some operations are synchronous and may cause timeouts for very large datasets (despite batch processing in uploads)

9. **Queue Processing:** Uses database queue driver by default (slower than Redis for high-volume scenarios)

10. **File Storage:** Uses local file storage (not cloud storage like S3)

11. **State Filtering:** State filtering in orders uses state name matching (case-sensitive in some cases)

12. **Age Calculation:** Age is calculated based on date_generated field; leads without this field default to age 0

13. **Notifications:** Notifications are database-based (not real-time WebSocket broadcasts)

14. **Error Handling:** Some error scenarios may not provide detailed user feedback

## Future Improvements

Based on code analysis, potential enhancements:

1. **Queue System Enhancement:** Migrate to Redis queue driver for better performance
2. **API Development:** Expand API endpoints with proper authentication (Sanctum) and documentation
3. **Multi-file Upload:** Support concurrent file processing with queue-based approach
4. **Enhanced Duplicate Detection:** Implement email-based duplicate detection in addition to phone numbers
5. **Export Formats:** Support additional export formats (XLSX, JSON, XML)
6. **Real-time Updates:** Implement WebSockets/Laravel Echo for real-time progress updates
7. **Lead Scoring:** Add lead quality scoring system based on multiple factors
8. **Advanced Filtering:** Enhanced search and filter capabilities with full-text search
9. **Audit Logging:** Comprehensive audit trail for all operations (lead imports, orders, deletions)
10. **Testing:** Expand test coverage (unit and feature tests) for critical paths
11. **API Documentation:** Generate API documentation (Swagger/OpenAPI) if API is expanded
12. **Multi-tenancy:** Support for multiple organizations/tenants
13. **Lead Validation Rules:** Configurable validation rules per lead type
14. **Dashboard Enhancements:** More detailed analytics, charts, and reporting
15. **Email Template Variables:** Dynamic variables in email templates (client name, order details, etc.)
16. **Cloud Storage Integration:** Support for S3, Google Cloud Storage for file storage
17. **Background Job Monitoring:** Job monitoring dashboard and retry mechanisms
18. **Rate Limiting:** Implement rate limiting for API and import endpoints
19. **Caching:** Implement caching for frequently accessed data (lead types, age groups, etc.)
20. **Database Optimization:** Add indexes for frequently queried columns
21. **Error Reporting:** Integration with error tracking services (Sentry, Bugsnag)
22. **Performance Monitoring:** APM integration for performance monitoring

## Contribution Guidelines

1. **Fork the repository** and create a feature branch
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. **Follow PSR-12 coding standards** for PHP (enforced by Laravel Pint)
   ```bash
   composer run pint
   ```

3. **Write clear commit messages**
   - Use present tense ("Add feature" not "Added feature")
   - Be descriptive but concise
   - Reference issue numbers if applicable

4. **Test your changes** thoroughly
   ```bash
   composer run test
   ```

5. **Update documentation** if needed (README, code comments, etc.)

6. **Submit a pull request** with a detailed description
   - Describe what the change does
   - Explain why the change is needed
   - Include screenshots for UI changes
   - Reference related issues

### Code Style
- Follow Laravel conventions and best practices
- Use meaningful variable and function names
- Add comments for complex logic
- Keep functions focused and single-purpose
- Use type hints where applicable
- Follow PSR-12 coding standard (run `composer run pint`)

### Testing
- Write tests for new features
- Ensure existing tests pass
- Test edge cases and error scenarios
- Aim for high code coverage on critical paths

### Pull Request Process
1. Ensure all tests pass
2. Ensure code follows style guidelines (Pint)
3. Update documentation as needed
4. Request review from maintainers
5. Address review feedback
6. Merge after approval

## License

**MIT License**

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

**Note:** This README is based on comprehensive code analysis of the repository. For specific implementation details, refer to the source code, inline documentation, and migration files. The system is actively maintained and may include features not documented here. For questions or issues, please refer to the issue tracker or contact the maintainers.
