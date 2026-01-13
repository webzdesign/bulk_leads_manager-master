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
- **Framework:** Laravel 8.x
- **PHP Version:** 7.3+ / 8.0+
- **Database:** MySQL
- **Authentication:** Laravel UI (Bootstrap)

### Key Dependencies
- **Excel/CSV Processing:**
  - `maatwebsite/excel` (^3.1) - Excel file handling
  - `rap2hpoutre/fast-excel` (^4.1) - Fast CSV import/export
- **Data Tables:** `yajra/laravel-datatables-oracle` (^9.21)
- **HTTP Client:** `guzzlehttp/guzzle` (^7.0.1)
- **API Auth:** `laravel/sanctum` (^2.11)
- **Rich Text Editor:** `ckeditor/ckeditor` (^4.19)
- **Database:** `doctrine/dbal` (^3.3) - Database abstraction

### Frontend
- Bootstrap (via Laravel UI)
- jQuery
- DataTables for data visualization
- CKEditor for rich text editing

## Features

### Lead Management
- **CSV Import:** Upload and process bulk CSV files with configurable column mapping
- **Lead Validation:** Automatic validation for required fields (phone number, email)
- **Duplicate Detection:** Phone number-based duplicate detection across the system
- **Age Group Assignment:** Automatic age calculation and categorization based on date generated
- **Geographic Data:** Support for Country, State, and City with auto-creation of new entries
- **Lead Filtering:** Filter leads by type, age group, gender, state, and other criteria
- **Bulk Operations:** Bulk deletion of selected leads

### Lead Types & Age Groups
- Create and manage multiple lead types (e.g., Australian Bulk Leads, US Bulk Leads)
- Define age groups (e.g., 0-30 days, 31-60 days) for each lead type
- Automatic age group assignment during import based on lead age

### Client Management
- Client CRUD operations with email uniqueness validation
- Client email autocomplete/search functionality
- Track client order history and last order details
- Filter clients by state

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

### Import History
- Track all CSV imports with status (Pending/Processing/Success/Error)
- View import statistics (total rows, duplicates, invalid, imported)
- Download original and duplicate files
- View age group distribution per import

### Statistics & Reporting
- Dashboard with key metrics:
  - Total leads by type and age group
  - Leads added in last 24 hours, 7 days, 30 days
  - Inventory of unsent leads
  - Percentage calculations and trends

### Settings
- **Site Settings:**
  - Auto-delete records after X months
  - Disallow import of leads older than X months
  - Frequency of deleted archives (cron schedule)
  - Maximum number of times a lead can be downloaded
- **Email Configuration:**
  - SMTP settings (from address, from name, reply-to, BCC)
  - Email templates with rich text editor (CKEditor)
  - Multiple recipient configuration for deletion notifications
- **Age Data Updates:** Background process to update lead ages

### Automated Processes
- **Lead Sending:** Automatic order processing and email distribution (cron)
- **Lead Deletion:** Scheduled deletion of old leads with email notification
- **Background Upload:** Asynchronous CSV processing with progress tracking
- **Notifications:** Real-time upload progress notifications

### User Management
- Admin/user CRUD operations
- Role-based access (authentication required for all routes)
- User registration enabled

## Folder Structure

```
bulk_leads_manager/
├── app/
│   ├── Console/
│   │   ├── Commands/          # Artisan commands (LeadUpload, LeadSend, LeadDelete, LeadSync, TestCommand)
│   │   └── Kernel.php         # Cron job scheduling
│   ├── Exports/               # CSV export classes (ExportCSV, LeadDetailsExport, etc.)
│   ├── Http/
│   │   ├── Controllers/       # Application controllers
│   │   ├── Middleware/        # Custom middleware (prevent-back-history, etc.)
│   │   └── Requests/          # Form request validation
│   ├── Imports/               # CSV import classes (LeadImport, GetData)
│   ├── Models/                # Eloquent models (Lead, LeadDetail, Order, Client, etc.)
│   ├── Notifications/         # Laravel notifications (UploadLead)
│   └── Providers/             # Service providers
├── bootstrap/                 # Application bootstrap files
├── config/                    # Configuration files
├── database/
│   ├── migrations/            # Database migrations (28 files)
│   └── seeders/               # Database seeders
├── public/                    # Public assets and entry point
├── resources/
│   ├── views/                 # Blade templates
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
│   └── logs/                  # Application logs
└── tests/                     # Unit and feature tests
```

## Application Flow

