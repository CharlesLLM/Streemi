# Streemi

<!-- TODO description -->

## Install project

1. Clone the project:
    
```bash
git clone git@github.com:CharlesLLM/Streemi.git
cd Streemi
```

<!-- TODO : Complete -->

Your project is now set up and ready to go!

- Project: [localhost](http://localhost/)
- PhpMyAdmin: [localhost:8080](http://localhost:8080)
- Mailcatcher: [localhost:1080](http://localhost:1080)

*Make Commands* :

| Command                   | Usage                            |
| ------------------------- | -------------------------------- |
| make start                | Start the project                |
| make stop                 | Stop all containers              |
| make rm                   | Stop and delete all containers   |
| make bash                 | Connect to app container bash    |
| make sh c='bash command'  | Run any bash command             |
| make sf c=' '             | Run any bin/console command      |
| make db                   | Init database with data fixtures |
| make cc                   | Clear cache                      |
| make assets               | Generate assets files (css+js)   |
| make perm                 | Set permissions                  |
| make tf                   | Execute all functional tests     |
| make tf TEST='home.cy.js' | Execute specific test            |
| make vendor               | Install project dependencies     |

## List of users for testing (fixtures)

<!-- TODO : Check if the passwords are correct -->
| Email                       | Password   | Roles                                    |
| --------------------------- | ---------- | ---------------------------------------- |
| `superadmin@mentalworks.fr` | `admin`    | ROLE_SUPER_ADMIN, ROLE_ALLOWED_TO_SWITCH |
| `admin@mentalworks.fr`      | `admin`    | ROLE_ADMIN                               |
| `user{1..9}@mentalworks.fr` | `user`     | ROLE_USER                                |

## Functional tests

For easier testing with Cypress, follow these steps:

```bash
cd e2e
npx cypress open
```

and then run your tests from the Cypress window.

You can also run the tests with `make tf` (or `make tf TEST='<test_path>'`) to run tests in your terminal.
