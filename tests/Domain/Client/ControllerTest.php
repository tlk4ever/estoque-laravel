<?php


namespace Domain\Client;

/**
 * Description of ControllerTest
 *
 * @author THIAGO
 */
class ControllerTest extends \TestCase
{
    public function testCreate()
    {
        $name = "Thaigo Brito";
        $data = [
            'name'=>$name
        ];
        $this->post('client',$data);
        $this->seeStatusCode(200);
        $this->seeJson([
            'name'=>$name,
        ]);
        $this->seeInDatabase('clients', [
            'name'=>$name
        ]);
    }
}
