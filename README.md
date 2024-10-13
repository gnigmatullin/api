## Simple Laravel API with Job Queue, Database, and Event Handling

## Objective 
Simple Laravel API that demonstrates Laravel's job queues, database operations, migrations, and event handling.

## Setup
1. Clone repository:
```bash
git clone https://github.com/gnigmatullin/api.git
```
2. Go to project directory:
```bash
cd api
```
3. Run composer:
```bash
composer install
```
4. Create ENV configuration
```bash
cp .env.example .env
```
5. Update .env with your MySQL database settings
6. Run migrations
```bash
php artisan migrate
```
7. Run local server
```bash
php artisan serve
```

## API Endpoints
1. GET /api
Return all submissions
Request example:
```bash
curl -X GET http://api.test/api
```
Response example:
```json
[
	{
		"id": 1,
		"name": "Name",
		"email": "email@email.com",
		"message": "Message",
		"created_at": "YYYY-mm-ddTH:i:s",
		"updated_at": "YYYY-mm-ddTH:i:s"
	}
]
```

2. POST /api/submit
Create new submission
Request example:
```bash
curl -X POST -d "name=Name&email=email@email.com&message=Message" http://api.test/api/submit
```
Response example:
```json
{
	"status": "success",
	"message": "save submission job added to queue",
	"data": {
		"name": "Name",
		"email": "email@email.com",
		"message": "Message"
	}
}
```

3. PUT /api/update/{id}
Update submission
Request example:
```bash
curl -X POST -d "name=NewName&email=email@email.com&message=NewMessage" http://api.test/api/update/1
```
Response example:
```json
{
	"status": "success",
	"message": "submission updated",
	"data": {
		"name": "NewName",
		"email": "email@email.com",
		"message": "NewMessage"
	}
}
```

4. DELETE /api/delete/{id}
Request example:
```bash
curl -X DELETE http://api.test/api/delete/1
```
```json
{
	"status": "success",
	"message": "submission deleted"
}
```