<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list activitylogs']);
        Permission::create(['name' => 'view activitylogs']);
        Permission::create(['name' => 'create activitylogs']);
        Permission::create(['name' => 'update activitylogs']);
        Permission::create(['name' => 'delete activitylogs']);

        Permission::create(['name' => 'list addresses']);
        Permission::create(['name' => 'view addresses']);
        Permission::create(['name' => 'create addresses']);
        Permission::create(['name' => 'update addresses']);
        Permission::create(['name' => 'delete addresses']);

        Permission::create(['name' => 'list authors']);
        Permission::create(['name' => 'view authors']);
        Permission::create(['name' => 'create authors']);
        Permission::create(['name' => 'update authors']);
        Permission::create(['name' => 'delete authors']);

        Permission::create(['name' => 'list carts']);
        Permission::create(['name' => 'view carts']);
        Permission::create(['name' => 'create carts']);
        Permission::create(['name' => 'update carts']);
        Permission::create(['name' => 'delete carts']);

        Permission::create(['name' => 'list categories']);
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'delete categories']);

        Permission::create(['name' => 'list comments']);
        Permission::create(['name' => 'view comments']);
        Permission::create(['name' => 'create comments']);
        Permission::create(['name' => 'update comments']);
        Permission::create(['name' => 'delete comments']);

        Permission::create(['name' => 'list companies']);
        Permission::create(['name' => 'view companies']);
        Permission::create(['name' => 'create companies']);
        Permission::create(['name' => 'update companies']);
        Permission::create(['name' => 'delete companies']);

        Permission::create(['name' => 'list contents']);
        Permission::create(['name' => 'view contents']);
        Permission::create(['name' => 'create contents']);
        Permission::create(['name' => 'update contents']);
        Permission::create(['name' => 'delete contents']);

        Permission::create(['name' => 'list contentelements']);
        Permission::create(['name' => 'view contentelements']);
        Permission::create(['name' => 'create contentelements']);
        Permission::create(['name' => 'update contentelements']);
        Permission::create(['name' => 'delete contentelements']);

        Permission::create(['name' => 'list continents']);
        Permission::create(['name' => 'view continents']);
        Permission::create(['name' => 'create continents']);
        Permission::create(['name' => 'update continents']);
        Permission::create(['name' => 'delete continents']);

        Permission::create(['name' => 'list countries']);
        Permission::create(['name' => 'view countries']);
        Permission::create(['name' => 'create countries']);
        Permission::create(['name' => 'update countries']);
        Permission::create(['name' => 'delete countries']);

        Permission::create(['name' => 'list currencies']);
        Permission::create(['name' => 'view currencies']);
        Permission::create(['name' => 'create currencies']);
        Permission::create(['name' => 'update currencies']);
        Permission::create(['name' => 'delete currencies']);

        Permission::create(['name' => 'list customers']);
        Permission::create(['name' => 'view customers']);
        Permission::create(['name' => 'create customers']);
        Permission::create(['name' => 'update customers']);
        Permission::create(['name' => 'delete customers']);

        Permission::create(['name' => 'list departments']);
        Permission::create(['name' => 'view departments']);
        Permission::create(['name' => 'create departments']);
        Permission::create(['name' => 'update departments']);
        Permission::create(['name' => 'delete departments']);

        Permission::create(['name' => 'list failedjobs']);
        Permission::create(['name' => 'view failedjobs']);
        Permission::create(['name' => 'create failedjobs']);
        Permission::create(['name' => 'update failedjobs']);
        Permission::create(['name' => 'delete failedjobs']);

        Permission::create(['name' => 'list firewallrules']);
        Permission::create(['name' => 'view firewallrules']);
        Permission::create(['name' => 'create firewallrules']);
        Permission::create(['name' => 'update firewallrules']);
        Permission::create(['name' => 'delete firewallrules']);

        Permission::create(['name' => 'list items']);
        Permission::create(['name' => 'view items']);
        Permission::create(['name' => 'create items']);
        Permission::create(['name' => 'update items']);
        Permission::create(['name' => 'delete items']);

        Permission::create(['name' => 'list jobs']);
        Permission::create(['name' => 'view jobs']);
        Permission::create(['name' => 'create jobs']);
        Permission::create(['name' => 'update jobs']);
        Permission::create(['name' => 'delete jobs']);

        Permission::create(['name' => 'list jobbatches']);
        Permission::create(['name' => 'view jobbatches']);
        Permission::create(['name' => 'create jobbatches']);
        Permission::create(['name' => 'update jobbatches']);
        Permission::create(['name' => 'delete jobbatches']);

        Permission::create(['name' => 'list jobbatchmanagers']);
        Permission::create(['name' => 'view jobbatchmanagers']);
        Permission::create(['name' => 'create jobbatchmanagers']);
        Permission::create(['name' => 'update jobbatchmanagers']);
        Permission::create(['name' => 'delete jobbatchmanagers']);

        Permission::create(['name' => 'list jobmanagers']);
        Permission::create(['name' => 'view jobmanagers']);
        Permission::create(['name' => 'create jobmanagers']);
        Permission::create(['name' => 'update jobmanagers']);
        Permission::create(['name' => 'delete jobmanagers']);

        Permission::create(['name' => 'list jobqueueworkers']);
        Permission::create(['name' => 'view jobqueueworkers']);
        Permission::create(['name' => 'create jobqueueworkers']);
        Permission::create(['name' => 'update jobqueueworkers']);
        Permission::create(['name' => 'delete jobqueueworkers']);

        Permission::create(['name' => 'list languages']);
        Permission::create(['name' => 'view languages']);
        Permission::create(['name' => 'create languages']);
        Permission::create(['name' => 'update languages']);
        Permission::create(['name' => 'delete languages']);

        Permission::create(['name' => 'list media']);
        Permission::create(['name' => 'view media']);
        Permission::create(['name' => 'create media']);
        Permission::create(['name' => 'update media']);
        Permission::create(['name' => 'delete media']);

        Permission::create(['name' => 'list orders']);
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'update orders']);
        Permission::create(['name' => 'delete orders']);

        Permission::create(['name' => 'list pages']);
        Permission::create(['name' => 'view pages']);
        Permission::create(['name' => 'create pages']);
        Permission::create(['name' => 'update pages']);
        Permission::create(['name' => 'delete pages']);

        Permission::create(['name' => 'list pagetemplates']);
        Permission::create(['name' => 'view pagetemplates']);
        Permission::create(['name' => 'create pagetemplates']);
        Permission::create(['name' => 'update pagetemplates']);
        Permission::create(['name' => 'delete pagetemplates']);

        Permission::create(['name' => 'list platforms']);
        Permission::create(['name' => 'view platforms']);
        Permission::create(['name' => 'create platforms']);
        Permission::create(['name' => 'update platforms']);
        Permission::create(['name' => 'delete platforms']);

        Permission::create(['name' => 'list posts']);
        Permission::create(['name' => 'view posts']);
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'update posts']);
        Permission::create(['name' => 'delete posts']);

        Permission::create(['name' => 'list postalcodes']);
        Permission::create(['name' => 'view postalcodes']);
        Permission::create(['name' => 'create postalcodes']);
        Permission::create(['name' => 'update postalcodes']);
        Permission::create(['name' => 'delete postalcodes']);

        Permission::create(['name' => 'list products']);
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'update products']);
        Permission::create(['name' => 'delete products']);

        Permission::create(['name' => 'list revisions']);
        Permission::create(['name' => 'view revisions']);
        Permission::create(['name' => 'create revisions']);
        Permission::create(['name' => 'update revisions']);
        Permission::create(['name' => 'delete revisions']);

        Permission::create(['name' => 'list routes']);
        Permission::create(['name' => 'view routes']);
        Permission::create(['name' => 'create routes']);
        Permission::create(['name' => 'update routes']);
        Permission::create(['name' => 'delete routes']);

        Permission::create(['name' => 'list seos']);
        Permission::create(['name' => 'view seos']);
        Permission::create(['name' => 'create seos']);
        Permission::create(['name' => 'update seos']);
        Permission::create(['name' => 'delete seos']);

        Permission::create(['name' => 'list sessions']);
        Permission::create(['name' => 'view sessions']);
        Permission::create(['name' => 'create sessions']);
        Permission::create(['name' => 'update sessions']);
        Permission::create(['name' => 'delete sessions']);

        Permission::create(['name' => 'list settings']);
        Permission::create(['name' => 'view settings']);
        Permission::create(['name' => 'create settings']);
        Permission::create(['name' => 'update settings']);
        Permission::create(['name' => 'delete settings']);

        Permission::create(['name' => 'list syncs']);
        Permission::create(['name' => 'view syncs']);
        Permission::create(['name' => 'create syncs']);
        Permission::create(['name' => 'update syncs']);
        Permission::create(['name' => 'delete syncs']);

        Permission::create(['name' => 'list tags']);
        Permission::create(['name' => 'view tags']);
        Permission::create(['name' => 'create tags']);
        Permission::create(['name' => 'update tags']);
        Permission::create(['name' => 'delete tags']);

        Permission::create(['name' => 'list teams']);
        Permission::create(['name' => 'view teams']);
        Permission::create(['name' => 'create teams']);
        Permission::create(['name' => 'update teams']);
        Permission::create(['name' => 'delete teams']);

        Permission::create(['name' => 'list themes']);
        Permission::create(['name' => 'view themes']);
        Permission::create(['name' => 'create themes']);
        Permission::create(['name' => 'update themes']);
        Permission::create(['name' => 'delete themes']);

        Permission::create(['name' => 'list timezones']);
        Permission::create(['name' => 'view timezones']);
        Permission::create(['name' => 'create timezones']);
        Permission::create(['name' => 'update timezones']);
        Permission::create(['name' => 'delete timezones']);

        Permission::create(['name' => 'list wishlists']);
        Permission::create(['name' => 'view wishlists']);
        Permission::create(['name' => 'create wishlists']);
        Permission::create(['name' => 'update wishlists']);
        Permission::create(['name' => 'delete wishlists']);

        Permission::create(['name' => 'list wpcomments']);
        Permission::create(['name' => 'view wpcomments']);
        Permission::create(['name' => 'create wpcomments']);
        Permission::create(['name' => 'update wpcomments']);
        Permission::create(['name' => 'delete wpcomments']);

        Permission::create(['name' => 'list wpcommentmetas']);
        Permission::create(['name' => 'view wpcommentmetas']);
        Permission::create(['name' => 'create wpcommentmetas']);
        Permission::create(['name' => 'update wpcommentmetas']);
        Permission::create(['name' => 'delete wpcommentmetas']);

        Permission::create(['name' => 'list wpoptions']);
        Permission::create(['name' => 'view wpoptions']);
        Permission::create(['name' => 'create wpoptions']);
        Permission::create(['name' => 'update wpoptions']);
        Permission::create(['name' => 'delete wpoptions']);

        Permission::create(['name' => 'list wpposts']);
        Permission::create(['name' => 'view wpposts']);
        Permission::create(['name' => 'create wpposts']);
        Permission::create(['name' => 'update wpposts']);
        Permission::create(['name' => 'delete wpposts']);

        Permission::create(['name' => 'list wppostmetas']);
        Permission::create(['name' => 'view wppostmetas']);
        Permission::create(['name' => 'create wppostmetas']);
        Permission::create(['name' => 'update wppostmetas']);
        Permission::create(['name' => 'delete wppostmetas']);

        Permission::create(['name' => 'list wpterms']);
        Permission::create(['name' => 'view wpterms']);
        Permission::create(['name' => 'create wpterms']);
        Permission::create(['name' => 'update wpterms']);
        Permission::create(['name' => 'delete wpterms']);

        Permission::create(['name' => 'list wptermmetas']);
        Permission::create(['name' => 'view wptermmetas']);
        Permission::create(['name' => 'create wptermmetas']);
        Permission::create(['name' => 'update wptermmetas']);
        Permission::create(['name' => 'delete wptermmetas']);

        Permission::create(['name' => 'list wptermrelationships']);
        Permission::create(['name' => 'view wptermrelationships']);
        Permission::create(['name' => 'create wptermrelationships']);
        Permission::create(['name' => 'update wptermrelationships']);
        Permission::create(['name' => 'delete wptermrelationships']);

        Permission::create(['name' => 'list wptermtaxonomies']);
        Permission::create(['name' => 'view wptermtaxonomies']);
        Permission::create(['name' => 'create wptermtaxonomies']);
        Permission::create(['name' => 'update wptermtaxonomies']);
        Permission::create(['name' => 'delete wptermtaxonomies']);

        Permission::create(['name' => 'list wpusers']);
        Permission::create(['name' => 'view wpusers']);
        Permission::create(['name' => 'create wpusers']);
        Permission::create(['name' => 'update wpusers']);
        Permission::create(['name' => 'delete wpusers']);

        Permission::create(['name' => 'list wpusermetas']);
        Permission::create(['name' => 'view wpusermetas']);
        Permission::create(['name' => 'create wpusermetas']);
        Permission::create(['name' => 'update wpusermetas']);
        Permission::create(['name' => 'delete wpusermetas']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
