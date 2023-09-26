<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class create_password_reset_tokens extends Migration
{

    public function up()
    {
        $this->db->query("
            CREATE TABLE IF NOT EXISTS password_reset_tokens (
                email VARCHAR(255) PRIMARY KEY,
                token VARCHAR(255),
                created_at TIMESTAMP NULL
            )
        ");
    }

    public function down()
    {
        $this->db->query("DROP TABLE IF EXISTS password_reset_tokens");
    }
}
