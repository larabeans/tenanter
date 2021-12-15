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


## Migrations

Includes migration to add `tenant_id` column in all existing database tables.

---

## Seeders

For seeder naming use post fix from _1 to _10

Includes seeders for

- tenant roles
- tenant permissions
- root admin
- tenant admin
- default root admin
- default tenant admin
- default tenant

---

## USAGE

- Use HasTenancy traits in User, Roles, ParentModel in core/beanner ( or your own recpective models accordingly)
- Use Authentication Trait in User modes on core/beanner ( or your own recpective models accordingly)
- In User container we need to modify two requests, email validation rules as give below
    - \app\Containers\AppSection\User\UI\API\Requests\RegisterUserRequest.php
    - \app\Containers\AppSection\User\UI\API\Requests\CreateAdminRequest.php

  `'email' => 'required|email|max:40|unique:users,email,NULL,id,tenant_id,' . tenant()->getTenantKey(),`
- Update role name validation rule in AppSection/Authorization/UI/API/Requests/CreateRoleRequest.php as below
  `'name' => 'required|unique:' . config('permission.table_names.roles') . ',name,NULL,id,tenant_id,' . tenant()->getTenantKey() . '|min:2|max:20|no_spaces',`
---

## TODO

- Implement cli (artisan) command to add tenant column to any table (specifying table name and column type i.e. incement
  or uuid)
- Implement cli (artisan) command to add default tenant in database

---

> [Larabeans](README.md) > Tenanter [⬆](#tenanter)
