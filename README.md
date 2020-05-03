# Coding challenge for Back-End Software Engineer

## 1. Install composer packages 
```
composer install
```

### 2. Create tables and seed them
```
php artisan migrate --seed
```
### API Endpoints

1. Create a property

Request:

`POST /api/property`
```
{
    "suburb": "Kellyville",
    "state": "NSW",
    "country": "Australia"
}
```

Response:
```
{
    "success": true,
    "message": "Property created.",
    "data": {
        "suburb": "Kellyville",
        "state": "NSW",
        "country": "Australia",
        "updated_at": "2020-05-03T02:57:56.000000Z",
        "created_at": "2020-05-03T02:57:56.000000Z",
        "id": 104
    }
}
```
