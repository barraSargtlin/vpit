# Healthy recipes
---
[![Build Status](https://travis-ci.com/PaulKujawa/vpit.svg?token=uX8iz9gHcJk5sGqwqgvR&branch=master)](https://travis-ci.com/PaulKujawa/vpit)

**Database setup**
* `composer install`
* `bin/console doctrine:database:create`

Contribute
* build `npm run build:prod`
* update DB
  * `bin/console doctrine:migrations:diff` to generate migration file
  * `bin/console doctrine:schema:update --force` to apply it
