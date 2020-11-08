<?php

namespace App\Controller;

use App\Core\Controller;
use App\Model\Contact;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends Controller
{
    public function index(Request $req, Response $res, $args)
    {   
        $data = [
            'error' => false,
            'message' => 'hello world'
        ];

        return $res->withJson($data, 200);
    }

    public function contact(Request $req, Response $res, $args)
    {
        $post = $req->getParsedBody();
        
        $data = [
            'error' => false,
            'message' => 'Thanks for your message. I will get back to you as soon as possible.'
        ];

        if (!in_array('name', array_keys($post)) || !in_array('email', array_keys($post)) || !in_array('message', array_keys($post))) {
            $data['error'] = true;
            $data['message'] = 'Please fill all the required fields';

            return $res->withJson($data);
        }

        if (trim($post['name']) == '' || trim($post['email']) == '' || trim($post['message']) == '') {
            $data['error'] = true;
            $data['message'] = 'Please fill all the required fields';

            return $res->withJson($data);
        }

        $Contact = new Contact();
        $Contact->txt_name = $post['name'];
        $Contact->txt_email = $post['email'];
        $Contact->txt_message = $post['message'];

        try {
            $Contact->save();

            return $res->withJson($data);
        } catch (\Exception $err) {
            $data['error'] = true;
            $data['message'] = 'Error processing the request. Please try again.';
            // $data['message'] = $err->getMessage();
            
            return $res->withJson($data);
        }
    }
}