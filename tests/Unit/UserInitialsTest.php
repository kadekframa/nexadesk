<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserInitialsTest extends TestCase
{
    public function test_initials_take_first_letter_of_up_to_two_words()
    {
        $this->assertSame('KF', (new User(['name' => 'Kadek Frama Putra']))->initials);
        $this->assertSame('A', (new User(['name' => 'administrator']))->initials);
        $this->assertSame('BS', (new User(['name' => '  budi   santoso ']))->initials);
    }
}
