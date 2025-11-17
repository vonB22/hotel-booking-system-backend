# Architecture Diagram

## System Overview

```
┌─────────────────────────────────────────────────────────────────────┐
│                   Hotel Booking System Backend                      │
│                    (Laravel 12 + React Ready)                       │
└─────────────────────────────────────────────────────────────────────┘

                                 │
                ┌────────────────┼────────────────┐
                │                │                │
                ▼                ▼                ▼
        ┌──────────────┐  ┌──────────────┐  ┌──────────────┐
        │ Web Browser  │  │ React App    │  │ Mobile App   │
        │              │  │              │  │              │
        └──────┬───────┘  └──────┬───────┘  └──────┬───────┘
               │                 │                 │
               │ HTML Forms      │ JSON Requests   │ JSON Requests
               │                 │                 │
               ▼                 ▼                 ▼
        ┌──────────────────────────────────────────────────┐
        │         Laravel Routing Layer                    │
        ├──────────────────────────────────────────────────┤
        │  routes/web.php              routes/api.php      │
        │  ├─ /hotels              ├─ /api/hotels          │
        │  ├─ /bookings            ├─ /api/bookings        │
        │  └─ /userbookings        └─ /api/user            │
        └──────────────────────────────────────────────────┘
               │                 │
               │ Session Auth    │ Sanctum Token Auth
               │                 │
       ┌───────▼────────┐   ┌────▼────────────┐
       │   Web Layer    │   │   API Layer     │
       │                │   │                 │
       ├──────────────┐ │   ├──────────────┐  │
       │ HotelCtr     │ │   │ Api\HotelCtr │  │
       │ BookingCtr   │ │   │ Api\BookingCtr  │
       │ (View Return)│ │   │ (JSON Return)│  │
       └────────┬─────┘ │   └────┬─────────┘  │
                │       │        │            │
                └───────┤────┬───┘            │
                        │    │                │
                        ▼    ▼                │
        ┌───────────────────────────────────┐ │
        │  Shared Models & Business Logic   │ │
        │  ├─ User Model                    │ │
        │  ├─ Hotel Model                   │ │
        │  ├─ Booking Model                 │ │
        │  └─ Permission System (Spatie)    │ │
        └─────────────────┬─────────────────┘ │
                          │                   │
                          ▼                   │
                   ┌────────────────┐         │
                   │   Database     │◄────────┘
                   │  (SQLite/MySQL)│
                   │                │
                   ├─ users         │
                   ├─ hotels        │
                   ├─ bookings      │
                   ├─ permissions   │
                   └─ api_tokens    │
                   └────────────────┘
```

## Request Flow Comparison

### Web Request Flow
```
User Browser
    │
    ├─→ GET /hotels
    │
    └─→ Laravel Router (routes/web.php)
        │
        └─→ HotelController@index
            │
            └─→ Query Database
                │
                └─→ Return View (Blade Template)
                    │
                    └─→ HTML Rendered
                        │
                        └─→ Browser Display
```

### API Request Flow
```
React/Mobile App
    │
    ├─→ GET /api/hotels
    │   Header: "Authorization: Bearer {token}"
    │
    └─→ Laravel Router (routes/api.php)
        │
        ├─→ Sanctum Middleware (Validate Token)
        │
        └─→ Api\HotelController@index
            │
            └─→ Query Database
                │
                └─→ Return JSON Response
                    │
                    └─→ Frontend Processes JSON
                        │
                        └─→ UI Updated
```

## File Structure

```
hotel-booking-system-backend/
│
├── app/
│   └── Http/
│       └── Controllers/
│           ├── HotelController.php        ← Web (HTML responses)
│           ├── BookingController.php      ← Web (HTML responses)
│           └── Api/                       ← NEW FOLDER
│               ├── HotelController.php    ← API (JSON responses)
│               └── BookingController.php  ← API (JSON responses)
│
├── routes/
│   ├── web.php                           ← Web Routes (existing)
│   ├── api.php                           ← API Routes (NEW - 14 endpoints)
│   └── console.php
│
├── bootstrap/
│   ├── app.php                           ← UPDATED (added api.php)
│   └── ...
│
├── config/
│   └── sanctum.php                       ← Sanctum Config (NEW)
│
├── database/
│   └── migrations/
│       └── *_create_personal_access_tokens_table.php  ← NEW
│
├── SETUP_COMPLETE.md                     ← NEW
├── QUICK_REFERENCE.md                    ← NEW
├── API_DOCUMENTATION.md                  ← NEW
├── API_TESTING_GUIDE.md                  ← NEW
├── Hotel_Booking_API.postman_collection.json ← UPDATED
│
└── tests/
    └── api-test.php                      ← NEW
```

