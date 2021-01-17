# Genesis 

Your task is to write a simple application server that prints a message at a given time in the future.

The server has only 1 API:
[GET] "/printMeAt" - which receives two parameters, time and message, and writes that message to the server console at the given time.
Since we want the server to be able to withstand restarts it will use Redis to persist the messages and the time they should be sent at.
You should also assume that there might be more than one server running behind a load balancer (load balancing implementation itself does not need to be provided as part of the answer).
In case the server was down when a message should have been printed, it should print it out when going back online.

The focus of the exercise is:
- use only native php api (apart from redis, for it can be used any extension/library)
- server should start from cli and print messages to stdout 
- the efficient use of Redis and its data types
- messages should not be lost
- the same message should be printed only once
- message order should not be changed
- should be scalable
- seeing your code in action (SOLID would be a plus)
- docker would be a plus

Build Step:
1) composer install
2) docker-composer up -d
3) curl --location --request `GET 'http://localhost:80/printMeAt?dateTime=2020-12-22%2008:00:10&message=EXAMPLE'`
4) check message in through `docker logs app`
