<?php


namespace Domain\Client;
use Domain\User\User;
/**
 * Description of ControllerTest
 *
 * @author THIAGO
 */
class ControllerTest extends \TestCase
{
    public function testCreate()
    {
        $headers = $this->getHeaders();
       
        $name = "Thaigo Brito";
        $data = [
            'name'=>$name
        ];
        $this->post('client',$data,$headers);
        $this->seeStatusCode(200);
        $this->seeJson([
            'name'=>$name,
        ]);
        $this->seeInDatabase('clients', [
            'name'=>$name
        ]);
    }
}
