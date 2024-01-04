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
            $this->loadComponent("Media");
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

            $addpT_Data = TableRegistry::get('Crop');
            $adUpdP_Data = $this->Crop->newEmptyEntity();
            $adUpdP_Data->user_id = $data['user_id'];
            $adUpdP_Data->category = $data['category'];
            $adUpdP_Data->name = $data['name'];
            $adUpdP_Data->description = $data['description'];
            $adUpdP_Data->photo = $this->Media->upload($data['photo'], 'Crop');
            $adUpdP_Data->qty = $data['qty'];
            $adUpdP_Data->quality = $data['quality'];
            $adUpdP_Data->price = $data['price'];
            $adUpdP_Data->location = $data['location'];
            $adUpdP_Data->address = $data['address'];
            $adUpdP_Data->created_by = $data['created_by'];
            $adUpdP_Data->status = $data['status'];
            // debug($addpT_Data);
            $addpT_Data->save($adUpdP_Data);
            $result = 'The Crop Data has been saved.';
            $this->set("result", $result);
        }
        
        public function dashbord(){

        }
        // The method to process and move the uploaded file
        protected function processUpload($uploadedFile)
        {
            debug($uploadedFile);
            $targetDir = WWW_ROOT . 'img' . DS . 'uploads' . DS;
            debug( $targetDir);
            $filename = md5(uniqid()) . '.' . pathinfo($uploadedFile->getClientFilename());
            debug($filename);
            $uploadPath = $targetDir . $filename;
        
            if ($uploadedFile->moveTo($uploadPath)) {
                return 'uploads' . DS . $filename;
            }
        
            return null;
        }
    }