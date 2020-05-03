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

2. Add or update an analytic to a property

Request:

`POST /api/property/:id/analytic`
```
{
	"analytic_type_id": 1,
    "value": 100
}
```

Response:
```
{
    "success": true,
    "message": "Property analytic created.",
    "data": {
        "analytic_type_id": 1,
        "value": 100,
        "property_id": 101,
        "updated_at": "2020-05-03T04:55:46.000000Z",
        "created_at": "2020-05-03T04:55:46.000000Z",
        "id": 219
    }
}
```

3. List of property analytics for a property

Request:

`GET /api/property/:id/analytic`

Response:
```
{
    "success": true,
    "message": "List of property analytics.",
    "data": [
        {
            "id": 222,
            "created_at": "2020-05-03T05:30:01.000000Z",
            "updated_at": "2020-05-03T05:30:01.000000Z",
            "property_id": 100,
            "analytic_type_id": 1,
            "value": "2500"
        },
        {
            "id": 218,
            "created_at": "2020-05-03T05:21:57.000000Z",
            "updated_at": "2020-05-03T05:21:57.000000Z",
            "property_id": 100,
            "analytic_type_id": 2,
            "value": "100"
        }
    ]
}
```

4. Summary of all property analytics for given area
where :area is suburb, state or country

Request:

`GET /summary/:area/:name`

Response:
```
{
    "success": true,
    "message": "Property analytics summary for suburb Ryde.",
    "data": [
        {
            "name": "max_Bld_Height_m",
            "units": "m",
            "min": "10.0",
            "max": "34.0",
            "median": "34.0",
            "percent_with_value": 50,
            "percent_without_value": 50
        },
        {
            "name": "min_lot_size_m2",
            "units": "m2",
            "min": "745",
            "max": "939",
            "median": "749",
            "percent_with_value": 30,
            "percent_without_value": 70
        },
        {
            "name": "fsr",
            "units": ":1",
            "min": "2.09",
            "max": "3.41",
            "median": "2.75",
            "percent_with_value": 20,
            "percent_without_value": 80
        }
    ]
}
```
