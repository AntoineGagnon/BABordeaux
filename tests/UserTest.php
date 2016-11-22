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
}