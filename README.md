## Setup Application
This assessment is working with Docker environment

- clone this application and cd to code root 
- ckeckout to working branch

    - git checkout Dev-kanishka
- create .env file in root , use command

    - cp .env.example .env
- check and update .env  
- run Docker commands

  - docker-compose up -d
- Access Docker container 

    - docker exec -it CONTAINER_ID bash
- Run command inside Docker container 

  - php artisan migrate 
  - php artisan DB:seeds

Postman API document  https://documenter.getpostman.com/view/1191797/UzQuPkiD

