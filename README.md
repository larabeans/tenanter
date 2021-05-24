>[Larabeans](README.md) > Tenanter

---

# Tenanter

> Apiato container to add multi tenancy feature

* [Overview](#overview)
* [Migrations](#migrations)
* [Seeders](#seeders)
* [TODO](#todo)


---

## Overview

- Add functionality to manage multi-tenancy, create/add/edit
- Add functionality to activate/de-activate tenant account.
- Updates existing database structure to make it compatible with multi-tenant application

---

## Migrations
Includes migration to add `tenant_id` column in all existing database tables.

---

## Seeders
For seeder use post from _1  to _10

Includes seeders for
  - tenant roles 
  - tenant permissions 
  - root admin 
  - tenant admin 
  - default root admin 
  - default tenant admin
  - default tenant

---

## TODO
- Implement cli (artisan) command to add tenant column to any table
- Implement cli (artisan) command to add default tenant in database

---

>[Larabeans](README.md) > Tenanter [⬆](#tenanter)
