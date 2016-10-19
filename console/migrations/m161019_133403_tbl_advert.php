<?php

use yii\db\Migration;

class m161019_133403_tbl_advert extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%advert}}', [
            'id' => $this->primaryKey(),
            'price' => $this->integer(11),
            'address' => $this->string(255),
            'fk_agent_detail' => $this->integer(11),
            'bedroom' => $this->integer(11),
            'livingroom' => $this->smallInteger(1),
            'parking' => $this->smallInteger(1),
            'kitchen' => $this->smallInteger(1),
            'general_image' => $this->string(500),
            'description' => $this->text(),
            'location' => $this->string(30),
            'hot' => $this->smallInteger(1),
            'sold' => $this->smallInteger(1),
            'type' => $this->string(50),
            'recommend' => $this->smallInteger(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%advert}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
