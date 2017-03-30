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
          'answer_order' => 2,
          'label' => 'Moins de 26 ans'
      ]);
      
    }
}
