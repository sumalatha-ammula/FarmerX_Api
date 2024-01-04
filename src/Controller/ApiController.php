<?php
    namespace App\Controller;

    use App\Controller\AppController;

    use Cake\Core\Configure;
    use Cake\Http\Exception\ForbiddenException;
    use Cake\Http\Exception\NotFoundException;

    use Cake\Datasource\ConnectionManager;
    use Cake\Database\Query;
    use Cake\Http\Response;
    use Cake\View\Exception\MissingTemplateException;
    use Cake\Auth\DefaultPasswordHasher;
    use Cake\Utility\Text;
    use Cake\ORM\TableRegistry;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use Cake\I18n\FrozenTime;
    use CakePdf\Pdf;

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
    
            $this->loadModel('User');
            $this->loadModel('Crop');
        }

        public function register(){
            $result="hello";
            if($this->request->is('post')){
                $data = $this->request->getdata();
                $adTbl= $this->User->newEmptyEntity();
                $adTbl->name =  $data['name'];
                $adTbl->phonenum = $data['mobile'];
                $adTbl->password = $data['password'];
                $adTbl->categeory = 1;
                debug($adTbl);
                die;
                $this->User->save($adTbl);   
        
                 
                 


            }
            debug($result);
            die;    
             return   $result;
        }


        public function addproducts(){
            $data = $this->request->getData();
            $result = "hello";
            // debug($result);
            // debug($data);
            $addpT_Data = TableRegistry::get('Crop');
            $adUpdP_Data = $this->Crop->newEmptyEntity();
            $adUpdP_Data->user_id = $data['user_id'];
            $adUpdP_Data->category = $data['category'];
            $adUpdP_Data->name = $data['name'];
            $adUpdP_Data->description = $data['description'];
            $adUpdP_Data->photo = $data['photo'];
            $adUpdP_Data->qty = $data['qty'];
            $adUpdP_Data->quality = $data['quality'];
            $adUpdP_Data->price = $data['price'];
            $adUpdP_Data->location = $data['location'];
            $adUpdP_Data->address = $data['address'];
            $adUpdP_Data->created_by = $data['created_by'];
            $adUpdP_Data->status = $data['status'];
            // debug($addpT_Data);
            // debug($adUpdP_Data);
            $addpT_Data->save($adUpdP_Data);
            $this->Flash->success(__('The company has been saved.'));
            return null;
        }
        
        public function dashbord(){

        }

    }