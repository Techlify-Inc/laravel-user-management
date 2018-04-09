<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
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
            array('name' => 'user_create', 'label' => "User: Add"),
            array('name' => 'user_read', 'label' => "User: View"),
            array('name' => 'user_update', 'label' => "User: Edit"),
            array('name' => 'user_delete', 'label' => "User: Delete"),
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
        
    }

}
