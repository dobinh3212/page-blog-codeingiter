<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePostCategory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'post_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
        ]);

        $this->forge->addKey('id');
        $this->forge->createTable('post_category');
    }

    public function down()
    {
        $this->forge->dropTable('post_category');
    }
}
