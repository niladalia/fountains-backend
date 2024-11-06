# Fountains Backend
<p align="center">
This backend supports a smartphone app that helps users find nearby public fountains. The app is interactive, allowing users to create, edit, comment on, and rate fountain listings, building a community-driven directory. The project is built with Domain-Driven Design (DDD) principles and follows a Hexagonal architecture for flexibility and maintainability.
</p>

## Installation and configuration

### Clone repository

1. Clone this project into a machine with
   Docker installed

       git clone https://github.com/niladalia/fountains-backend.git

2. Move to the project folder:

        cd fountains-backend

### Environment configuration

1. Create a local .env file

       cp .env .env.local && cp .env .env.test
### Project setup

1. Install all dependencies :

        make build

2. Run migrations :

        make run-migrations

3. Access http://localhost:83/api/fountains to check everything is working.

###  Tests

1. Execute Phpunit and Behat tests:

        make run-tests
