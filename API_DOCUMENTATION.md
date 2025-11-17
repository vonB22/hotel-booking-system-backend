# API Documentation

## Overview
This project includes a comprehensive RESTful API alongside the traditional web interface. The API uses **Laravel Sanctum** for secure, token-based authentication and follows REST principles for all endpoints.

**Base URL:** `http://localhost:8000/api`

**API Version:** 1.0  
**Framework:** Laravel 12  
**Authentication:** Sanctum Tokens (Bearer Token)  
**Format:** JSON

---

## Table of Contents
1. [Authentication & Authorization](#authentication--authorization)
2. [Dependencies & Middleware](#dependencies--middleware)
3. [API Endpoints](#api-endpoints)
   - [Hotel Endpoints](#hotel-endpoints)
   - [Booking Endpoints](#booking-endpoints)
   - [User Endpoints](#user-endpoints)
4. [Response Formats](#response-formats)
5. [Error Handling](#error-handling)
6. [Status Codes](#http-status-codes)

---

## Architecture

### Web Routes (`routes/web.php`)
- Traditional Laravel MVC routes
- Session-based authentication
- HTML/Blade template responses
- Controllers: `app/Http/Controllers/`

### API Routes (`routes/api.php`)
- RESTful JSON endpoints
- Sanctum token authentication
- JSON responses
- Controllers: `app/Http/Controllers/Api/`

## Authentication

### Web Authentication
- Uses Laravel's built-in session authentication
- Login via `/login`

### API Authentication
- Uses Sanctum tokens
- Generate token: POST to `/login` endpoint or via artisan
- Send token in header: `Authorization: Bearer {token}`

---

## Authentication & Authorization

### Overview
The API implements two authentication mechanisms:
1. **Session-Based** (Web): For traditional web interface
2. **Token-Based** (API): For frontend apps and external integrations

### API Authentication Flow

```
┌─────────────────────────────────────────────────────────┐
│              API Authentication Flow                    │
└─────────────────────────────────────────────────────────┘

Step 1: Generate Token
  User (via Tinker or Login Endpoint)
    ↓
  User Model: createToken('name')
    ↓
  Sanctum creates entry in personal_access_tokens table
    ↓
  Returns: plainTextToken (e.g., "1|abc123...")


Step 2: Store Token Client-Side
  Frontend (React, Mobile, etc.)
    ↓
  localStorage.setItem('api_token', token)


Step 3: Send with Each Request
  Client sends:
    Authorization: Bearer 1|abc123...
    Content-Type: application/json
    Accept: application/json
    

Step 4: Server Validates
  Sanctum Middleware
    ↓
  Checks personal_access_tokens table
    ↓
  Validates token exists and is not expired
    ↓
  Authenticates request
    ↓
  Route Handler executes
```

### Authorization Strategy

**Role-Based Access Control (RBAC)**
- Uses Spatie Laravel-Permission package
- Admins: Full access to all endpoints
- Regular Users: Can only view own bookings, can't modify hotels

**Endpoint Authorization Levels:**

| Level             | Access                  | Who             |
|-------------------|-------------------------|-----------------|
| **Public**        | No token required       | Anyone          |
| **Authenticated** | Valid token required    | Logged-in users |
| **Admin Only**    | Token + Admin role      | Admin users     |
| **Owner Only**    | Token + Ownership check | Resource owner  |

### Token Generation

#### Method 1: Using PHP Artisan Tinker (Development)
```bash
php artisan tinker
```
```php
$user = App\Models\User::find(1);
$token = $user->createToken('API Token')->plainTextToken;
echo $token;
// Output: 1|aBcDeFgHiJkLmNoPqRsTuVwXyZ...
```

#### Method 2: Login Endpoint (Production - If Implemented)
```bash
POST /api/login
```
```json
{
  "email": "user@example.com",
  "password": "password"
}
```

### Token Format
- **Format:** `ID|HASH`
- **Example:** `1|aBcDeFgHiJkLmNoPqRsTuVwXyZ1234567890`
- **ID:** User ID from personal_access_tokens table
- **HASH:** Hashed token for security

### Token Expiration
- **Default:** Never expires (configured in `config/sanctum.php`)
- **Customizable:** Set `SANCTUM_EXPIRATION` in `.env`

### Using the Token

#### In cURL
```bash
curl -X GET http://localhost:8000/api/user \
  -H "Authorization: Bearer 1|YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

#### In JavaScript/React
```javascript
const token = localStorage.getItem('api_token');

fetch('http://localhost:8000/api/bookings', {
  method: 'GET',
  headers: {
    'Authorization': `Bearer ${token}`,
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  }
})
.then(response => response.json())
.then(data => console.log(data));
```

#### In Python
```python
import requests

token = "1|YOUR_TOKEN_HERE"
headers = {
    'Authorization': f'Bearer {token}',
    'Accept': 'application/json'
}

response = requests.get(
    'http://localhost:8000/api/bookings',
    headers=headers
)
print(response.json())
```

---

## Dependencies & Middleware

### Security Dependencies

| Dependency                    | Version | Purpose                        | Location                           |
|-------------------------------|---------|--------------------------------|------------------------------------|
| **laravel/sanctum**           | ^4.2    | Token-based API authentication | `vendor/laravel/sanctum`           |
| **spatie/laravel-permission** | ^6.21   | Role and permission management | `vendor/spatie/laravel-permission` |
| **laravel/framework**         | ^12.0   | Core Laravel framework         | `vendor/laravel/framework`         |

### Middleware Stack

#### Global Middleware (Applied to All Requests)
Located in `bootstrap/app.php`:
- `Illuminate\Middleware\TrustHosts`
- `Illuminate\Http\Middleware\HandleCors`
- `Illuminate\Middleware\PreventRequestsDuringMaintenance`
- `Illuminate\Foundation\Http\Middleware\ValidatePostSize`
- `Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull`

#### API Middleware (Applied to API Routes)
Located in `routes/api.php`:

| Middleware      | Purpose                 | Applied To          |
|-----------------|-------------------------|---------------------|
| `auth:sanctum`  | Validates API token     | Protected endpoints |
| `permission:*`  | Checks user permissions | Resource endpoints  |
| `throttle:60,1` | Rate limiting (default) | All endpoints       |

#### Route Groups

**Public Routes** (No middleware):
```php
Route::get('/hotels', [HotelController::class, 'index']);
Route::get('/hotels/{hotel}', [HotelController::class, 'show']);
```

**Protected Routes** (Auth required):
```php
Route::middleware('auth:sanctum')->group(function () {
    // All protected endpoints
});
```

### CSRF Protection
- **Web routes:** CSRF tokens required
- **API routes:** CSRF validation handled by Sanctum
- **Token Validation:** Automatic via `VerifyCsrfToken` middleware

### Rate Limiting
- **Default:** 60 requests per minute per IP
- **Configurable:** In `config/throttle.php` or route definitions
- **Custom Example:**
```php
Route::middleware('throttle:10,1')->group(function () {
    // Limited to 10 requests per minute
});
```

---

## API Endpoints

### Hotel Endpoints

#### 1. List All Hotels

**Endpoint Name:** Get Hotels  
**Method:** `GET`  
**URL:** `/api/hotels`  
**Authentication:** Not required  
**Authorization:** Public access

**Description:**
Retrieves a paginated list of all available hotels. Supports pagination via query parameters.

**Header Requirements:**
```
Accept: application/json
Content-Type: application/json
```

**Query Parameters:**
| Parameter  | Type    | Default | Description    |
|------------|---------|---------|----------------|
| `per_page` | integer | 15      | Items per page |
| `page`     | integer | 1       | Page number    |

**Sample Request:**
```bash
curl -X GET "http://localhost:8000/api/hotels?per_page=10&page=1" \
  -H "Accept: application/json"
```

**Sample Response (200 OK):**
```json
{
  "success": true,
  "message": "Hotels retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "Paradise Hotel",
      "detail": "Luxury beachfront resort",
      "price": 250.50,
      "location": "Maldives",
      "rating": 5,
      "rooms": 100,
      "amenities": "WiFi,Pool,Restaurant",
      "created_at": "2025-11-15T10:30:00Z",
      "updated_at": "2025-11-15T10:30:00Z"
    },
    {
      "id": 2,
      "name": "Mountain View Inn",
      "detail": "Cozy mountain retreat",
      "price": 120.00,
      "location": "Colorado",
      "rating": 4,
      "rooms": 50,
      "amenities": "WiFi,Hiking,Restaurant",
      "created_at": "2025-11-15T10:30:00Z",
      "updated_at": "2025-11-15T10:30:00Z"
    }
  ],
  "pagination": {
    "current_page": 1,
    "per_page": 10,
    "total": 8,
    "last_page": 1
  }
}
```

**Error Responses:**

*500 Internal Server Error:*
```json
{
  "success": false,
  "message": "Failed to retrieve hotels",
  "error": "Database connection error"
}
```

---

#### 2. Get Single Hotel

**Endpoint Name:** Get Hotel Details  
**Method:** `GET`  
**URL:** `/api/hotels/{hotel}`  
**Authentication:** Not required  
**Authorization:** Public access

**Description:**
Retrieves detailed information about a specific hotel by ID.

**Header Requirements:**
```
Accept: application/json
```

**URL Parameters:**
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `hotel` | integer | Yes | Hotel ID |

**Sample Request:**
```bash
curl -X GET http://localhost:8000/api/hotels/1 \
  -H "Accept: application/json"
```

**Sample Response (200 OK):**
```json
{
  "success": true,
  "message": "Hotel retrieved successfully",
  "data": {
    "id": 1,
    "name": "Paradise Hotel",
    "detail": "Luxury beachfront resort with world-class amenities",
    "price": 250.50,
    "location": "Maldives",
    "rating": 5,
    "rooms": 100,
    "amenities": "WiFi,Pool,Restaurant,SPA,Parking",
    "created_at": "2025-11-15T10:30:00Z",
    "updated_at": "2025-11-15T10:30:00Z"
  }
}
```

**Error Responses:**

*404 Not Found:*
```json
{
  "success": false,
  "message": "Hotel not found"
}
```

*500 Internal Server Error:*
```json
{
  "success": false,
  "message": "Failed to retrieve hotel",
  "error": "Database error details"
}
```

---

#### 3. Create Hotel

**Endpoint Name:** Create New Hotel  
**Method:** `POST`  
**URL:** `/api/hotels`  
**Authentication:** Required  
**Authorization:** `hotel-create` permission required

**Description:**
Creates a new hotel. Requires valid API token and appropriate permissions.

**Header Requirements:**
```
Authorization: Bearer {YOUR_TOKEN}
Accept: application/json
Content-Type: application/json
```

**Request Body:**
| Field       | Type    | Required | Validation    | Description          |
|-------------|---------|----------|---------------|----------------------|
| `name`      | string  | Yes      | Max 255 chars | Hotel name           |
| `detail`    | string  | Yes      | -             | Detailed description |
| `price`     | decimal | No       | Min 0         | Price per night      |
| `location`  | string  | No       | Max 255 chars | Hotel location       |
| `rating`    | integer | No       | 0-5           | Star rating          |
| `rooms`     | integer | No       | Min 0         | Number of rooms      |
| `amenities` | array   | No       | -             | Array of amenities   |

**Sample Request:**
```bash
curl -X POST http://localhost:8000/api/hotels \
  -H "Authorization: Bearer 1|YOUR_TOKEN_HERE" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Grand Hotel",
    "detail": "Luxury 5-star hotel in downtown",
    "price": 350.00,
    "location": "Downtown",
    "rating": 5,
    "rooms": 150,
    "amenities": ["WiFi", "Parking", "Restaurant", "SPA", "Pool"]
  }'
```

**Sample Response (201 Created):**
```json
{
  "success": true,
  "message": "Hotel created successfully",
  "data": {
    "id": 9,
    "name": "Grand Hotel",
    "detail": "Luxury 5-star hotel in downtown",
    "price": 350.00,
    "location": "Downtown",
    "rating": 5,
    "rooms": 150,
    "amenities": "WiFi,Parking,Restaurant,SPA,Pool",
    "created_at": "2025-11-17T14:22:00Z",
    "updated_at": "2025-11-17T14:22:00Z"
  }
}
```

**Error Responses:**

*401 Unauthorized (No Token):*
```json
{
  "success": false,
  "message": "Unauthenticated"
}
```

*403 Forbidden (No Permission):*
```json
{
  "success": false,
  "message": "Unauthorized"
}
```

*422 Validation Error:*
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "name": ["The name field is required"],
    "detail": ["The detail field is required"],
    "price": ["The price must be a number"]
  }
}
```

*500 Server Error:*
```json
{
  "success": false,
  "message": "Failed to create hotel",
  "error": "Database error details"
}
```

---

#### 4. Update Hotel

**Endpoint Name:** Update Hotel  
**Method:** `PUT`  
**URL:** `/api/hotels/{hotel}`  
**Authentication:** Required  
**Authorization:** `hotel-edit` permission required

**Description:**
Updates an existing hotel's information. All fields are required in the request body.

**Header Requirements:**
```
Authorization: Bearer {YOUR_TOKEN}
Accept: application/json
Content-Type: application/json
```

**URL Parameters:**
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `hotel` | integer | Yes | Hotel ID to update |

**Request Body:** (Same as Create Hotel)

**Sample Request:**
```bash
curl -X PUT http://localhost:8000/api/hotels/1 \
  -H "Authorization: Bearer 1|YOUR_TOKEN_HERE" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Paradise Hotel Updated",
    "detail": "Luxury beachfront resort with upgraded amenities",
    "price": 300.00,
    "location": "Maldives North",
    "rating": 5,
    "rooms": 120,
    "amenities": ["WiFi", "Pool", "Restaurant", "SPA", "Parking", "Gym"]
  }'
```

**Sample Response (200 OK):**
```json
{
  "success": true,
  "message": "Hotel updated successfully",
  "data": {
    "id": 1,
    "name": "Paradise Hotel Updated",
    "detail": "Luxury beachfront resort with upgraded amenities",
    "price": 300.00,
    "location": "Maldives North",
    "rating": 5,
    "rooms": 120,
    "amenities": "WiFi,Pool,Restaurant,SPA,Parking,Gym",
    "created_at": "2025-11-15T10:30:00Z",
    "updated_at": "2025-11-17T14:25:00Z"
  }
}
```

**Error Responses:** (Same as Create Hotel + 404)

*404 Not Found:*
```json
{
  "success": false,
  "message": "Hotel not found"
}
```

---

#### 5. Delete Hotel

**Endpoint Name:** Delete Hotel  
**Method:** `DELETE`  
**URL:** `/api/hotels/{hotel}`  
**Authentication:** Required 
**Authorization:** `hotel-delete` permission required

**Description:**
Deletes a hotel permanently from the system. This action cannot be undone.

**Header Requirements:**
```
Authorization: Bearer {YOUR_TOKEN}
Accept: application/json
```

**URL Parameters:**
| Parameter | Type    | Required | Description        |
|-----------|---------|----------|--------------------|
| `hotel`   | integer | Yes      | Hotel ID to delete |

**Sample Request:**
```bash
curl -X DELETE http://localhost:8000/api/hotels/1 \
  -H "Authorization: Bearer 1|YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

**Sample Response (200 OK):**
```json
{
  "success": true,
  "message": "Hotel deleted successfully"
}
```

**Error Responses:**

*401 Unauthorized:*
```json
{
  "success": false,
  "message": "Unauthenticated"
}
```

*403 Forbidden:*
```json
{
  "success": false,
  "message": "Unauthorized"
}
```

*404 Not Found:*
```json
{
  "success": false,
  "message": "Hotel not found"
}
```

*500 Server Error:*
```json
{
  "success": false,
  "message": "Failed to delete hotel",
  "error": "Database error details"
}
```

---

### Booking Endpoints

#### 6. List User's Bookings

**Endpoint Name:** Get Bookings  
**Method:** `GET`  
**URL:** `/api/bookings`  
**Authentication:** Required  
**Authorization:** Authenticated user

**Description:**
Retrieves bookings for the authenticated user. Admins see all bookings, regular users see only their own.

**Header Requirements:**
```
Authorization: Bearer {YOUR_TOKEN}
Accept: application/json
```

**Query Parameters:**
| Parameter  | Type    | Default | Description    |
|------------|---------|---------|----------------|
| `per_page` | integer | 15      | Items per page |
| `page`     | integer | 1       | Page number    |

**Sample Request:**
```bash
curl -X GET "http://localhost:8000/api/bookings?per_page=10" \
  -H "Authorization: Bearer 1|YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

**Sample Response (200 OK):**
```json
{
  "success": true,
  "message": "Bookings retrieved successfully",
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "product_id": 1,
      "check_in": "2025-12-01",
      "check_out": "2025-12-05",
      "guests": 2,
      "total_price": 1250.00,
      "status": "pending",
      "notes": "Special request: Ocean view room",
      "created_at": "2025-11-17T10:15:00Z",
      "updated_at": "2025-11-17T10:15:00Z"
    }
  ],
  "pagination": {
    "current_page": 1,
    "per_page": 10,
    "total": 1,
    "last_page": 1
  }
}
```

**Error Responses:**

*401 Unauthorized:*
```json
{
  "success": false,
  "message": "Unauthenticated"
}
```

*500 Server Error:*
```json
{
  "success": false,
  "message": "Failed to retrieve bookings",
  "error": "Database error details"
}
```

---

#### 7. Create Booking

**Endpoint Name:** Create Booking  
**Method:** `POST`  
**URL:** `/api/bookings`  
**Authentication:** Required  
**Authorization:** Authenticated user

**Description:**
Creates a new booking for the authenticated user. Automatically associates booking with current user.

**Header Requirements:**
```
Authorization: Bearer {YOUR_TOKEN}
Accept: application/json
Content-Type: application/json
```

**Request Body:**
| Field          | Type    | Required | Validation         | Description                             |
|----------------|---------|----------|--------------------|-----------------------------------------|
| `product_id`   | integer | No       | exists:products,id | Hotel ID                                |
| `product_name` | string  | No       | Max 255            | Hotel name (if product_id not provided) |
| `check_in`     | date    | Yes      | YYYY-MM-DD format  | Check-in date                           |
| `check_out`    | date    | Yes      | After check_in     | Check-out date                          |
| `guests`       | integer | Yes      | Min 1              | Number of guests                        |
| `price`        | decimal | No       | Min 0              | Price per night                         |
| `notes`        | string  | No       | -                  | Special requests                        |

**Sample Request:**
```bash
curl -X POST http://localhost:8000/api/bookings \
  -H "Authorization: Bearer 1|YOUR_TOKEN_HERE" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "product_id": 1,
    "check_in": "2025-12-10",
    "check_out": "2025-12-15",
    "guests": 3,
    "price": 250.00,
    "notes": "We prefer a high floor with a city view"
  }'
```

**Sample Response (201 Created):**
```json
{
  "success": true,
  "message": "Booking created successfully",
  "data": {
    "id": 2,
    "user_id": 1,
    "product_id": 1,
    "check_in": "2025-12-10",
    "check_out": "2025-12-15",
    "guests": 3,
    "total_price": 1250.00,
    "status": "pending",
    "notes": "We prefer a high floor with a city view",
    "created_at": "2025-11-17T14:30:00Z",
    "updated_at": "2025-11-17T14:30:00Z"
  }
}
```

**Error Responses:**

*401 Unauthorized:*
```json
{
  "success": false,
  "message": "Unauthenticated"
}
```

*422 Validation Error:*
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "check_in": ["The check in field is required"],
    "check_out": ["The check out must be a date after check in"],
    "guests": ["The guests must be at least 1"]
  }
}
```

*500 Server Error:*
```json
{
  "success": false,
  "message": "Failed to create booking",
  "error": "Database error details"
}
```

---

#### 8. Get Booking Details

**Endpoint Name:** Get Booking  
**Method:** `GET`  
**URL:** `/api/bookings/{booking}`  
**Authentication:** Required 
**Authorization:** Authenticated user (must own booking or be admin)

**Description:**
Retrieves detailed information about a specific booking. Users can only view their own bookings unless they're admins.

**Header Requirements:**
```
Authorization: Bearer {YOUR_TOKEN}
Accept: application/json
```

**URL Parameters:**
| Parameter | Type    | Required | Description |
|-----------|---------|----------|-------------|
| `booking` | integer | Yes      | Booking ID  |

**Sample Request:**
```bash
curl -X GET http://localhost:8000/api/bookings/1 \
  -H "Authorization: Bearer 1|YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

**Sample Response (200 OK):**
```json
{
  "success": true,
  "message": "Booking retrieved successfully",
  "data": {
    "id": 1,
    "user_id": 1,
    "product_id": 1,
    "check_in": "2025-12-01",
    "check_out": "2025-12-05",
    "guests": 2,
    "total_price": 1250.00,
    "status": "confirmed",
    "notes": "Special request: Ocean view room",
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    },
    "product": {
      "id": 1,
      "name": "Paradise Hotel"
    },
    "created_at": "2025-11-17T10:15:00Z",
    "updated_at": "2025-11-17T10:15:00Z"
  }
}
```

**Error Responses:**

*401 Unauthorized:*
```json
{
  "success": false,
  "message": "Unauthenticated"
}
```

*403 Forbidden:*
```json
{
  "success": false,
  "message": "Unauthorized"
}
```

*404 Not Found:*
```json
{
  "success": false,
  "message": "Booking not found"
}
```

---

#### 9. Update Booking

**Endpoint Name:** Update Booking  
**Method:** `PUT`  
**URL:** `/api/bookings/{booking}`  
**Authentication:** Required 
**Authorization:** Authenticated user (must own booking or be admin)

**Description:**
Updates booking details. Users can only update their own bookings.

**Header Requirements:**
```
Authorization: Bearer {YOUR_TOKEN}
Accept: application/json
Content-Type: application/json
```

**URL Parameters:**
| Parameter | Type    | Required | Description |
|-----------|---------|----------|-------------|
| `booking` | integer | Yes      | Booking ID  |

**Request Body:**
| Field        | Type    | Required | Validation                    |
|--------------|---------|----------|-------------------------------|
| `product_id` | integer | No       | exists:products,id            |
| `check_in`   | date    | Yes      | YYYY-MM-DD format             |
| `check_out`  | date    | Yes      | After check_in                |
| `guests`     | integer | Yes      | Min 1                         |
| `notes`      | string  | No       | -                             |
| `status`     | string  | No       | pending\|confirmed\|cancelled |

**Sample Request:**
```bash
curl -X PUT http://localhost:8000/api/bookings/1 \
  -H "Authorization: Bearer 1|YOUR_TOKEN_HERE" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "product_id": 1,
    "check_in": "2025-12-02",
    "check_out": "2025-12-06",
    "guests": 3,
    "notes": "Updated request: Need connecting rooms"
  }'
```

**Sample Response (200 OK):**
```json
{
  "success": true,
  "message": "Booking updated successfully",
  "data": {
    "id": 1,
    "user_id": 1,
    "product_id": 1,
    "check_in": "2025-12-02",
    "check_out": "2025-12-06",
    "guests": 3,
    "total_price": 1000.00,
    "status": "pending",
    "notes": "Updated request: Need connecting rooms",
    "created_at": "2025-11-17T10:15:00Z",
    "updated_at": "2025-11-17T14:40:00Z"
  }
}
```

**Error Responses:** (Same as Get Booking + 422 Validation Error)

---

#### 10. Delete Booking

**Endpoint Name:** Delete Booking  
**Method:** `DELETE`  
**URL:** `/api/bookings/{booking}`  
**Authentication:** Required 
**Authorization:** Authenticated user (must own booking or be admin)

**Description:**
Deletes a booking. Users can only delete their own bookings.

**Header Requirements:**
```
Authorization: Bearer {YOUR_TOKEN}
Accept: application/json
```

**URL Parameters:**
| Parameter | Type    | Required | Description |
|-----------|---------|----------|-------------|
| `booking` | integer | Yes      | Booking ID  |

**Sample Request:**
```bash
curl -X DELETE http://localhost:8000/api/bookings/1 \
  -H "Authorization: Bearer 1|YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

**Sample Response (200 OK):**
```json
{
  "success": true,
  "message": "Booking deleted successfully"
}
```

**Error Responses:** (Same as Get Booking)

---

#### 11. Cancel Booking

**Endpoint Name:** Cancel Booking  
**Method:** `PATCH`  
**URL:** `/api/bookings/{booking}/cancel`  
**Authentication:** Required 
**Authorization:** Authenticated user (must own booking)

**Description:**
Cancels a booking. Only the booking owner can cancel their booking. Only pending or confirmed bookings can be cancelled.

**Header Requirements:**
```
Authorization: Bearer {YOUR_TOKEN}
Accept: application/json
```

**URL Parameters:**
| Parameter | Type    | Required | Description          |
|-----------|---------|----------|----------------------|
| `booking` | integer | Yes      | Booking ID to cancel |

**Sample Request:**
```bash
curl -X PATCH http://localhost:8000/api/bookings/1/cancel \
  -H "Authorization: Bearer 1|YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

**Sample Response (200 OK):**
```json
{
  "success": true,
  "message": "Booking has been cancelled successfully",
  "data": {
    "id": 1,
    "user_id": 1,
    "product_id": 1,
    "check_in": "2025-12-01",
    "check_out": "2025-12-05",
    "guests": 2,
    "total_price": 1250.00,
    "status": "cancelled",
    "notes": "Special request: Ocean view room",
    "created_at": "2025-11-17T10:15:00Z",
    "updated_at": "2025-11-17T14:45:00Z"
  }
}
```

**Error Responses:**

*400 Bad Request (Already Cancelled):*
```json
{
  "success": false,
  "message": "Booking is already cancelled"
}
```

*403 Forbidden:*
```json
{
  "success": false,
  "message": "Unauthorized"
}
```

*404 Not Found:*
```json
{
  "success": false,
  "message": "Booking not found"
}
```

---

#### 12. Confirm Booking

**Endpoint Name:** Confirm Booking  
**Method:** `PATCH`  
**URL:** `/api/bookings/{booking}/confirm`  
**Authentication:** Required  
**Authorization:** Authenticated user (must own booking)

**Description:**
Confirms a pending booking. Only pending bookings can be confirmed. Only the booking owner can confirm their booking.

**Header Requirements:**
```
Authorization: Bearer {YOUR_TOKEN}
Accept: application/json
```

**URL Parameters:**
| Parameter | Type    | Required | Description           |
|-----------|---------|----------|-----------------------|
| `booking` | integer | Yes      | Booking ID to confirm |

**Sample Request:**
```bash
curl -X PATCH http://localhost:8000/api/bookings/1/confirm \
  -H "Authorization: Bearer 1|YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

**Sample Response (200 OK):**
```json
{
  "success": true,
  "message": "Booking has been confirmed successfully",
  "data": {
    "id": 1,
    "user_id": 1,
    "product_id": 1,
    "check_in": "2025-12-01",
    "check_out": "2025-12-05",
    "guests": 2,
    "total_price": 1250.00,
    "status": "confirmed",
    "notes": "Special request: Ocean view room",
    "created_at": "2025-11-17T10:15:00Z",
    "updated_at": "2025-11-17T14:50:00Z"
  }
}
```

**Error Responses:**

*400 Bad Request (Not Pending):*
```json
{
  "success": false,
  "message": "Only pending bookings can be confirmed"
}
```

*403 Forbidden:*
```json
{
  "success": false,
  "message": "Unauthorized"
}
```

*404 Not Found:*
```json
{
  "success": false,
  "message": "Booking not found"
}
```

---

### User Endpoints

#### 13. Get Current User

**Endpoint Name:** Get Authenticated User  
**Method:** `GET`  
**URL:** `/api/user`  
**Authentication:** Required
**Authorization:** Authenticated user

**Description:**
Returns information about the currently authenticated user based on the provided token.

**Header Requirements:**
```
Authorization: Bearer {YOUR_TOKEN}
Accept: application/json
```

**Sample Request:**
```bash
curl -X GET http://localhost:8000/api/user \
  -H "Authorization: Bearer 1|YOUR_TOKEN_HERE" \
  -H "Accept: application/json"
```

**Sample Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "email_verified_at": "2025-11-15T10:00:00Z",
    "roles": ["user"],
    "permissions": ["view-bookings", "create-bookings"],
    "created_at": "2025-11-15T10:00:00Z",
    "updated_at": "2025-11-15T10:00:00Z"
  }
}
```

**Error Responses:**

*401 Unauthorized (No Token):*
```json
{
  "success": false,
  "message": "Unauthenticated"
}
```

*500 Server Error:*
```json
{
  "success": false,
  "message": "Failed to retrieve user",
  "error": "Error details"
}
```

---

## Response Formats

### Standard Success Response
```json
{
  "success": true,
  "message": "Operation description",
  "data": { /* resource data */ }
}
```

### Paginated Response
```json
{
  "success": true,
  "message": "Items retrieved successfully",
  "data": [ /* array of items */ ],
  "pagination": {
    "current_page": 1,
    "per_page": 15,
    "total": 100,
    "last_page": 7
  }
}
```

### Error Response
```json
{
  "success": false,
  "message": "Error message",
  "error": "Detailed error information"
}
```

### Validation Error Response
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "field_name": ["Error message"],
    "another_field": ["Error 1", "Error 2"]
  }
}
```

---

## Error Handling

### Common Error Scenarios

| Scenario                 | Status | Action                                         |
|--------------------------|--------|------------------------------------------------|
| Invalid token            | 401    | Refresh token or re-authenticate               |
| Missing token            | 401    | Include `Authorization: Bearer {token}` header |
| Expired token            | 401    | Generate new token                             |
| Insufficient permissions | 403    | Contact admin for permission upgrade           |
| Resource not found       | 404    | Verify resource ID                             |
| Validation failed        | 422    | Check field requirements                       |
| Server error             | 500    | Check server logs                              |

### Error Response Structure
```json
{
  "success": false,
  "message": "User-friendly message",
  "error": "Technical error details",
  "errors": {
    "field": ["Field-specific errors"]
  }
}
```

---

## HTTP Status Codes

| Code    | Meaning          | Example Scenario           |
|---------|------------------|----------------------------|
| **200** | OK               | Successful GET, PUT, PATCH |
| **201** | Created          | Successful POST            |
| **400** | Bad Request      | Already cancelled booking  |
| **401** | Unauthorized     | Missing or invalid token   |
| **403** | Forbidden        | Insufficient permissions   |
| **404** | Not Found        | Resource doesn't exist     |
| **422** | Validation Error | Invalid request data       |
| **500** | Server Error     | Database or code error     |

---

## Rate Limiting

- **Default Limit:** 60 requests per minute per IP address
- **Header Response:** `X-RateLimit-Remaining` shows requests left
- **Exceeded:** Returns 429 Too Many Requests

### Example Rate Limited Response:
```
HTTP/1.1 429 Too Many Requests

X-RateLimit-Limit: 60
X-RateLimit-Remaining: 0
X-RateLimit-Reset: 1668962400
```

---

## Request & Response Examples

### Complete Example: Create and Manage a Booking

**Step 1: Get Token**
```bash
php artisan tinker
$user = App\Models\User::find(1);
$token = $user->createToken('My Token')->plainTextToken;
# Output: 1|aBcDeFgHiJkLmNoPqRsTuVwXyZ...
```

**Step 2: Browse Hotels**
```bash
curl -X GET "http://localhost:8000/api/hotels?per_page=5" \
  -H "Accept: application/json"
```

**Step 3: Create Booking**
```bash
curl -X POST http://localhost:8000/api/bookings \
  -H "Authorization: Bearer 1|YOUR_TOKEN" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "product_id": 1,
    "check_in": "2025-12-10",
    "check_out": "2025-12-15",
    "guests": 2,
    "notes": "Window room preferred"
  }'
```

**Step 4: View Your Booking**
```bash
curl -X GET "http://localhost:8000/api/bookings/1" \
  -H "Authorization: Bearer 1|YOUR_TOKEN" \
  -H "Accept: application/json"
```

**Step 5: Confirm Booking**
```bash
curl -X PATCH http://localhost:8000/api/bookings/1/confirm \
  -H "Authorization: Bearer 1|YOUR_TOKEN" \
  -H "Accept: application/json"
```

---

## Best Practices

### DO:
- Always include `Authorization` header with Bearer token
- Validate response `success` field before processing data
- Implement retry logic for 5xx errors
- Store tokens securely (use httpOnly cookies or secure storage)
- Include `Accept: application/json` header
- Use HTTPS in production
- Implement proper error handling

### DON'T:
- Hardcode tokens in code
- Expose tokens in URLs or logs
- Ignore error responses
- Make unnecessary requests
- Cache sensitive data
- Send tokens in query parameters
- Ignore rate limiting

---

## Support & Resources

- **Framework:** Laravel 12 - https://laravel.com/docs
- **Auth:** Sanctum - https://laravel.com/docs/sanctum
- **Permissions:** Spatie - https://spatie.be/docs/laravel-permission
- **Postman Collection:** `Hotel_Booking_API.postman_collection.json`
- **Test Script:** `tests/api-test.php`

---

## Permissions Reference

### Hotel Permissions
- `hotel-list` - View hotels
- `hotel-create` - Create new hotels
- `hotel-edit` - Edit hotels
- `hotel-delete` - Delete hotels

### Booking Permissions
- `manage bookings` - Manage all bookings (admin only)

---

## Notes

- All timestamps are in ISO 8601 format (UTC)
- All dates should be in `YYYY-MM-DD` format
- All monetary values are in decimal format (USD by default)
- Pagination defaults to 15 items per page
- Admins have unrestricted access to all endpoints
- Regular users can only access their own resources
