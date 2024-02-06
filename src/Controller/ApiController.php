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
            $this->loadModel('CropImages');
            $this->loadComponent("Media");
            $this->loadModel("Modules");
        }

        public function register(){
            
            if($this->request->is('post')){
                $result=[];
                $data = $this->request->getdata();
                debug($data);
                // die;
                $addrT_Data = TableRegistry::get('User');
                $adUpdr_Data= $this->User->newEmptyEntity();
                $adUpdr_Data->name =  $data['name'];
                $adUpdr_Data->email = $data['email'];
                $adUpdr_Data->phone = $data['phone'];
                $adUpdr_Data->profile_img = $this->Media->upload($data['profile_img'], 'User_img');
                // $adUpdr_Data->created_on = $data['created_on'];
                $adUpdr_Data->password = $data['password'];
                $adUpdr_Data->created_by = $data['created_by'];
                $adUpdr_Data->status = $data['status'];
                // debug($adUpdr_Data);
                $addrT_Data->save($adUpdr_Data); 
                $lastuser = $this->User->find('all')->last();
                $lastRecordId = $lastuser->id;
                $result ['massage']= 'The register Data has been saved.';
            }
            // debug($result);  

            if(!empty($data['subscription_type'])){
                $addrT_Data = TableRegistry::get('Modules');
                $adM_Data= $this->Modules->newEmptyEntity();
                $adM_Data->name =  $data['mname'];
                $adM_Data->subscription_type =  $data['subscription_type'];
                $adM_Data->expiry =  $data['expiry'];
                // $adM_Data->created_on =  $data['created_on'];
                $adM_Data->created_by =  $lastRecordId;
                $adM_Data->status =  1;
                $addrT_Data->save($adM_Data); 
                $result ['massage']= 'The register module has been saved.';

            }
            $this->set("result", $result);
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
        
        public function addcropimages(){
            if($this->request->is('post')){
                $data = $this->request->getdata();
                // debug($data);
                $addciT_Data = TableRegistry::get('CropImages');
                $adUpdCP_Data = $this->CropImages->newEmptyEntity();
                $adUpdCP_Data->crop_id = $data['crop_id'];
                $adUpdCP_Data->location = $data['location'];
                $adUpdCP_Data->uploaded_on = $data['uploaded_on'];
                // debug($adUpdCP_Data);
                $addciT_Data->save($adUpdCP_Data); 
                $result = 'The cropimages Data has been saved.';
            }
             // debug($result);  
             $this->set("result", $result);
        }
        
        public function addmodules(){
            if($this->request->is('post')){
                $data = $this->request->getdata();
                debug($data);
                die;
            }
        }

        public function login(){
            $result=[];
            
            if($this->request->is('post')){
                $data = $this->request->getdata(); 
                // debug($data);
                // die;               
                $userddata = $this->User->find('all')
                ->where([
                    'password' => $data['password'], 'name' => $data['name']
            ])
                ->toArray();  
                // debug($userddata);              
                if (count($userddata) == 1) {
                    $result = 'The User Login Not Done.';
                    $result = ['error' => 0,'status' => 200];
                }else{
                    $result = ['error' => 1];
                }                 
            }
            $this->set("result", $result);
        }

    }