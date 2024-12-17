Here is the improved version of your documentation with some fixes for clarity, formatting, and structure:

---

# Rider Location Management System

A Laravel application for managing rider locations and finding the nearest rider to a restaurant.

## Table of Contents

- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)
  - [Store Rider Locations](#store-rider-locations)
  - [Get Nearest Rider](#get-nearest-rider)
- [Contributing](#contributing)
- [License](#license)

## Features

- Store rider locations with timestamps.
- Retrieve the nearest rider to a given restaurant based on geographical coordinates.

## Prerequisites

Before you begin, ensure you have the following installed on your machine:

- PHP (>= 8.0)
- Composer
- Laravel (>= 8.x)
- MySQL or any supported database
- Git

## Installation

Follow these steps to set up the project:

### Clone the Repository

```bash
git clone https://github.com/your-username/your-project-name.git
cd your-project-name
```

### Install Dependencies

Run Composer to install the required PHP dependencies:

```bash
composer install
```

### Set Up Environment Configuration

Copy the `.env.example` file to create your environment configuration file:

```bash
cp .env.example .env
```

Edit the `.env` file to set up your database configuration:

```plaintext
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Generate Application Key

Run the following command to generate an application key:

```bash
php artisan key:generate
```

## Database Setup

Ensure your MySQL server is running and create the database specified in your `.env` file.

### Run Migrations

Run the migrations to create the necessary tables:

```bash
php artisan migrate
```

### Seed the Database

Seed the database with sample data:

```bash
php artisan db:seed
```

### Start the Development Server

Start the Laravel development server:

```bash
php artisan serve
```

Your application will be accessible at [http://localhost:8000](http://localhost:8000).

## API Reference

### 1. Store Rider Locations

**Endpoint:** `POST /api/rider-locations`

**Description:** Store a new rider's location with a timestamp.

**Request Body:**

```json
{
    "rider_id": "string",    // **Required**. Rider's unique ID
    "lat": "decimal",        // **Required**. Latitude of the rider
    "long": "decimal",       // **Required**. Longitude of the rider
    "captured_at": "timestamp" // **Required**. Timestamp when the location was captured
}
```

### 2. Get Nearest Rider

**Endpoint:** `GET /nearest-rider/{restaurant_id}`

**Description:** Retrieve the nearest rider to a specified restaurant based on its geographical coordinates.

**Path Parameter:**

- `restaurant_id`: The ID of the restaurant.

**Response:**

```json
{
    "success": true,
    "nearest_rider": {
        "id": 1,
        "rider_id": "string",
        "lat": 23.7465,
        "long": 90.3760,
        "captured_at": "2024-11-01T00:00:00Z"
    },
    "distance": 1.5  // Distance to the nearest rider in kilometers
}
```

## Contributing

We welcome contributions to this project! If you want to contribute, please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes.
4. Commit your changes (`git commit -am 'Add new feature'`).
5. Push to the branch (`git push origin feature-branch`).
6. Create a new pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

Let me know if you need any further modifications!