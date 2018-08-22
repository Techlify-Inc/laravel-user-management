<?php

use Illuminate\Database\Migrations\Migration;
use TechlifyInc\LaravelRbac\Models\Permission;

class CreatePermissions extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $models = array(
            /* User  Permissions */
            array('slug' => 'user_create', 'label' => "User: Add"),
            array('slug' => 'user_read', 'label' => "User: View"),
            array('slug' => 'user_update', 'label' => "User: Edit"),
            array('slug' => 'user_delete', 'label' => "User: Delete"),
            /* Role Permissions */
            array('slug' => 'role_create', 'label' => "Role: Add"),
            array('slug' => 'role_read', 'label' => "Role: View"),
            array('slug' => 'role_update', 'label' => "Role: Edit"),
            array('slug' => 'role_delete', 'label' => "Role: Delete"),
            array('slug' => 'role_permission_add', 'label' => "Role Permission: Delete"),
            array('slug' => 'role_permission_remove', 'label' => "Role Permission: Delete"),
        );

        $model = new Permission;
        $table = $model->getTable();
        DB::table($table)->insert($models);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * 
     * @todo
     */
    public function down()
    {
        $model = new Permission;
        $table = $model->getTable();

        $slugs = [
            "user_create",
            "user_read",
            "user_update",
            "user_delete",
            "role_create",
            "role_read",
            "role_update",
            "role_delete",
            "role_permission_add",
            "role_permission_remove",
        ];
        DB::table($table)
            ->whereIn("slug", $slugs)
            ->delete();
    }
}
