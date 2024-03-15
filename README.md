# House Billing Manager

[![codecov](https://codecov.io/gh/alphaolomi/biller/graph/badge.svg?token=uJYDVMG4zh)](https://codecov.io/gh/alphaolomi/biller)
[![Tests](https://github.com/alphaolomi/biller/actions/workflows/tests.yml/badge.svg)](https://github.com/alphaolomi/biller/actions/workflows/tests.yml)
[![PHPStan Static Analysis](https://github.com/alphaolomi/biller/actions/workflows/phpstan.yml/badge.svg)](https://github.com/alphaolomi/biller/actions/workflows/phpstan.yml)

House Billing Manager is a simple API for managing bills and attachments in houses/properties. It provides endpoints for creating and managing user accounts, houses, bills, and attachments. The API is built with [Laravel 11](https://laravel.com/docs/11.x/).

## Get started

### Prerequisites

-   [PHP](https://www.php.net/) 8.2 or higher
-   [Composer](https://getcomposer.org/)
-   [Node.js](https://nodejs.org/) (optional)

### Installation

1. Clone the repository and navigate to the project root directory.

```bash
git clone
cd biller
```

2. Install PHP dependencies.

```bash
composer install
```

3. Create a new `.env` file by copying the example file.

```bash
cp .env.example .env
```

4. Generate a new application key.

```bash
php artisan key:generate
```

5. Create an SQLite database file.

```bash
touch database/database.sqlite
```

6. Run the database migrations.

```bash
php artisan migrate
```

7. Start the development server.

```bash
php artisan serve
```

8. Visit `http://localhost:8000/api/docs` in your web browser to view the application documentation.

## Feature Listing

Our API provides a comprehensive set of endpoints for managing authentication, user profiles, attachments, houses, and bills. Here's a quick overview of the available features:

### Authentication

-   **Login:** `POST api/auth/login` - Authenticate users and provide access tokens.
-   **Logout:** `POST api/auth/logout` - Log out users from the current session.
-   **Logout From All Devices:** `POST api/auth/logout-all` - Log out users from all sessions across devices.
-   **User Profile:**
    -   View: `GET|HEAD api/auth/profile` - Retrieve the profile of the authenticated user.
    -   Update: `PUT|PATCH api/auth/profile` - Update the profile of the authenticated user.

### Houses

-   **Manage Houses:**
    -   List: `GET|HEAD api/me/houses` - Retrieve all houses associated with the user.
    -   Create: `POST api/me/houses` - Add a new house to the user's account.
    -   View: `GET|HEAD api/me/houses/{house}` - Retrieve details of a specific house.
    -   Update: `PUT|PATCH api/me/houses/{house}` - Update details of a specific house.
    -   Delete: `DELETE api/me/houses/{house}` - Remove a house from the user's account.

### Bills

-   **Manage Bills:**
    -   List: `GET|HEAD api/me/houses/{house}/bills` - Retrieve all bills associated with a house.
    -   Create: `POST api/me/houses/{house}/bills` - Add a new bill to a house.
    -   View: `GET|HEAD api/me/houses/{house}/bills/{bill}` - Retrieve details of a specific bill.
    -   Update: `PUT|PATCH api/me/houses/{house}/bills/{bill}` - Update details of a specific bill.
    -   Delete: `DELETE api/me/houses/{house}/bills/{bill}` - Remove a bill from a house.

### Attachments

-   **Manage Attachments:**
    -   View: `GET|HEAD api/me/attachments/{attachment}` - Retrieve details of a specific attachment.
    -   Update: `PUT|PATCH api/me/attachments/{attachment}` - Update details of a specific attachment.
    -   Delete: `DELETE api/me/attachments/{attachment}` - Remove a specific attachment from the system.
-   **Bill Attachments:**
    -   List: `GET|HEAD api/me/bills/{bill}/attachments` - List all attachments associated with a bill.
    -   Add: `POST api/me/bills/{bill}/attachments` - Attach a new document to a bill.

For more detailed information on each endpoint, including required parameters and possible responses, please refer to our API documentation.

## Testing

![Coverage](https://codecov.io/gh/alphaolomi/biller/graphs/sunburst.svg?token=uJYDVMG4zh)
