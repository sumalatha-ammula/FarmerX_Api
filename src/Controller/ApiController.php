<?php
    namespace App\Controller;

    use App\Controller\AppController;

    class ApiController extends AppController
    {
        public function initialize(): void

        {
            parent::initialize();
        $this->response->withHeader('Access-Control-Allow-Origin', '*');
        $this->response->withType('json');
        $this->request->allowMethod([
            'post','put','get','delete'
        ]);
        $this->loadComponent('RequestHandler');
        $this->viewBuilder()->setLayout('ajax');
        $this->viewBuilder()->settemplate("response");
    
            $this->loadModel('Users');
        }

        public function register(){
            $result="hello";
            if($this->request->is('post')){
                $data = $this->request->getdata();
                $adTbl= $this->Users->newEmptyEntity();
                $adTbl->name =  $data['name'];
                $adTbl->phonenum = $data['mobile'];
                $adTbl->password = $data['password'];
                $adTbl->categeory = 1;
                debug($adTbl);
                die;
                $this->Users->save($adTbl);   
        
                 
                 


            }
            debug($result);
            die;    
             return   $result;
        }

    }