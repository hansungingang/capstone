<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\LectureCategorySeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserSignUpTest extends TestCase
{
    use RefreshDatabase;

    private const URL = '/register';

    protected static $migrationRun = false;

    public function setUp(): void{
        parent::setUp();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSignUpSuccess()
    {
        $formData = [
            'email' => 'email@naver.com',
            'name' => 'name',
            'password' => 'password',
            'password_confirmation'=>'password',
            'age' => true,
            'service' => true,
            'privacy' => true
        ];

        $response = $this->json('POST',self::URL,$formData);
        $this->assertEquals(201, $response->getStatusCode());

        $isExist = User::where('email','=',$formData['email'])->count() > 0;
        $this->assertTrue($isExist);
    }
}
