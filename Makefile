.SHELLFLAGS = -Command
SHELL = powershell.exe

.PHONY: up down reset sh logs install migrate test artisan

up:
	docker compose up -d --build

down:
	docker compose down

reset:
	docker compose down -v
	if (Test-Path "vendor") { Remove-Item -Recurse -Force vendor }
	if (Test-Path "node_modules") { Remove-Item -Recurse -Force node_modules }
	if (Test-Path "bootstrap/cache") { Get-ChildItem "bootstrap/cache/*.php" -ErrorAction SilentlyContinue | Remove-Item -Force }
	if (Test-Path "public/storage") { Remove-Item -Recurse -Force public/storage }
	if (Test-Path ".env") { Remove-Item ".env" }

sh:
	docker compose exec -u www-data app bash

logs:
	docker compose logs -f --tail=100

install:
	if (-not (Test-Path "artisan")) { Write-Host "Instalando Laravel..." -ForegroundColor Green; docker compose run --rm app sh -c "composer create-project laravel/laravel /tmp/laravel; cp -r /tmp/laravel/. /var/www/html/" }
	if (-not (Test-Path ".env")) { Copy-Item ".env.example" ".env"; Write-Host ".env creado." -ForegroundColor Green }
	docker compose run --rm app php artisan key:generate
	docker compose run --rm app php artisan storage:link
	Write-Host "✅ Instalación completada." -ForegroundColor Green

migrate:
	docker compose run --rm app php artisan migrate

test:
	docker compose run --rm app php artisan test -q

artisan:
	docker compose run --rm app php artisan $(CMD)
	
composer:
	docker compose run --rm app composer $(CMD)