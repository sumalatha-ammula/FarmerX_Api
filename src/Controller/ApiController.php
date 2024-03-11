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
            $this->loadModel("Onetimepassword");
            $this->loadModel("Transportation");
            $this->loadComponent("Email");



        }

        public function register(){
            
            if($this->request->is('post')){
                $result=[];
                $data = $this->request->getdata();
                // debug($data);
                // die;
                $addrT_Data = TableRegistry::get('User');
                $adUpdr_Data= $this->User->newEmptyEntity();
                // $adUpdr_Data->name =  $data['username'];
                // $adUpdr_Data->email = $data['email'];
                $adUpdr_Data->phone = $data['mobile'];
                // $adUpdr_Data->profile_img = $this->Media->upload($data['profile_img'], 'User_img');
                // $adUpdr_Data->created_on = $data['created_on'];
                $adUpdr_Data->password = $data['password'];
                // $adUpdr_Data->created_by = $data['created_by'];
                $adUpdr_Data->status = 1;
                // debug($adUpdr_Data);
                $addrT_Data->save($adUpdr_Data); 
                $lastuser = $this->User->find('all')->last();
                $lastRecordId = $lastuser->id;
            } 
            $result = ['error' => 0, 'status' => 200];

            
            $this->set("result", $result);
        }


        public function addcrop(){
            $result=[];
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
            $adUpdP_Data->created_by = 1;
            $adUpdP_Data->status = 1;
            $addpT_Data->save($adUpdP_Data);
          
            // else{
            //     $addpT_Data = $this->Crop->get($data['id']); 
            //     // debug($data['id']);
            //     $adUpdP_Data=[];
            //     $adUpdP_Data->user_id = $data['user_id'];
            // $adUpdP_Data->category = $data['category'];
            // $adUpdP_Data->name = $data['name'];
            // $adUpdP_Data->description = $data['description'];
            // $adUpdP_Data->photo = $this->Media->upload($data['photo'], 'Crop');
            // $adUpdP_Data->qty = $data['qty'];
            // $adUpdP_Data->quality = $data['quality'];
            // $adUpdP_Data->price = $data['price'];
            // $adUpdP_Data->location = $data['location'];
            // $adUpdP_Data->address = $data['address'];
            // $adUpdP_Data->created_by = 1;
            // $adUpdP_Data->status = 1;
            // $addpT_Data->save($adUpdP_Data);    
            // }
            // $lastproduct = $this->Crop->find('all')->last();
            // $lastRecordId = $lastproduct->id;
            // if(!empty($data['photo'])){
            //     $photos = $data['photo']; // Assuming $data['photo'] is an array of photos
            //     unset($photos[0]);
            //     foreach ($photos as $photo) {
            //         $addciT_Data = TableRegistry::get('CropImages');
            //         $adUpdCP_Data = $this->CropImages->newEmptyEntity();
            //         $adUpdCP_Data->crop_id = $lastRecordId;
            //         $adUpdCP_Data->location = $this->Media->upload($photo, 'Crop');
            //         // $adUpdCP_Data->uploaded_on = $data['uploaded_on'];
            //         $addciT_Data->save($adUpdCP_Data); 
            //         $result ['massage'] = 'The Crop Data and cropimages Data  has been saved.';
            //     }
            // }
            $this->set("result", $result);
        }
        public function addtransport(){
            $result=[];
            $data = $this->request->getData();           
            $addpT_Data = TableRegistry::get('transportation');
            $adUpdP_Data = $this->Transportation->newEmptyEntity();
            $adUpdP_Data->user_id = $data['user_id'];
            $adUpdP_Data->transport_category = $data['category'];
            $adUpdP_Data->name = $data['name'];
            $adUpdP_Data->description = $data['description'];
            $adUpdP_Data->photo = $this->Media->upload($data['photo'], 'Crop');
            $adUpdP_Data->capacity = $data['capacity'];
            $adUpdP_Data->price_km = $data['price'];
            $adUpdP_Data->contact_number = $data['contact'];

            $adUpdP_Data->service_area = $data['address'];
            $adUpdP_Data->created_by = 1;
            $adUpdP_Data->status = 1;
            $addpT_Data->save($adUpdP_Data);            
            $this->set("result", $result);
        }
        public function changepassword(){
            $result = [];
            $result = ['error' => 1,];
            $this->request->is('post');
            $data = $this->request->getData(); 
            if($data['newpassword'] === $data['confirmpwd']){
                $users = $this->User->find('all')
                ->select(['id'])
                ->where(['password' => $data['curpassword'] ])
                ->toArray();
              
                $userdataRecord = $this->User->get( $users[0]['id']);
                $userdataRecord->password = $data['newpassword'];
                $this->User->save($userdataRecord);
                $result = [
                    'error'=>0, 'status'=> 200,
               ];
                
            }
            $this->set ("result",$result);
        }
        
        
        public function cropdetails(){
            $result=[];
            $result['error'] = 0;
            $data = $this->request->getdata();
            // debug($data);
            $results = $this->Crop->find('all')
            ->where(['id'=>$data['id']])
            ->select(['name','category', 'qty', 'price', 'location', 'photo', 'description', 'quality', 'location', 'address'])
            ->toArray();
            $result = ['error' => 0, 'status' => 200, 'data'=>$results ];
             $this->set("result", $result);

        }
        private function generatetoken() {
            $token = bin2hex(random_bytes(16));
            return $token;
         }

         public function listofcrop(){
            $result=[];
            $result['error'] = 0;
            $results = $this->Crop->find('all')
            ->select(['id','name','category', 'qty', 'price','description', 'location', 'photo'])
            ->toArray();
            $result = ['error' => 1, 'status' => 200, 'data'=>$results ];
             $this->set("result", $result);
        }
        public function transportlist(){
            $result=[];
            $result['error'] = 0;
            $results = $this->Transportation->find('all')
            // ->select(['id','name','category', 'qty', 'price','description', 'location', 'photo'])
            ->toArray();
            $result = ['error' => 0, 'status' => 200, 'data'=>$results ];
             $this->set("result", $result);
        }
        public function transportdetails(){
            $result=[];
            $result['error'] = 0;
            $data = $this->request->getdata();
            // debug($data);
            $results = $this->Transportation->find('all')
            ->where(['id'=>$data['id']])
            // ->select(['name','category', 'qty', 'price', 'location', 'photo', 'description', 'quality', 'location', 'address'])
            ->toArray();
            $result = ['error' => 0, 'status' => 200, 'data'=>$results ];
             $this->set("result", $result);

        }

        public function login(){
            $result=[];            
            if($this->request->is('post')){
                $data = $this->request->getdata();  
                // debug($data); 
                // die;                          
                $userddata = $this->User->find('all')
                ->where([
                    'password' => $data['password'], 'phone' => $data['mobilenumber']
            ])
                ->toArray();  
                if (count($userddata) == 1) {
                    $lt = TableRegistry::get('User');
                    $ld = $lt->get($userddata[0]->id);
                    $ld->token = $this->generatetoken();
                    $ld->deviceid = isset($data['deviceid']) ? $data['deviceid'] : '';
                    $ld->deviceinfo = isset($data['deviceinfo']) ? $data['deviceinfo'] : '';
                    $userddata[0]->token = $ld->token;
                    $lt->save($ld);
                    $result = 'The User Login Done.';
                    $result = ['error' => 0,'member' => $userddata[0],'status' => 200];

                    

                }else{
                    $result = ['error' => 1];
                }                 
            }
            $this->set("result", $result);
        }

        
        
        public function resetpassword(){
            $result = [];
            $result ['error'] = 1;
            $data = $this->request->getData();
            $useremail = $this->User->find('all')
            ->select(['id'])
            ->where(['email'=>$data['email'] ])->toArray();
            if($useremail!=0){
            $userdataRecord = $this->User->get( $useremail[0]['id']);
            $userdataRecord->password = $data['newpassword'];
            $this->User->save($userdataRecord);
            $result = [
                'error'=>0, 'status'=> 200,
           ];
        }
        $this->set ("result",$result);
        }



        public function sendotpresetpwd(){
            $result = [];
            $data = $this->request->getData();           
            $useremail = $this->User->find('all')
            ->select(['email','id'])
            ->where(['email'=>$data['email'] ])->toArray();
            if(count($useremail) == 1){           
                $otp = random_int(000001,999999);               
                $currentTime = FrozenTime::now();
               $newOtpEntity = $this->Onetimepassword->newEmptyEntity();
               $newOtpEntity->email = $useremail[0]['email'];               
               $newOtpEntity->otp = $otp;
               $newOtpEntity->createdon = date("Y-m-d");
            if ($this->Onetimepassword->save($newOtpEntity)) {
                    $result['message'] = "OTP saved successfully";        
                } 
            } 
            $conf=[];
            $conf['host'] = 'ssl://smtp.gmail.com';
            $conf['port'] = 465;
            $conf['username'] = 'yenibhavya0508@gmail.com';
            $conf['password'] = 'tpqujcgroydpzloc';
            $conf['fromemail'] = "yenibhavya0508@gmail.com";
            $conf['sender'] = "FarmerX";
            if(!empty($useremail)){
            $emailsend['email'] = $useremail[0]->email;
            $mailtext['otp'] = $otp;
            }else{
                $emailsend['email']='test12@gmail.com';
                $mailtext['otp']= 1234;
            }
    

            $this->Email->sendotpmail($conf, $emailsend['email'], " Your OTP for reset password",$mailtext);
        
            $result['email'] = $emailsend ? $emailsend['email'] : null;
            $result['OTP'] = $mailtext;
            $this->set ("result",$result);

        }

        public function sendingresetotp(){
            $result = [];
            $result ['error'] = 1;
            $data = $this->request->getData();
            $sendOtp = $this->Onetimepassword->find('all')
            ->select(['otp'])
            ->where(['otp'=>$data['otp'] ])->toArray();
            if(isset($sendOtp[0]['otp'])){
                $value = $sendOtp[0]['otp'];
            $result = ['error'=>0, 'status'=> 200,'otp'=>$value ];
        }else{
            $value = null;
            $result ['error'] = 1;
        }
            $this->set ("result",$result);
        }

        

    public function userdata(){
        $result = [];
       $data = $this->request->getdata();
    $usrdata = $this->User->find('all')
    ->contain(['Modules','Crop'])
    ->where(["User.id"=>$data['id']])->toArray();
    $result = [
        'error'=> 0,'userdata'=> $usrdata
    ];
    $this->set ("result",$result);
    }    

    public function editprofile(){
        $result = [];
        $result = ['error' => 1,];
        $this->request->is('post');
        $data = $this->request->getData(); 
        // debug($data);
        $results = $this->User->get($data['id']);        
            $userdata ['name'] = $data['username'];
            $userdata ['email'] = $data['email'];
            $userdata ['mobile'] = $data['phone'];
            $profiledata = $this->User->patchEntity($results,$userdata);
            $this->User->save( $profiledata);
       
        $result = [
            'error'=>0, 'status'=> 200, 'User'=> $results
       ];

        // $result = $this->FieldExecutive->find ( 'all' )
        // ->where(['id' => $data['id']])->toArray();
        // debug($data['id']) ;
        // debug($result) ;
        $this->set ("result",$result);
    }

    }