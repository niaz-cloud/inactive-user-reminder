# Inactive User Reminder System (Laravel)

# Overview

This Laravel application detects users who have been inactive for a configurable number of days and sends them reminder notifications using a queued job. The system uses Laravel's **Scheduler**, **Queue**, and **Command** features to automatically process inactive users.

This project was developed as part of an internship assignment.

---

#  Features

* Detect users inactive for a configurable number of days
* Scheduled command runs daily
* Queue job dispatches reminder for inactive users
* Prevents users from receiving more than one reminder per day
* Reminder activity is logged
* Configurable inactivity period

---

# Tech Stack

* Laravel
* MySQL
* Laravel Scheduler
* Laravel Queue
* PHP

---

# Project Structure

```
app
 ├─ Jobs
 │   └─ SendInactiveUserReminder.php
 │
 ├─ Console
 │   └─ Commands
 │       └─ CheckInactiveUsers.php

config
 └─ inactive.php

routes
 └─ console.php

database
 └─ migrations
```

---

# ⚙️Installation

Clone the repository:

```
git clone https://github.com/niaz-cloud/inactive-user-reminder.git
```

Move into the project directory:

```
cd inactive-user-reminder
```

Install dependencies:

```
composer install
```

Create environment file:

```
cp .env.example .env
```

Generate application key:

```
php artisan key:generate
```

---

#  Database Setup

Update your `.env` file with database credentials.

Example:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inactive_user_reminder
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations:

```
php artisan migrate
```

---

#  Queue Setup

This project uses Laravel Queue to process reminder jobs.

Set queue connection in `.env`:

```
QUEUE_CONNECTION=database
```

Create queue tables:

```
php artisan queue:table
php artisan migrate
```

Start queue worker:

```
php artisan queue:work
```

---

# Scheduler Setup

Laravel Scheduler runs the command daily to check inactive users.

Run scheduler manually:

```
php artisan schedule:run
```

For production, add this cron job:

```
* * * * * php /path-to-project/artisan schedule:run >> /dev/null 2>&1
```

---

#  Run Inactive User Check

You can manually run the command:

```
php artisan users:check-inactive
```

This will:

1. Find users inactive for the configured number of days
2. Dispatch a reminder job
3. Log reminder activity

---

#  Configuration

The inactivity period can be configured in:

```
config/inactive.php
```

Example:

```
return [
    'days' => 7,
];
```

---

#  Logging

Reminder activity is logged in:

```
storage/logs/laravel.log
```

Example log:

```
Reminder sent to inactive user: test@example.com
```

---

#  Author

**Niaz Mohammad**
Junior Web Developer
Laravel | PHP | MySQL | React
