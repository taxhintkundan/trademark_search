<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_trademarks_table extends CI_Migration {

    public function up() {
        // Define the structure of the trademarks table
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'registration_number' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE, // Non-nullable
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE, // Nullable
            ),
            'trademark_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE, // Nullable
            ),
            'trademark_class' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE, // Nullable
            ),
            'address' => array(
                'type' => 'TEXT',
                'null' => TRUE, // Nullable
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            )
        ));

        // Set the primary key on 'id'
        $this->dbforge->add_key('id', TRUE);

        // Create the trademarks table
        $this->dbforge->create_table('trademarks');
    }

    public function down() {
        // Drop the trademarks table if it exists (rollback)
        $this->dbforge->drop_table('trademarks');
    }
}
