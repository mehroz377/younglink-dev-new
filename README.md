# Installation

You need to have [Docker](https://docs.docker.com) and [Docker Compose](https://docs.docker.com/compose/) installed on your machine.

1. Run `make up`
2. Open http://localhost

# Links

| Service     | Link                  |
|-------------|-----------------------|
| Website     | http://localhost      |
| MailCatcher | http://localhost:1080 |

# Makefile available commands

- `make up`: starts the Docker containers
- `make down`: stops the Docker containers
- `make rebuild`: rebuilds the Docker containers, useful when you or somebody else did some changes to Docker configuration
- `make console {your_command}`: runs `bin/console` command inside Docker, e.g. `make console CMD="doctrine:migrations:diff"`
- `make composer {your_command}`: runs `composer` command inside Docker, e.g. `make composer CMD="require ramsey/uuid"`
- `make yarn {your_command}`: runs `yarn` command inside Docker, e.g. `make yarn CMD="add axios"`


# Do not forget

- [ ] Setup Sentry once on prod
- [ ] Add quality control tool
- [ ] Create JWT keypair (php bin/console lexik:jwt:generate-keypair)
- [ ] Set public/uploads dir to writable

# API obtain token
1. Send POST request to /api/login_check with Content-type "application\json"

```
{
    "username":"api",
    "password":"srSw4ZLSCbCq4DgZ"
}
```

2. obtain token
```
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE3MDQyMjc3NzIsImV4cCI6MTcwNDIzMTM3Miwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoiYXBpIn0.bHdJZcz7EdelDDvd4aHg1ZR_zfMHGUgfpTTknx0lNE54iaLenb1_gO6wTU52h3YlYo9wDbJXqKQp2wT7VhiK2GDm19EiqM60tMXif0mSpwvE2QBjuNZ9S_MGxtRIt_qg1uR-JI0Qw5tBkh6bBOCfejwQGyy2SnoaVoZ1SsxrublIX6ykYgpJhDcfEltwORNoMpsFs-IGq2ltQOIz2HOCAkbN6gMV7bRwGpfkiy97DCc5msbzZA536UI2O_bBjoj8O3oQuVrahQTK74Zgqpl_MJEjr1VQxv_iZcmEpFOIqw6xJZLqHZfQKLF6CXpywZN3ktyvIAxyLRQdzHuIhszg6Q"
}
```

3. use it as Bearer token to authorize api requests
