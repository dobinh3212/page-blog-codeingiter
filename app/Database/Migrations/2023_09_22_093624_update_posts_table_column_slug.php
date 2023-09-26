<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSlugsToPosts extends Migration
{
    public function up()
    {
        $this->forge->addColumn('posts', [
            'slugs' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('posts', 'slugs');
    }
}
