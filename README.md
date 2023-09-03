# Test Task for SystemeIO
__author:__ @danianmercado

__telegram:__ @danianmercado

__link to resume:__ 
https://spb.hh.ru/resume/f2a4adfcff0b108cb50039ed1f5a306e59495a

__Link to the test:__ 
https://github.com/systemeio/test-for-candidates

## Design Patterns used
 - Factory
 - Adapter
 - Strategy

## MakeFile for launch the container
```
init:
	@make build
	@make up
up:
	docker compose up -d
build:
	docker compose build
remake:
	@make destroy
	@make install
stop:
	docker compose stop
down:
	docker compose down --remove-orphans
down-v:
	docker compose down --remove-orphans --volumes
restart:
	@make down
	@make up
destroy:
	docker compose down --rmi all --volumes --remove-orphans
ps:
	docker compose ps
logs:
	docker compose logs
logs-watch:
	docker compose logs --follow

create-db:
	docker compose run --rm php-cli php bin/console doctrine:database:create

run-migrations:
	docker compose run --rm php-cli php bin/console doctrine:migrations:migrate

run-fixtures:
	docker compose run --rm php-cli php bin/console doctrine:fixtures:load

clear-cache:
	docker compose run --rm php-cli php bin/console cache:clear       
```


## Test Cases "Price calculation"

### All valid data

__Request:__
```json
{
    "product": 3,
    "taxNumber": "DE123456789",
    "couponCode": "D15656"
}
```
__Response:__
```json
{
    "success": true,
    "message": "Total amount of product is 5.95"
}
```

### Product not found
__Request:__
```json
{
    "product": 32,
    "taxNumber": "DE123456789",
    "couponCode": "D15656"
}
```
__Response:__
```json
{
    "error": {
        "product": "The product with id '32' was not found."
    }
}
```

### Tax number not valid
__Request:__
```json
{
    "product": 3,
    "taxNumber": "DE123456789w",
    "couponCode": "D15656"
}
```
__Request:__
```json
{
    "error": {
        "taxNumber": "The tax number format for Germany is incorrect. It should be DE followed by 9 digits."
    }
}
```
### Final price cant be negative
__Request:__
```json
{
    "product": 3,
    "taxNumber": "DE123456789",
    "couponCode": "D15654"
}
```
__Request:__
```json
{
    "error": "Total price value cant be negative"
}
```

### Tax number - country not supported
__Request:__
```json
{
    "product": 3,
    "taxNumber": "AR123456789",
    "couponCode": "D15656"
}
```
__Request:__
```json
{
    "error": {
        "taxNumber": "The country with code AR is not supported by the system."
    }
}
```

### Coupon code already used

__Request:__
```json
{
    "product": 3,
    "taxNumber": "DE123456789",
    "couponCode": "D15655"
}
```
__Request:__
```json
{
    "error": {
        "couponCode": "The coupon with code 'D15655' already was used."
    }
}
```
## Test Cases Pay

### Invalid payment processor
__Request:__
```json
{
    "product": 3,
    "taxNumber": "DE123456789",
    "couponCode": "D15654",
    "paymentProcessor" : "paypals"
}
```
__Request:__
```json
{
    "error": {
        "paymentProcessor": "The value you selected is not a valid choice."
    }
}
```
### Total price cant be negative
__Request:__
```json
{
    "product": 3,
    "taxNumber": "DE123456789",
    "couponCode": "D15654",
    "paymentProcessor" : "paypal"
}
```
__Request:__
```json
{
    "error": "Total price value cant be negative"
}
```

### Payment was processed paypal
__Request:__
```json
{
    "product": 3,
    "taxNumber": "DE123456789",
    "couponCode": "D15656",
    "paymentProcessor" : "paypal"
}
```
__Request:__
```json
{
    "success": true,
    "message": "Payment has been successfully processed."
}
```

### Payment was processed stripe
__Request:__
```json
{
    "product": 3,
    "taxNumber": "DE123456789",
    "couponCode": "D15656",
    "paymentProcessor" : "stripe"
}
```
__Request:__
```json
{
    "success": true,
    "message": "Payment has been successfully processed."
}
```
## Note about the tests
Is my first time creating tests in symfony, i didnt understad how to create correctly the tests and run them, after 4 hours and read about it, i cant run it :(
