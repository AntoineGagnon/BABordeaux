<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * Tests du menu
     */

    public function testMenuLivreDOr()
    {
        $this->visit('/')
        	->click('Livre d\'or')
        	->seePageIs('guestbook');
    }

    public function testMenuSondage()
    {
    	$this->visit('guestbook')
    		->click('Sondage')
    		->seePageIs('/');
    }

    public function testAdminGuest()
    {
    	$this->visit('/')
    		->click('administrateur')
    		->seePageIs('/login');
    }

    // Test de réponse au sondage
    public function testReponse()
    {
        $this->visit('/')
            ->select('1', 'question_1')
            ->type('Ceci est un test', 'question_3')
            ->press('Valider')
            ->see('Avis ajoutÃ© aux rÃ©sultats !');
    }
}