## Controller Separation

### Web Controllers (HTML/Blade)
```php
// app/Http/Controllers/HotelController.php

public function index(): View
{
    $hotels = Hotel::paginate(5);
    return view('hotels.index', compact('hotels'));
    // ↓ Returns HTML
}

public function store(Request $request): RedirectResponse
{
    Hotel::create($request->validated());
    return redirect()->route('hotels.index')
        ->with('success', 'Created');
    // ↓ Redirects browser
}
```

### API Controllers (JSON)
```php
// app/Http/Controllers/Api/HotelController.php

public function index(Request $request): JsonResponse
{
    $hotels = Hotel::paginate($request->input('per_page', 15));
    return response()->json([
        'success' => true,
        'message' => 'Hotels retrieved',
        'data' => $hotels->items(),
        'pagination' => [...]
    ]);
    // ↓ Returns JSON
}

public function store(Request $request): JsonResponse
{
    $hotel = Hotel::create($request->validated());
    return response()->json([
        'success' => true,
        'data' => $hotel
    ], 201);
    // ↓ Returns JSON with status code
}
```

## Authentication Methods

### Web (Session-Based)
```
1. User submits login form
   POST /login (credentials)

2. Server creates session
   Set-Cookie: XSRF-TOKEN=...
   Set-Cookie: session_id=...

3. User browses authenticated
   Cookie: session_id=... (auto-sent)

4. Server validates session
```

### API (Token-Based)
```
1. Generate token (via Tinker or API)
   $user->createToken('token')->plainTextToken
   → "1|abc123def456..."

2. Client stores token
   localStorage.setItem('token', '1|abc123...')

3. Client sends with each request
   Authorization: Bearer 1|abc123...

4. Server validates token
   Sanctum middleware checks personal_access_tokens table
```

## API Response Examples

### Success Response
```json
{
  "success": true,
  "message": "Hotels retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "Paradise Hotel",
      "price": 250.00,
      ...
    }
  ],
  "pagination": {
    "current_page": 1,
    "per_page": 15,
    "total": 8,
    "last_page": 1
  }
}
```

### Error Response
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "name": ["The name field is required"],
    "price": ["The price must be numeric"]
  }
}
```

## Route Count Summary

| Category | Web | API | Total |
|----------|-----|-----|-------|
| Hotels CRUD | 6 | 5 | 11 |
| Bookings CRUD | 5 | 5 | 10 |
| Special Actions | 1 | 2 | 3 |
| Other | 3 | 1 | 4 |
| **Total** | **15** | **14** | **29** |

## Key Differences

| Aspect | Web | API |
|--------|-----|-----|
| **Request Type** | HTML Form | JSON |
| **Response** | HTML Page | JSON Object |
| **Auth** | Session/Cookie | Token/Header |
| **Redirect** | Yes (to new page) | No (JSON response) |
| **CORS** | N/A | May need CORS |
| **Client** | Browser | Frontend Framework |
| **Stateless** | No (Session) | Yes (Tokens) |

## Technology Stack

```
Frontend Clients
├── Web Browser (HTML/CSS/JS)
├── React App (JSON API)
└── Mobile App (JSON API)

Backend API Layer
├── Laravel 12 Framework
├── Sanctum Token Auth
├── Spatie Permissions
├── Blade Templating (Web)
└── JSON Responses (API)

Data Layer
├── Eloquent ORM
├── Database Migrations
├── Models (User, Hotel, Booking)
└── SQLite/MySQL/PostgreSQL

Infrastructure
├── Apache/Nginx
├── PHP 8.2+
└── Session Storage
```

## Integration Points

```
React Component
    │
    ├─→ Fetch API token (on login)
    │   POST /api/login
    │
    ├─→ Store token (localStorage)
    │
    ├─→ Make authenticated request
    │   GET /api/hotels
    │   Header: Authorization: Bearer {token}
    │
    └─→ Handle response
        ├─→ Success: Update UI
        └─→ Error: Show error message
```

## Deployment Ready

Both web and API working
Separate controllers for maintainability
Token-based authentication secured
Database migrations included
Documentation complete
Test suite available
CORS-ready for frontend frameworks

Ready for production deployment!
