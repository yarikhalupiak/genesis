# Genesis 

Step:
1) composer install
2) docker-composer up -d
3) curl --location --request `GET 'http://localhost:80/printMeAt?dateTime=2020-12-22%2008:00:10&message=EXAMPLE'`
4) check message in through `docker logs app`