### Lead Import Flow
1. **Upload CSV:** Admin uploads a CSV file and selects lead type
2. **Column Mapping:** Admin maps CSV columns to lead fields (email, phone, gender, address, etc.)
3. **Preview:** System shows preview of first 15 rows for validation
4. **Background Processing:** Upload triggers background command (`upload:lead_details`)
5. **Validation & Processing:**
   - Validates required fields (phone number)
   - Detects duplicates based on phone number
   - Calculates age from date generated
   - Assigns age groups automatically
   - Creates/links Country/State/City records
   - Rejects leads older than configured threshold
6. **Progress Tracking:** Real-time progress updates via notifications
7. **Completion:** Import status updated, statistics stored, notification sent

### Order Creation & Processing Flow
1. **Client Selection:** Select existing client or create new one
2. **Order Criteria:** Select lead type, age group, quantity, gender, states
3. **Availability Check:** System calculates available leads (excludes previously sent to client)
4. **Order Creation:** Order saved with status "Pending"
5. **Automated Processing:** Cron job (`lead:send`) runs every 5 minutes:
   - Fetches pending orders
   - Selects leads matching criteria (excluding already sent to client)
   - Generates CSV file with lead details
   - Sends email with CSV attachment to client
   - Updates order status to "Completed"
   - Updates lead `is_send` counter

### Lead Deletion Flow
1. **Scheduled Execution:** Cron job (`lead:delete`) runs on configured schedule
2. **Age Calculation:** Finds leads older than configured threshold (based on `date_generated`)
3. **Export:** Creates CSV file with deleted leads
4. **Archive:** Creates ZIP file of deleted leads
5. **Email Notification:** Sends ZIP file to configured email addresses
6. **Deletion:** Permanently deletes leads from database

## API & Third-Party Integrations

### Email Services
The application supports multiple email drivers configured via `.env`:
- **SMTP** (default) - Standard SMTP configuration
- **Mailgun** - Requires `MAILGUN_DOMAIN` and `MAILGUN_SECRET`
- **Amazon SES** - Requires AWS credentials
- **Postmark** - Requires `POSTMARK_TOKEN`
- **Sendmail** - Local sendmail configuration
- **Log** - Development/testing (emails logged to files)

### File Storage
- **Local Storage:** CSV files stored in `storage/app/import/` and `storage/app/leadreport/`
- **Public Storage:** Deleted lead archives in `public/storage/deleteZip/`

### Database
- **MySQL** (default) - Primary database
- Uses stored procedure: `order_excel_generate_by_id()` for order CSV generation

## Setup & Installation

### Prerequisites
- PHP 7.3+ or 8.0+
- Composer
- MySQL 5.7+ or MariaDB 10.2+
- Node.js and NPM (for frontend assets)
- Web server (Apache/Nginx) or PHP built-in server

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
   cp .env.example .env  # If .env.example exists, or create .env manually
   php artisan key:generate
   ```

5. **Configure `.env` file**
   - Set database credentials
   - Configure mail settings
   - Set application URL
   - (See [Environment Variables](#environment-variables) section)

6. **Run Database Migrations**
   ```bash
   php artisan migrate
   ```

7. **Run Database Seeders** (if available)
   ```bash
   php artisan db:seed
   ```

8. **Create Storage Symlink**
   ```bash
   php artisan storage:link
   ```

9. **Build Frontend Assets**
   ```bash
   npm run dev          # Development
   # OR
   npm run production   # Production
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

12. **Configure Queue Worker** (if using queues)
    ```bash
    php artisan queue:work
    ```

## Environment Variables

Create a `.env` file in the root directory with the following variables:

```env
# Application
APP_NAME="Bulk Leads Manager"
APP_ENV=local
APP_KEY=                    # Generated by: php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost

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

# Session & Cache
SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=debug
```

## Running the Project

### Local Development

1. **Start the development server**
   ```bash
   php artisan serve
   ```
   Application will be available at `http://localhost:8000`

2. **With queue workers** (if using queues)
   ```bash
   # Terminal 1: Web server
   php artisan serve
   
   # Terminal 2: Queue worker
   php artisan queue:work
   ```

3. **Watch for frontend changes**
   ```bash
   npm run watch
   ```

### Production Deployment

1. **Optimize for production**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   composer install --optimize-autoloader --no-dev
   npm run production
   ```

2. **Set environment**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

3. **Configure web server** (Nginx/Apache) to point to `public/` directory

4. **Ensure cron job is running:**
   ```bash
   * * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
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

