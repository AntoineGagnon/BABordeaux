<?php

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('answers')->updateOrInsert([
          'question_id' => 1,
          'answer_order' => 1,
          'rule_id' => 3,
          'label' => 'Moins de 26 ans'
      ]);
        
      DB::table('answers')->updateOrInsert([
          'question_id' => 1,
          'answer_order' => 2,
          'rule_id' => 9,
          'label' => 'Entre 26 et 45 ans'
      ]);
      
      DB::table('answers')->updateOrInsert([
          'question_id' => 1,
          'answer_order' => 3,
          'rule_id' => 10,
          'label' => 'Entre 46 et 60 ans'
      ]);
        
      DB::table('answers')->updateOrInsert([
          'question_id' => 1,
          'answer_order' => 4,
          'rule_id' => 11,
          'label' => 'Plus de 60 ans'
      ]);
        
      DB::table('answers')->updateOrInsert([
          'question_id' => 2,
          'answer_order' => 1,
          'rule_id' => 12,

          'label' => 'Bordeaux'
      ]);
        
      DB::table('answers')->updateOrInsert([
          'question_id' => 2,
          'answer_order' => 2,
          'rule_id' => 13,

          'label' => 'Autre ville de France'
      ]);
      
      DB::table('answers')->updateOrInsert([
          'question_id' => 2,
          'answer_order' => 3,
          'rule_id' => 14,

          'label' => 'Autre pays'
      ]);
        
      DB::table('answers')->updateOrInsert([
          'question_id' => 3,
          'answer_order' => 1,
          'rule_id' => 16,
          'label' => 'Oui'
      ]);
        
      DB::table('answers')->updateOrInsert([
          'question_id' => 3,
          'answer_order' => 2,
          'rule_id' => 17,
          'label' => 'Non'
      ]);
        
      DB::table('answers')->updateOrInsert([
          'question_id' => 4,
          'answer_order' => 1,
          'rule_id' => 19,
          'label' => 'Internet'
      ]);
        
      DB::table('answers')->updateOrInsert([
          'question_id' => 4,
          'answer_order' => 2,
          'rule_id' => 20,
          'label' => 'Presse écrite'
      ]);
        
      DB::table('answers')->updateOrInsert([
          'question_id' => 4,
          'answer_order' => 3,
          'rule_id' => 21,
          'label' => 'Radio'
      ]);
        
      DB::table('answers')->updateOrInsert([
          'question_id' => 4,
          'answer_order' => 4,
          'rule_id' => 23,
          'label' => 'Télévision'
      ]);
        
      DB::table('answers')->updateOrInsert([
          'question_id' => 4,
          'answer_order' => 5,
          'rule_id' => 24,
          'label' => 'Affiches / Tracts'
      ]);
        
      DB::table('answers')->updateOrInsert([
          'question_id' => 4,
          'answer_order' => 6,
          'rule_id' => 25,
          'label' => 'Bouche à oreille'
      ]);

        /**
      * DB::table('answers')->updateOrInsert([
          * 'question_id' => 5,
          * 'answer_order' => 1,
          * 'label' => 'Seul'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 5,
          * 'answer_order' => 2,
          * 'label' => 'En couple'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 5,
          * 'answer_order' => 3,
          * 'label' => 'Entre amis'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 5,
          * 'answer_order' => 4,
          * 'label' => 'En famille (adultes)'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 5,
          * 'answer_order' => 5,
          * 'label' => 'En famille (avec enfants)'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 5,
          * 'answer_order' => 6,
          * 'label' => 'Groupe organisés'
      * ]);
 *
*
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 6,
          * 'answer_order' => 1,
          * 'label' => 'Parfait'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 6,
          * 'answer_order' => 2,
          * 'label' => 'Acceptable'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 6,
          * 'answer_order' => 3,
          * 'label' => 'A améliorer'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 6,
          * 'answer_order' => 4,
          * 'label' => 'Catastrophique'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 7,
          * 'answer_order' => 1,
          * 'label' => 'Largement suffisant'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 7,
          * 'answer_order' => 2,
          * 'label' => 'Correct'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 7,
          * 'answer_order' => 3,
          * 'label' => 'Insuffisant'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 7,
          * 'answer_order' => 4,
          * 'label' => 'Inexistant'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 8,
          * 'answer_order' => 1,
          * 'label' => 'Efficace et très agréable'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 8,
          * 'answer_order' => 2,
          * 'label' => 'Correct'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 8,
          * 'answer_order' => 3,
          * 'label' => 'A améliorer'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 8,
          * 'answer_order' => 4,
          * 'label' => 'Inaceptable'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 9,
          * 'answer_order' => 1,
          * 'label' => 'Correspondant à mes attentes'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 9,
          * 'answer_order' => 2,
          * 'label' => 'Perplexe'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 9,
          * 'answer_order' => 3,
          * 'label' => 'Surpris(e)'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 9,
          * 'answer_order' => 4,
          * 'label' => 'Déçu(e)'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 9,
          * 'answer_order' => 5,
          * 'label' => 'Ebloui(e)'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 9,
          * 'answer_order' => 6,
          * 'label' => 'Indifférent(e)'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 9,
          * 'answer_order' => 7,
          * 'label' => 'Content(e)'
      * ]);
 *
*
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 10,
          * 'answer_order' => 1,
          * 'label' => 'Exceptionnelles'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 10,
          * 'answer_order' => 2,
          * 'label' => 'Interessantes'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 10,
          * 'answer_order' => 3,
          * 'label' => 'Un peu décevantes'
      * ]);
 *
* DB::table('answers')->updateOrInsert([
          * 'question_id' => 10,
          * 'answer_order' => 4,
          * 'label' => 'Navrantes'
      * ]);
         **/
      DB::table('answers')->updateOrInsert([
          'question_id' => 11,
          'answer_order' => 1,
          'rule_id'=> 26,
          'label' => '1'
      ]);
        
      DB::table('answers')->updateOrInsert([
          'question_id' => 11,
          'answer_order' => 2,
          'rule_id'=> 27,
          'label' => '2'
      ]);
        
      DB::table('answers')->updateOrInsert([
          'question_id' => 11,
          'answer_order' => 3,
          'rule_id'=> 28,
          'label' => '3'
      ]);
       
      DB::table('answers')->updateOrInsert([
          'question_id' => 11,
          'answer_order' => 4,
          'rule_id'=> 29,
          'label' => '4'
      ]);
       
      DB::table('answers')->updateOrInsert([
          'question_id' => 11,
          'answer_order' => 5,
          'rule_id'=> 30,
          'label' => '5'
      ]);
       
      DB::table('answers')->updateOrInsert([
          'question_id' => 11,
          'answer_order' => 6,
          'rule_id'=> 31,
          'label' => '6'
      ]);
       
      DB::table('answers')->updateOrInsert([
          'question_id' => 11,
          'answer_order' => 7,
          'rule_id'=> 32,
          'label' => '7'
      ]);
       
      DB::table('answers')->updateOrInsert([
          'question_id' => 11,
          'answer_order' => 8,
          'rule_id'=> 33,
          'label' => '8'
      ]);
       
      DB::table('answers')->updateOrInsert([
          'question_id' => 11,
          'answer_order' => 9,
          'rule_id'=> 34,
          'label' => '9'
      ]);
       
      DB::table('answers')->updateOrInsert([
          'question_id' => 11,
          'answer_order' => 10,
          'rule_id'=> 35,
          'label' => '10'
      ]);
     
    }
}
