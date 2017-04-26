<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      // Changer en updateOrInsert
      // Ajouter un id fixe

        DB::table('questions')->updateOrInsert([
            'id' => 1,
            'question_order' => '1',
            'is_visible' => true,
            'question_type' => 'singleChoice',
            'label' => "Quel est votre âge ?",
            'is_required' => true
        ]);

        DB::table('questions')->updateOrInsert([
			'id' => 2,
            'question_order' => '2',
            'is_visible' => true,
            'question_type' => 'singleChoice',
            'label' => 'D\'où venez vous ?',
            'is_required' => true
        ]);

        DB::table('questions')->updateOrInsert([
			'id' => 3,
            'question_order' => '3',
            'is_visible' => true,
            'question_type' => 'singleChoice',
            'label' => 'Est-ce votre première visite au musée ?',
            'is_required' => true
        ]);

        DB::table('questions')->updateOrInsert([
			'id' => 4,
            'question_order' => '4',
            'is_visible' => true,
            'question_type' => 'multipleChoice',
            'label' => 'Comment avez-vous connu le musée ?',
            'is_required' => true
        ]);
        /**
         * DB::table('questions')->updateOrInsert([
         * 'id' => 5,
         * 'question_order' => '5',
         * 'is_visible' => true,
         * 'question_type' => 'multipleChoice',
         * 'label' => 'Avec qui êtes vous venus ?',
         * 'is_required' => true
         * ]);
         *
         *
         *
         * DB::table('questions')->updateOrInsert([
         * 'id' => 6,
         * 'question_order' => '6',
         * 'is_visible' => true,
         * 'question_type' => 'singleChoice',
         * 'label' => 'Estimez votre temps d\'attente au guichet .',
         * 'is_required' => true
         * ]);
         *
* DB::table('questions')->updateOrInsert([
         * 'id' => 7,
         * 'question_order' => '7',
         * 'is_visible' => true,
         * 'question_type' => 'singleChoice',
         * 'label' => 'Comment jugez-vous les renseignements apportés pendant la visite ? (écritaux, fléchage, ...)',
         * 'is_required' => true
         * ]);
         *
* DB::table('questions')->updateOrInsert([
         * 'id' => 8,
         * 'question_order' => '8',
         * 'is_visible' => true,
         * 'question_type' => 'singleChoice',
         * 'label' => 'Comment avez-vous trouvé l\'accueil du personnel ?',
         * 'is_required' => true
         * ]);
         *
* DB::table('questions')->updateOrInsert([
         * 'id' => 9,
         * 'question_order' => '9',
         * 'is_visible' => true,
         * 'question_type' => 'singleChoice',
         * 'label' => 'Comment vous êtes-vous senti pendant cette visite ?',
         * 'is_required' => true
         * ]);
         *
* DB::table('questions')->updateOrInsert([
         * 'id' => 10,
         * 'question_order' => '10',
         * 'is_visible' => true,
         * 'question_type' => 'singleChoice',
         * 'label' => 'Comment jugez-vous les oeuvres exposées ?',
         * 'is_required' => true
         * ]);
         **/

        DB::table('questions')->updateOrInsert([
			'id' => 11,
            'question_order' => '11',
            'is_visible' => true,
            'question_type' => 'singleChoice',
            'label' => 'Notez le musée',
            'is_required' => true
        ]);

    }
}
