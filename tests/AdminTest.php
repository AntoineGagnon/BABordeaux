<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTest extends TestCase
{
    public function testAuthentification()
    {
        $this->visit('/login')
        	->type('password', '_password')
            ->press('_submit')
        	->seePageIs('admin');
    }

    public function testEchecAuthentification()
    {
        $this->visit('/login')
            ->type('fauxmotdepasse', '_password')
            ->press('_submit')
            ->seePageIs('/login');
    }

    public function testAuthentificationVide()
    {
        $this->visit('/login')
            ->press('_submit')
            ->seePageIs('/login');
    }

    public function testAccesNonAuthentifie()
    {
        $this->visit('/admin')
            ->seePageIs('/login');
    }

    public function testAccesReponsesLivreDorAuthentifie()
    {
        $this->testAuthentification();
        $this->click('Visualiser le Livre d\'or')
            ->seePageIs('/admin/resultguestbook');
    }

    public function testAccesReponsesLivreDorNonAuthentifie()
    {
        $this->visit('/admin/resultguestbook')
            ->seePageIs('/login');
    }

    public function testEditionQuestionnaireAuthentifie()
    {
        $this->testAuthentification();
        $this->click('Editer le questionnaire')
            ->seePageIs('/admin/editpoll');
    }

    public function testEditionQuestionnaireNonAuthentifie()
    {
        $this->visit('/admin/editpoll')
            ->seePageIs('/login');
    }

    public function testAccesResultatsQuestionnaireAuthentifie()
    {
        $this->testAuthentification();
        $this->click('Visualiser les rÃ©sultats du questionnaire')
            ->seePageIs('/admin/resultpoll');
    }

    public function testAccesResultatsQuestionnaireNonAuthentifie()
    {
        $this->visit('/admin/resultpoll')
            ->seePageIs('/login');
    }

    public function testAccesModifierMotDePasseAuthentifie()
    {
        $this->testAuthentification();
        $this->click('Modifier le mot de passe')
            ->seePageIs('/admin/change_password');
    }

    public function testAccesModifierMotDePasseNonAuthentifie()
    {
        $this->visit('/admin/change_password')
            ->seePageIs('/login');
    }

    public function testDeconnexion()
    {
        $this->testAuthentification();
        $this->click('DÃ©connexion')
            ->seePageIs('/')
            ->visit('/admin')
            ->seePageIs('/login');
    }


}