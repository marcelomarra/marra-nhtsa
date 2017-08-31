[![Build Status](https://travis-ci.org/marcelomarra/marra-nhtsa.svg?branch=master)](https://travis-ci.org/marcelomarra/marra-nhtsa)
[![Code Climate](https://codeclimate.com/github/marcelomarra/marra-nhtsa/badges/gpa.svg)](https://codeclimate.com/github/marcelomarra/marra-nhtsa)
[![Test Coverage](https://codeclimate.com/github/marcelomarra/marra-nhtsa/badges/coverage.svg)](https://codeclimate.com/github/marcelomarra/marra-nhtsa/coverage)
[![Issue Count](https://codeclimate.com/github/marcelomarra/marra-nhtsa/badges/issue_count.svg)](https://codeclimate.com/github/marcelomarra/marra-nhtsa)

# marra-ntsha

## Getting Started

- Fork the repository on GitHub
- Copy the .env.example file to .env
- Run composer install
- Run php artisan key:generate
- To test if its alright, run vendor/bin/phpunit
- To host just run php artisan serve
- To use more simply, use the Postman collection (postman.collections)

## API Docs

- Using composer update-docs you can generate all sorts of API formats using the apiary.apib as source.
- You can use these docs on http://localhost/docs, you can import them on Postman or you can use apiary.io to host it
- To check if the API Docs are up to date with the API Source code, you can run npm install -g dredd and then run dredd. This will begin to test the current docs against the apis.

## Roadmap

- Deploy to Heroku
- Use cache to improve performance
- Add Authorization and Authentication layer (Laravel Passport)
- Dockerfile
- Improve Code Climate 
