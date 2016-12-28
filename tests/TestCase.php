<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Domain\User\User;
class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    use DatabaseTransactions;
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
    
    public function getHeaders(string $passwoard = 'password123', User $user=null)
    {
        if(is_null($user)){
            $user= factory(User::class)->create([
                'password'=> bcrypt($passwoard),
            ]);
            $data = [
                'username'=>$user->username,
                'password'=>$passwoard
            ];
            $this->post('auth/login',$data);
            $data = $this->response->getContent();
            $token = json_decode($data)->token;
           return [
               'Authorization'=>'Bearer'.$token,
           ];
        }
    }
}
