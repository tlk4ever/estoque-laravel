<?php

/**
 * Description of AuthControllerTest
 *
 * @author THIAGO
 */

namespace Domain\Auth;

use Domain\User\User;

class ControllerTest extends \TestCase {

   

    public function testLogin() {
        $data = [
            'username' => 'thiago',
            'password' => '123456',
        ];
        $user = $data;
        $user['password'] = bcrypt($user['password']);
        $user['email'] = 'teste@teste.com';
        factory(User::class)->create($user);

        $this->post('auth/login', $data);
        $this->seeStatusCode(200);
        $this->seeJson([
            'username' => 'thiago'
        ]);
    }

    public function testLoginWithEmail() {
        $data = [
            'username' => 'teste@teste.com',
            'password' => '123456',
        ];
        $user = [
            'username' => 'thiago',
            'email' => 'teste@teste.com',
            'password' => bcrypt($data['password']),
        ];
        factory(User::class)->create($user);

        $this->post('auth/login', $data);
        $this->seeStatusCode(200);
        $this->seeJson([
            'username' => 'thiago'
        ]);
    }

    public function testCantLogin() {
        $data = [
            'username' => uniqid(),
            'password' => 'teste'
        ];
        $this->post('auth/login', $data);
        $this->seeStatusCode(401);
    }

}
