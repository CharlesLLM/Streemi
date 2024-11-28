# Streemi

<!-- TODO description -->

## Install project

- [Install project](docs/install.md)
- Go to [https://localhost/](https://localhost/)
- Go to [http://localhost:8080](http://localhost:8080) to see the database (username: root, password: root)
- Go to [http://localhost:1080](http://localhost:1080) to see caught emails

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

| Email                       | Password   | Roles                                    |
| --------------------------- | ---------- | ---------------------------------------- |
| `superadmin@mentalworks.fr` | `admin`    | ROLE_SUPER_ADMIN, ROLE_ALLOWED_TO_SWITCH |
| `admin@mentalworks.fr`      | `admin`    | ROLE_ADMIN                               |
| `user{1..9}@mentalworks.fr` | `user`     | ROLE_USER                                |

## Functional tests

For easier testing with Cypress, follow these steps:

1. Add `APP_ENV=test` in your `.env.local` file
2. (if you use the dev server) Run `make tf-assets` to build assets and stop the vite dev server
3. Run `make db` and `make perm` to init a test database and set up permissions
4. Go into the `e2e` folder and install the dependencies with `npm install`
5. (if you don't have Cypress installed) Run `npx cypress install` (or `bunx cypress install` with Bun) to install Cypress
6. Run `npx cypress open` (or `bunx cypress open` with Bun) to open Cypress and run your tests

> [!NOTE]
> Don't forget to change your `.env.local` file back to `APP_ENV=dev` when you're done testing

Alternatively, you can run the tests with `make tf` (or `make tf TEST='path/to/test'` to run a specific test), but you will not be able to see the tests running in the browser (and won't be able to debug them as easily).
