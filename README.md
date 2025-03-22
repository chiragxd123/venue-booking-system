# Venue Booking System

A **Laravel**-based backend for managing venues, bookings, and availability. This project provides RESTful API endpoints for creating and managing venues, handling bookings (with date conflict checks), and blocking specific dates for venue availability.

## Table of Contents

1. [Overview](#overview)  
2. [Features](#features)  
3. [Requirements](#requirements)  
4. [Installation](#installation)  
5. [Configuration](#configuration)  
6. [Database Migrations & Seeding](#database-migrations--seeding)  
7. [Running the Application](#running-the-application)  
8. [Testing the API](#testing-the-api)  
9. [API Endpoints](#api-endpoints)  
10. [Error Handling & Custom API Exceptions](#error-handling--custom-api-exceptions)  
11. [License](#license)

---

## Overview

This project focuses on **backend** development for a venue booking system. It includes:

- A well-structured database schema in **PostgreSQL** (or any supported DB).  
- RESTful APIs built with **Laravel**.  
- Support for searching venues, making bookings, and managing availability.

**No frontend/UI is required** per the assignment instructions.

---

## Features

- **Venues**: Create, list, update, and delete venue records.
- **Bookings**: Create bookings linked to venues, ensuring no date conflicts.
- **Availability**: Block specific dates to mark a venue as unavailable.
- **Validation & Error Handling**: Consistent JSON error responses.

---

## Requirements

- **PHP** >= 8.1  
- **Composer** (latest version)  
- **Laravel** 10 or 11  
- **PostgreSQL** (or SQLite/MySQL if preferred)  
- **Git**

---

## Installation

```bash
git clone https://github.com/chiragxd123/venue-booking-system.git
cd venue-booking-system
composer install
cp .env.example .env
php artisan key:generate
```

---

## Configuration

Set your database credentials in `.env`. Example:

```env
APP_NAME="Venue Booking System"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=venue_booking_db
DB_USERNAME=venue_user
DB_PASSWORD=your_password
```

---

## Database Migrations & Seeding

```bash
php artisan migrate
php artisan db:seed
```

---

## Running the Application

```bash
php artisan serve
```

---

## Testing the API

- **Manual testing**: Use Postman or similar tool to test API endpoints provided below.

---

## API Endpoints

### Venues

- `GET /api/venues`
- `GET /api/venues/{id}`
- `POST /api/venues`
- `PUT /api/venues/{id}`
- `DELETE /api/venues/{id}`

**Example (Create Venue)**:

**Request**:
```json
{
  "name": "Lotus Garden",
  "location": "Delhi",
  "capacity": 300,
  "description": "Beautiful open-air garden venue.",
  "images": "[\"https://example.com/newhorizon1.jpg\", \"https://example.com/newhorizon2.jpg\"]",
  "price": 25000
}
```

**Response**:
```json
{
    "success": true,
    "data": {
        "name": "Lotus Garden",
        "location": "Delhi",
        "capacity": 300,
        "description": "Beautiful open-air garden venue.",
        "images": "[\"https://example.com/newhorizon1.jpg\", \"https://example.com/newhorizon2.jpg\"]",
        "price": 25000,
        "updated_at": "2025-03-22T08:56:06.000000Z",
        "created_at": "2025-03-22T08:56:06.000000Z",
        "id": 11
    }
}
```

**Example (Search Venues)**:

```bash
GET /api/venues?location=Mumbai&capacity=200
```

---

### Bookings

- `GET /api/bookings`
- `GET /api/bookings/{id}`
- `POST /api/bookings`
- `PUT /api/bookings/{id}`
- `DELETE /api/bookings/{id}`

---

### Availabilities

- `GET /api/availabilities`
- `POST /api/availabilities`
- `DELETE /api/availabilities/{id}`

---

## Error Handling & Custom API Exceptions

- Validation errors: Standard Laravel JSON validation errors (422 status).
- Application-specific errors use `CustomApiException`:

```json
{
  "success": false,
  "error": {
    "code": 404,
    "message": "Venue not found"
  }
}
```

---

## License

[MIT](https://opensource.org/licenses/MIT)
