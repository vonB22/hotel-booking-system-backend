# API Testing Guide

## Quick Start

### 1. Start the Development Server
```bash
cd c:\xampp\htdocs\new-project\Laravel-React\hotel-booking-system-backend
php artisan serve
```
The application will be available at `http://localhost:8000`

### 2. Test Web Routes
Visit in browser:
- **Hotels**: http://localhost:8000/hotels
- **Bookings**: http://localhost:8000/bookings
- **User Bookings**: http://localhost:8000/userbookings

### 3. Generate API Token for Testing

#### Option A: Using Tinker (Interactive)
```bash
php artisan tinker
```

Then execute in Tinker:
```php
$user = App\Models\User::find(1);  // Or use first() if unsure
$token = $user->createToken('API Test Token')->plainTextToken;
echo $token;
```

Copy the token and use it in API requests.

#### Option B: Using Database
Check the `personal_access_tokens` table to see existing tokens.

### 4. Test API Endpoints

#### Test Public Endpoint (No Token Needed)
```bash
curl -X GET http://localhost:8000/api/hotels \
  -H "Accept: application/json"
```

#### Test Protected Endpoint (Token Required)
```bash
curl -X GET http://localhost:8000/api/user \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### 5. Using Postman

1. **Import Collection**
   - Open Postman
   - Click "Import"
   - Select `Hotel_Booking_API.postman_collection.json`

2. **Set Variables**
   - Edit collection
   - Go to "Variables" tab
   - Set `base_url` = `http://localhost:8000`
   - Set `token` = Your generated token

3. **Test Endpoints**
   - Select any endpoint from the collection
   - Click "Send"
   - Check response

## Verify Both Systems Working

### Web System
- [ ] Login at http://localhost:8000/login
- [ ] Access /hotels (web interface)
- [ ] Create, edit, delete a hotel
- [ ] Create a booking
- [ ] View user bookings at /userbookings

### API System
- [ ] GET /api/hotels (public)
- [ ] GET /api/user (with token)
- [ ] POST /api/hotels (create hotel, with token)
- [ ] POST /api/bookings (create booking, with token)
- [ ] PATCH /api/bookings/{id}/cancel
- [ ] PATCH /api/bookings/{id}/confirm

## Common Issues

### Issue: API returns 401 Unauthorized
**Solution**: 
- Make sure you're using the correct token
- Token should be set in `Authorization: Bearer {token}` header
- Check token hasn't expired (tokens don't expire by default in Sanctum, but check your config)

### Issue: API returns 403 Forbidden
**Solution**:
- Check user has required permissions (admin, manage bookings, etc.)
- Check the middleware permissions in the controller

### Issue: API returns 404 Not Found
**Solution**:
- Verify the resource ID exists
- Check the route URL is correct (should start with `/api/`)

### Issue: CORS errors when calling from frontend
**Solution**:
- Install and configure CORS middleware
- Update `.env` with correct API URLs
- Add proper CORS headers in response

## Database Setup for Testing

If you need test data:

```bash
php artisan seed
```

This will:
- Create admin user
- Set up permissions and roles
- Create test hotels if seeders exist

## Architecture Summary

```
┌────────────────────────────────────────────┐
│     Hotel Booking System Backend           │
├────────────────────────────────────────────┤
│                                            │
│  ┌──────────────────────────────────────┐  │
│  │ Web Routes (routes/web.php)          │  │
│  │ → HotelController                    │  │
│  │ → BookingController                  │  │
│  │ Returns: HTML/Blade Views            │  │
│  └──────────────────────────────────────┘  │
│                                            │
│  ┌──────────────────────────────────────┐  │
│  │ API Routes (routes/api.php)          │  │
│  │ → Api\HotelController                │  │
│  │ → Api\BookingController              │  │
│  │ Authentication: Sanctum Tokens       │  │
│  │ Returns: JSON Responses              │  │
│  └──────────────────────────────────────┘  │
│                                            │
│  ┌──────────────────────────────────────┐  │
│  │ Models (Shared)                      │  │
│  │ → User, Hotel, Booking               │  │
│  │ → Permissions (Spatie)               │  │
│  └──────────────────────────────────────┘  │
│                                            │
│  ┌──────────────────────────────────────┐  │
│  │ Database                             │  │
│  │ → MySQL                              │  │
│  │ → Sanctum Personal Access Tokens     │  │
│  └──────────────────────────────────────┘  │
└────────────────────────────────────────────┘
```

## Next Steps

1. **API Documentation**: See `API_DOCUMENTATION.md` for complete endpoint details
2. **Frontend Integration**: Connect your React frontend to API endpoints
3. **Authentication Flow**: Implement token generation in frontend
4. **Error Handling**: Add proper error handling in frontend
5. **Testing**: Create unit tests for controllers
