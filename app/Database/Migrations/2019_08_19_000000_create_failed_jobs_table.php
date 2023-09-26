<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFailedJobs extends Migration
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
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'connection' => [
                'type' => 'TEXT',
            ],
            'queue' => [
                'type' => 'TEXT',
            ],
            'payload' => [
                'type' => 'LONGTEXT',
            ],
            'exception' => [
                'type' => 'LONGTEXT',
            ],
            'failed_at' => [
                'type' => 'TIMESTAMP',
            ],
        ]);

        $this->forge->addKey('id');
        $this->forge->createTable('failed_jobs');
    }

    public function down()
    {
        $this->forge->dropTable('failed_jobs');
    }
}