2. **`lead:delete`** - Runs on configurable schedule
   - Deletes leads older than configured threshold
   - Creates archive ZIP file
   - Sends email notification with archived file
   - **Schedule:** `->cron('* * */X * *')` (configurable via site settings)

3. **`lead:sync`** - Commented out (available for future use)
   - Currently disabled: `// $schedule->command('lead:sync')->daily();`

### Manual Command Execution

```bash
# Process pending orders manually
php artisan lead:send

# Delete old leads manually
php artisan lead:delete

# Upload leads manually (typically called internally)
php artisan upload:lead_details "{json_data}"
```

## Common Use Cases

### Use Case 1: Importing Bulk Leads
1. Navigate to **Import CSV** page
2. Select lead type (create if needed)
3. Upload CSV file
4. Map CSV columns to lead fields (email, phone, gender, address, etc.)
5. Preview sample data
6. Start upload process
7. Monitor progress via notifications
8. Review import history for statistics

### Use Case 2: Creating and Fulfilling an Order
1. Navigate to **New Order** page
2. Search/select client (or create new)
3. Select lead type and age group
4. Specify quantity, gender, and states (optional)
5. Review available leads count
6. Create order
7. Order automatically processes within 5 minutes (or manually trigger `php artisan lead:send`)
8. Client receives email with CSV file
9. Download order file from **Orders** page if needed

### Use Case 3: Managing Lead Types and Age Groups
1. Navigate to **Lead Types** page
2. Create new lead type (e.g., "US Bulk Leads")
3. Add age groups for the lead type (e.g., "0-30 days", "31-60 days")
4. Configure settings (auto-delete frequency, lead download limits)

### Use Case 4: Viewing Statistics
1. Navigate to **Dashboard** or **Stats** page
2. View total leads by type and age group
3. Review leads added in last 24h/7d/30d
4. Check inventory of unsent leads
5. Monitor trends and percentages

## Known Limitations

1. **Single File Processing:** Only one CSV file can be processed at a time (status check prevents concurrent uploads)

2. **Memory Usage:** Large CSV files may require increased PHP memory limits (handled with `ini_set('memory_limit', '-1')`)

3. **Duplicate Detection:** Currently based only on phone numbers (not email addresses)

4. **State Filtering:** Hardcoded state lists for specific lead types (US states for type 2, Australian states for others)

5. **Email Attachment Size:** Large order CSV files may exceed email attachment size limits

6. **Stored Procedure Dependency:** Order CSV generation relies on database stored procedure (`order_excel_generate_by_id`)

7. **No API Authentication:** API routes are minimal; primarily uses web-based authentication

8. **Synchronous Processing:** Some operations are synchronous and may cause timeouts for very large datasets

## Future Improvements

Based on code analysis, potential enhancements:

1. **Queue System:** Migrate background uploads to Laravel queues for better scalability
2. **API Development:** Expand API endpoints with proper authentication (Sanctum)
3. **Multi-file Upload:** Support concurrent file processing
4. **Enhanced Duplicate Detection:** Implement email-based duplicate detection
5. **Export Formats:** Support additional export formats (XLSX, JSON)
6. **Real-time Updates:** Implement WebSockets for real-time progress updates
7. **Lead Scoring:** Add lead quality scoring system
8. **Advanced Filtering:** Enhanced search and filter capabilities
9. **Audit Logging:** Comprehensive audit trail for all operations
10. **Testing:** Expand test coverage (unit and feature tests)
11. **Documentation:** API documentation (Swagger/OpenAPI)
12. **Multi-tenancy:** Support for multiple organizations/tenants
13. **Lead Validation Rules:** Configurable validation rules per lead type
14. **Dashboard Enhancements:** More detailed analytics and reporting
15. **Email Template Variables:** Dynamic variables in email templates

## Contribution Guidelines

1. **Fork the repository** and create a feature branch
2. **Follow PSR-12 coding standards** for PHP
3. **Write clear commit messages**
4. **Test your changes** thoroughly
5. **Update documentation** if needed
6. **Submit a pull request** with a detailed description

### Code Style
- Follow Laravel conventions
- Use meaningful variable and function names
- Add comments for complex logic
- Keep functions focused and single-purpose

### Testing
- Write tests for new features
- Ensure existing tests pass
- Test edge cases and error scenarios

## License

**MIT License**

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

**Note:** This README is based on code analysis of the repository. For specific implementation details, refer to the source code and inline documentation.
