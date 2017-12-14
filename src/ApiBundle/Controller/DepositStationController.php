<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class DepositStationController extends Controller
{
    /**
     * @Route("/api/getAction")
     * @Template()
     */
    public function getAction()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-Requested-With");
        $array = $this->randomGenerator();
        
        return new Response(json_encode($array));
    }
    public function randomGenerator(){
        $json = file_get_contents('../data.json');
        $array = json_decode($json, true);
        $new_array = array();
        for ($i=0; $i<20000; $i++) {
            $new_array[$i] = $array['collections']['patient'][0];
            $new_array[$i]['id'] = $i + 1;
            $new_array[$i]['status'] = rand(0, 1);
            $new_array[$i]['details']['tel'] = rand(1000000, 9999999);
            $new_array[$i]['label'] = $this->generateRandomLabel();
            $new_array[$i]['toggled'] = true;
        }
        $array['collections']['patient'] = $new_array;
        return $array;
    }
    public function generateRandomLabel() {
        $upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowerCase = 'abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
        $length = rand(3, 8);
        $randomString .= $upperCase[rand(0, 25)];
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $lowerCase[rand(0, 25)];
        }
        $length = rand(3, 8);
        $randomString .= ' ';
        $randomString .= $upperCase[rand(0, 25)];
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $lowerCase[rand(0, 25)];
        }
        return $randomString;
    }
    
}
