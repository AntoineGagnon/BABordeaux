<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GuestbookTest extends TestCase
{
    public function testPostGuestbookItem()
    {
        $this->testAccessGuestbook();
        $this->type('unitTestUsername', 'username')->type('Text unit testing', 'text')->press('Valider')->seePageIs('guestbook');

        $this->seeInDatabase('guestbook_submissions', ['username' => 'unitTestUsername', 'text' => 'Text unit testing']);
        \App\guestbook_submission::where('username', 'unitTestUsername')->delete();
    }

    public function testAccessGuestbook()
    {
        $this->visit('/')
            ->click('Livre d\'or')
            ->seePageIs('guestbook');
    }

}
