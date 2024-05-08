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
            $this->loadComponent('Sms');
            $this->loadModel('Manpower');
            $this->loadModel("Payments");
            $this->loadModel("Industry");
            $this->loadModel("blog");



        }


        public function lookingforjob(){
            $response = $this->razorpayorder(200);
            $result = ['error' => 0, 'status' => 200, 'key' => 'rzp_test_n2VHLMFV62PskX',  'data'=>$response];
            $this->set("result", $result);
        }

        public function hiringforjob(){
            $response = $this->razorpayorder(10);
            $result = ['error' => 0, 'status' => 200, 'key' => 'rzp_test_n2VHLMFV62PskX',  'data'=>$response];
            $this->set("result", $result);
        }


        private function razorpayorder($amt){
            $receipt_no = random_int(000001,999999);
            $amt = $amt * 100;
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "amount": '.$amt.',  
            "currency": "INR",
            "receipt": "' . $receipt_no . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic cnpwX3Rlc3RfbjJWSExNRlY2MlBza1g6Z0xwMkhGc0xhdmhmdjFvUGp3QU1nd1hG'
            ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response);
            // debug($response);
            // die;
            $payment = TableRegistry::get('Payments');
                $payment_Data= $this->Payments->newEmptyEntity();
                $payment_Data->order_id = $response->id;
                $payment_Data->entity = $response->entity;
                $payment_Data->amount =$response->amount;
                $payment_Data->amount_paid = $response->amount_paid;
                $payment_Data->amount_due = $response->amount_due;
                $payment_Data->currency = $response->currency;
                $payment_Data->receipt =$response->receipt;
                $payment_Data->offer_id = $response->offer_id;
                $payment_Data->status = $response->status;
                $payment_Data->created_at =$response->created_at;
                $payment_Data->description = 1;
                $payment->save( $payment_Data);
            
           

            return ($response);
            //$result = ['error' => 0, 'status' => 200, 'key' => 'rzp_test_n2VHLMFV62PskX',  'data'=>$response];
            //$this->set("result", $result);
    }

    public function paymentSuccess(){
        $result = [];
        $data = $this->request->getData() ;
        $appdata = json_decode($data['Payment_id']);
        $data2 = $appdata->response;
        // debug($data2);
        // die;
        $results =$this->Payments->find()
        ->where(['order_id' => $data2->razorpay_order_id])
        ->first(); 
     
        $userdata ['payment_response'] = $data2->razorpay_payment_id;
        $userdata ['signature'] = $data2->razorpay_signature; 
        $payment = $this->Payments->patchEntity($results,$userdata);
        $this->Payments->save($payment);
    //    debug($payment) ;
    //    die;
       $result = ['error' => 0, 'status' => 200];            
       $this->set("result", $result);
       
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
            $result = ['error'=>0,'status'=>200];    
          
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
            $result = ['error'=>0,'status'=>200];            
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
            ->where(['Crop.id'=>$data['id']])->contain(["User"])
            // ->select(['name','category', 'qty', 'price', 'location', 'photo', 'description', 'quality', 'location', 'address'])
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
            $results = $this->Crop->find('all')->order(['id' => 'DESC'])
            ->select(['id','name','category', 'qty', 'price','description', 'location', 'photo'])
            ->toArray();
            
            $result = ['error' => 0, 'status' => 200, 'data'=>$results ];
             $this->set("result", $result);
        }
        public function transportlist(){
            $result=[];
            $result['error'] = 0;
            $results = $this->Transportation->find('all')->order(['id' => 'DESC'])
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
            $usermobile = $this->User->find('all')
            ->select(['id'])
            ->where(['phone'=>$data['phone'] ])->toArray();
            if($usermobile!=0){
            $userdataRecord = $this->User->get( $usermobile[0]['id']);
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
            $usermobile = $this->User->find('all')
            ->select(['phone','id'])
            ->where(['phone'=>$data['phone'] ])->toArray();
            if(count($usermobile) == 1){  
                $d = $usermobile[0]['phone']; 
             
                        $otp = random_int(000001,999999);  
                        $this->Sms->forgotpasswordsmsotp( $d,  $otp);             
                        $currentTime = FrozenTime::now();
                       $newOtpEntity = $this->Onetimepassword->newEmptyEntity();
                       $newOtpEntity->phone = $usermobile[0]['phone'];                
                       $newOtpEntity->otp = $otp;
                       $newOtpEntity->createdon = date("Y-m-d");
                    if ($this->Onetimepassword->save($newOtpEntity)) {
                            $result['message'] = "OTP saved successfully"; 
                                 
                    } 
                    $result['OTP'] = $otp; 
                   $result['error'] = 0; 
            } 
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

    // public function editprofile(){
    //     $result = [];
    //     $result = ['error' => 1,];
    //     $this->request->is('post');
    //     $data = $this->request->getData(); 
    //     $results = $this->User->get($data['id']);        
    //         $userdata ['name'] = $data['username'];
    //         $userdata ['email'] = $data['email'];
    //         $userdata ['mobile'] = $data['phone'];
    //         $userdata ['profile_img'] =$this->Media->upload($data['photo'], 'User_img');
    //         $profiledata = $this->User->patchEntity($results,$userdata);
    //         $this->User->save( $profiledata);
       
    //     $result = [
    //         'error'=>0, 'status'=> 200, 'User'=> $results
    //    ];
    //     $this->set ("result",$result);
    // }
    public function editprofile(){
        $result = [];
        $result = ['error' => 1,];
        $this->request->is('post');
        $data = $this->request->getData(); 
        $results = $this->User->get($data['id']);        
            $userdata ['name'] = $data['username'];
            $userdata ['email'] = $data['email'];
            $userdata ['phone'] = $data['phone'];
            if ($data['photo'] instanceof \Laminas\Diactoros\UploadedFile && $data['photo']->getSize() > 0) {
            $userdata ['profile_img'] =$this->Media->upload($data['photo'], 'User_img');
            }
            $profiledata = $this->User->patchEntity($results,$userdata);
            $this->User->save( $profiledata);
       
        $result = [
            'error'=>0, 'status'=> 200, 'User'=> $results
       ];
        $this->set ("result",$result);
}

    public function transport(){
        $result=[];
        $result['error'] = 0;
        $results = $this->Transportation->find('all')
        ->toArray();
        $result = ['error' => 0, 'status' => 200, 'data'=>$results ];
         $this->set("result", $result);
    }
    
    public function personaltransport(){
        $result=[];
        $result['error'] = 0;
        $data = $this->request->getdata();
        $results = $this->Transportation->find('all')
        ->where(['user_id'=>$data['id']])->order(['id' => 'DESC'])->limit(1)
        ->toArray();
        $result = ['error' => 0, 'status' => 200, 'data'=>$results ];
         $this->set("result", $result);

}


    public function listcrop(){
         $data=$this->request->getdata();

        $result=[];
        $result['error'] = 0;
        $results = $this->Crop->find('all')
        // ->contain(['User'])
        ->order(['id' => 'DESC'])
        // ->where(['User.id'=>$data['id']])
        ->limit(5)
        ->toArray();
        // $userdata = $this->User->find('all')                        
        // ->select(['User.id', 'User.name', 'User.email', 'User.phone', 'User.profile_img',]) // Added 'User.user_id' to select                         ->contain(['Crop'])
        //                  ->where(['id'=>$data['id']])
        //                  ->toArray();
        $result = ['error' => 1, 'status' => 200, 'data'=>$results];
         $this->set("result", $result);
    }

    

    public function searchdata(){
        $result=[];
        $transportation = $this->Transportation->find('all')
        ->toArray();

        $crop = $this->Crop->find('all')
        ->toArray();
        $jobsdata = $this->Manpower->find('all')->toArray();
        $results = array_merge($transportation, $crop,$jobsdata);
        // debug($results);
        $result = ['error' => 0, 'status' => 200, 'data'=>$results ];
        $this->set("result", $result);
    }

    // // public function saveProfileImage(){

    // //     $result = [];
    // //     $result = ['error' => 1,];
    // //     $this->request->is('post');
    // //     $data = $this->request->getData(); 
    // //     // debug($data);
    // //     $user = $this->User->get($data['id']); 

    // //     $profileImagePath = $this->Media->upload($data['photo'], 'User_img');
    // //     if ($profileImagePath) {
    // //         $user->profile_img = $profileImagePath;
        
    // //         if ($this->User->save($user)) {
    // //         }
    // //     $result = [
    // //         'error'=>0, 'status'=> 200, 'User'=> $user
    // //    ];
    // //    $this->set ("result",$result);
    // //    }
    // // }
    // }


public function savejobs(){
    if($this->request->is('post')){
    $result=[];
          $data = $this->request->getData();           
            $addpT_Data = TableRegistry::get('manpower');
            $saved_Job = $this->Manpower->newEmptyEntity();
            $saved_Job->jobtitle= $data['title'];
            $saved_Job->user_id=$data['id'];
            $saved_Job->name=$data['name'];
            $saved_Job->location=$data['location'];
            $saved_Job->skills=$data['skills'];
            $saved_Job->phone=$data['phone'];
            $saved_Job->industry_id = $data['industry_id'];
            $saved_Job->is_hired= 0;
            $saved_Job->hired_by=0;
            $saved_Job->subscription_expiry = date('Y-m-d', strtotime('+30 days'));
            $saved_Job->expectedsalary = $data['expectedsalary'];

            $addpT_Data->save($saved_Job);
            $result = ['error'=>0,'status'=>200];
            $this->set("result", $result); 
            
    }  
    
}
public function idforjobs(){
    $result=[];
    $data = $this->request->getData(); 
    $username = $this->User->find('all')->where(['id'=>$data['id']])
        ->toArray();
        $result = ['error' => 0, 'status' => 200, 'data'=>$username ];
        $this->set("result", $result);}
   
 public function appliedjobs(){
    $data= $this->request->getdata();
    $jobsdata = $this->Manpower->find('all')->where(['user_id'=>$data['id']])
    ->toArray();
    $result = ['error' => 0, 'status' => 200, 'data'=>$jobsdata  ];
    $this->set("result", $result);
}  
    
    public function totaljobs(){
        $data= $this->request->getdata();
        // debug($data);
        // die;
        $jobsdata = $this->Manpower->find('all')->where(['industry_id'=> $data['id']])
        ->toArray();
        $result = ['error' => 0, 'status' => 200, 'data'=>$jobsdata  ];
        $this->set("result", $result);
    }
    public function editjobstatus(){
        $data= $this->request->getdata(); 
        $expiry =  intval($data['noofdays']);
        // debug($expiry);
        // die;
        $results = $this->Manpower->get($data['id']);
        $userdata ['is_hired'] = 1;
        $userdata ['hired_by'] = $data['memberid']; 
        $userdata ['noofdays'] = $data['noofdays'];
        $userdata ['expiry_on'] = date('Y-m-d', strtotime("+$expiry days"));   
        $profiledata = $this->Manpower->patchEntity($results,$userdata);
        // debug($profiledata);
        // die;
        $this->Manpower->save( $profiledata);
        $result = ['error' => 0, 'status' => 200,];  
        $this->set("result", $result);
    }

    public function getpage(){
        $data = $this->request->getData();
        $result['error'] = 0;
        if($data['id'] == 1) 
        {
            $result['content'] = 'Terms & Conditions';
        }
        else if($data['id'] == 2){
            $result['content'] = 'About';
        }
        else{
            $result['content'] = '';
        }
        
        $this->set("result", $result);
    }

    public function dailywork(){
        $result=[];
        $work = [
            'Construction',
            'Shopkeeper',
            'Server',
            'Cashier',
            'Helper',
            'Superviser',
            'Plumber',
            'Painter',
            'Electrician',
            'Carpenter',
        'Drivers',


        ];
        $result = ['error' => 0, 'status' => 200,'data'=> $work,];  
        $this->set("result", $result);
        // $this ->set([
        //     'status'=>200,
        //     'data'=> $work,
        // ]);
    }
public function industry(){
    $result=[];
    $industry = $this->Industry->find('all')->toArray();
    $result =['error'=>0,'status'=>200,'data'=>$industry];
    $this->set('result',$result);
}
public function blog(){
    $result=[];
    $blog = $this->blog->find('all')
    ->toArray();
    // debug($blog);
    $result = ['error' => 0, 'status' => 200, 'data'=>$blog ];
     $this->set("result", $result);
}

    }

   