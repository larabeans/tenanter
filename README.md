> [Larabeans](README.md) > Tenanter

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

For seeder naming use post fix from _1 to _10

Includes seeders for

- tenant roles
- tenant permissions
- tenant admin

---

## USAGE

- Use HasTenancy traits in User, Roles, ParentModel in core/beanner ( or your own recpective models accordingly)
- Use Authentication Trait in User modes on core/beanner ( or your own recpective models accordingly)  

---

## TODO

- Implement cli (artisan) command to add tenant column to any table (specifying table name and column type i.e. incement
  or uuid)
- Implement cli (artisan) command to add default tenant in database

---

> [Larabeans](README.md) > Tenanter [⬆](#tenanter)
