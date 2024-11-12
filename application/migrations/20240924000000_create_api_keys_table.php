defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_api_keys_table extends CI_Migration {

    public function up() {
        // Define the structure of the api_keys table
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'api_key' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'actions' => array(
                'type' => 'TEXT',  // Store allowed actions as comma-separated values
                'null' => TRUE,
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            )
        ));

        // Set primary key
        $this->dbforge->add_key('id', TRUE);

        // Create the api_keys table
        $this->dbforge->create_table('api_keys');
    }

    public function down() {
        // Drop the api_keys table if it exists
        $this->dbforge->drop_table('api_keys');
    }
}
