## About NEWS API

This is a REST API application for Multiple New API Data source with Sanctum authentication. 
You can interact with it by importing the "News API Postman collection" included in the repo.

# Installation Instructions

## Prerequisites
- Ensure Docker is installed. If Docker is not available, you can run the project using Apache, Nginx, or `php artisan serve` 

## Environment Setup
Change into project directory before running any commands
- `cd /innsbackend`
  
Rename the .env.example file .env
- `cp .env.example .env`
- Update News KEY ENV value

## Setup Methods

### Docker Setup
Start the Docker containers:
- `./vendor/bin/sail up`
  
### Manual Setup
Update the database configuration in the .env file according to your local machine settings.
Install dependencies:
- `composer install`

Generate Key
Run `sail artisan key:generate` or `php artisan key:generate`

## Post Setup

Run database migrations:
- Using Sail: `sail artisan migrate`
- Without Sail: `php artisan migrate`
  

## Postman Collection
Import the provided Postman collection (News API Postman collection) into your Postman application to interact with the API.

## Note for Postman
- base_url: Base URL of the API (e.g., http://localhost/api)
- authToken: Token for authentication (set automatically after login)
- Ensure that the authToken is set in the environment variables in Postman for authenticated requests.
  
## API Endpoints


Description: Checks the status of the API.

Auth 
#### Login: ####
Endpoint `POST {{base_url}}/login`
Body:
```json
{
 "email": "praveen@gmail.com",
 "password": "password"
}
```
Description: Logs in a user and sets a collection variable authToken with the token received.

#### Register: ####
Endpoint: `POST {{base_url}}/register`
Body:
```json
{
 "name": "Praveen",
 "email": "praveen@gmail.com",
 "password": "password",
 "password_confirmation": "password"
}
```
Description: Register as a new user.

#### Logout: ####
Endpoint: `POST {{base_url}}/logout`
Description: Logs out user.

#### User Preference ####
Add or Update
Endpoint: `POST {{base_url}}/user/preference`
```
Body (form-data):
    source: "newsapi"
    category: "Lifestyle"
```
Description: Add or update user Preference setting.

#### Get User Preference ####

Endpoint: `GET {{base_url}}/user/preference`

Description: Retrieves logged in user Preference setting.

#### Get News ####

Endpoint: `GET {{base_url}}/news/search`
```
Query Parameters:
    source: "newsapi"
    keyword: "hair"
    fromDate: "2024-01-24"
    toDate: "2024-12-24"
    category: ""
    page: "1"
	
 ```

Note: Source [source, theguardian, nyt], Optinal key : fromDate, toDate & Category
Description: Retrieves news data from 3 source.