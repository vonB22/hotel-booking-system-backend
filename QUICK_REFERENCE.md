# Quick Reference Card

## Start Development
```bash
php artisan serve
```
→ http://localhost:8000

---

## Web Routes (No Token Needed)

| Action       | URL              | Method |
|--------------|------------------|--------|
| List Hotels  | `/hotels`        | GET    |
| Create Hotel | `/hotels/create` | GET    |
| Store Hotel  | `/hotels`        | POST   |
| View Hotel   | `/hotels/1`      | GET    |
| Edit Hotel   | `/hotels/1/edit` | GET    |
| Update Hotel | `/hotels/1`      | PUT    |
| Delete Hotel | `/hotels/1`      | DELETE |

---

## API Routes (Need Token for Protected)

### Hotels (Public - No Token)
```
GET    /api/hotels              → List all hotels
GET    /api/hotels/1            → Get single hotel
```

### Hotels (Protected - Need Token)
```
POST   /api/hotels              → Create hotel
PUT    /api/hotels/1            → Update hotel
DELETE /api/hotels/1            → Delete hotel
```

### Bookings (Protected - Need Token)
```
GET    /api/bookings            → List user's bookings
POST   /api/bookings            → Create booking
GET    /api/bookings/1          → Get booking details
PUT    /api/bookings/1          → Update booking
DELETE /api/bookings/1          → Delete booking
PATCH  /api/bookings/1/cancel   → Cancel booking
PATCH  /api/bookings/1/confirm  → Confirm booking
```

### User (Protected - Need Token)
```
GET    /api/user                → Get current user
```

---

## Generate API Token

```bash
php artisan tinker
```

```php
$user = App\Models\User::find(1);
$token = $user->createToken('Token Name')->plainTextToken;
echo $token;
```

---

## Test API Endpoint

```bash
# Public (no token)
curl http://localhost:8000/api/hotels \
  -H "Accept: application/json"

# Protected (with token)
curl http://localhost:8000/api/user \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

---

## Key Files

| File                                             | Purpose                    |
|--------------------------------------------------|----------------------------|
| `routes/web.php`                                 | Web routes (existing)      |
| `routes/api.php`                                 | API routes (new)           |
| `app/Http/Controllers/HotelController.php`       | Web hotel controller       |
| `app/Http/Controllers/Api/HotelController.php`   | API hotel controller       |
| `bootstrap/app.php`                              | Bootstrap config (updated) |
| `config/sanctum.php`                             | Sanctum config (new)       |

---

## Test Files

| File     | Command                                            |
|----------|----------------------------------------------------|
| Postman  | Import `Hotel_Booking_API.postman_collection.json` |
| PHP Test | `php tests/api-test.php`                           |

---

## Response Format

### Success
```json
{
  "success": true,
  "message": "Operation successful",
  "data": { }
}
```

### With Pagination
```json
{
  "success": true,
  "message": "Retrieved",
  "data": [ ],
  "pagination": {
    "current_page": 1,
    "per_page": 15,
    "total": 50,
    "last_page": 4
  }
}
```

### Error
```json
{
  "success": false,
  "message": "Error message",
  "error": "Details"
}
```

---

## Common Status Codes

| Code | Meaning                   |
|------|---------------------------|
| 200  | Success                   |
| 201  | Created                   |
| 400  | Bad Request               |
| 401  | Unauthorized (no token)   |
| 403  | Forbidden (no permission) |
| 404  | Not Found                 |
| 422  | Validation Error          |
| 500  | Server Error              |

---

## Postman Setup

1. Import: `Hotel_Booking_API.postman_collection.json`
2. Set variable: `base_url` = `http://localhost:8000`
3. Generate token (see above)
4. Set variable: `token` = Your token
5. Send requests

---

## React Integration Example

```javascript
// Get token (from login or stored)
const token = localStorage.getItem('api_token');

// Get hotels
fetch('http://localhost:8000/api/hotels')
  .then(r => r.json())
  .then(data => console.log(data.data))

// Create booking
fetch('http://localhost:8000/api/bookings', {
  method: 'POST',
  headers: {
    'Authorization': `Bearer ${token}`,
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    product_id: 1,
    check_in: '2025-12-01',
    check_out: '2025-12-05',
    guests: 2
  })
})
  .then(r => r.json())
  .then(data => console.log(data.data))
```

---

## Both Systems Working?

**Web Interface** - Test at http://localhost:8000/hotels
**API Interface** - Test with `php tests/api-test.php`
**Separate Controllers** - Web vs. Api folder
**Token Authentication** - Generate with tinker
**Documentation** - See `API_DOCUMENTATION.md`

All set!