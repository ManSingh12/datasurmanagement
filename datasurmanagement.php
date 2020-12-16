
<?php
use WHMCS\Database\Capsule;
    
    
    if (!defined("WHMCS")) 
    {
        die("This file cannot be accessed directly");
    }
    
    function datasurmanagement_config()
    {
        return [
            // Display name for your module
            'name' => 'Datasur Management',
            // Description displayed within the admin interface
            'description' => 'This module provides a reporting WHMCS Addon Module'
                . ' which can be used as a sales,services and marketing addon module.',
            // Module author name
            'author' => 'WHMCS Global Services',
            // Default language
            'language' => 'english',
            // Version number
            'version' => '1.0',
            'fields' => [
                // a text field type allows for single line text input
                
            ]
        ];
    }

    function datasurmanagement_activate()
    {
        try {
                if(!Capsule::schema()->hasTable('datasur_clientsfile'))
                {
                    Capsule::schema()
                    ->create(
                        'datasur_clientsfile',
                        function ($table) {
                            /** @var \Illuminate\Database\Schema\Blueprint $table */
                            $table->increments('id');
                            $table->integer('userid');
                            $table->string('file_name');
                            $table->string('description');
                            $table->timestamps();
                        }
                    );
                }
                if(!Capsule::schema()->hasTable('datasur_tblleads'))
                {
                    Capsule::schema()
                    ->create(
                        'datasur_tblleads',
                        function ($table) {
                            /** @var \Illuminate\Database\Schema\Blueprint $table */
                            $table->increments('id');
                            $table->string('label');
                            $table->string('description');
                            $table->string('comment');
                            $table->boolean('proposal_prepare');
                            $table->boolean('proposal_sent');
                            $table->boolean('feedback');
                            $table->boolean('ops');
                            $table->timestamps();
                        }
                    );
                }
            
                $allRecord =  Capsule::table('tblcustomfields')->where('fieldname','like','%How_did_you_Find_us%')->count(); 
                if($allRecord==0)
                {
                    $insert_array = [
                        "type" => 'client',
                        "fieldname" => 'How_did_you_Find_us | How did you Find us?',
                        "fieldtype"=>'dropdown',
                        "fieldoptions"=>'Facebook, Google, Linked In, Twitter',
                        "showorder"=>'on',
                    
                    ];
                    $res=Capsule::table('tblcustomfields')->insert($insert_array);
                }
    
            return [
                // Supported values here include: success, error or info
                'status' => 'success',
                'description' => 'Table created',
            ];
        } catch (\Exception $e) {
            return [
                // Supported values here include: success, error or info
                'status' => "error",
                'description' => 'Unable to create:' . $e->getMessage(),
            ];
        }
    }

   
    function datasurmanagement_deactivate()
    {
       try {
            return [
                // Supported values here include: success, error or info
                'status' => 'success',
                'description' => '',
            ];
        } catch (\Exception $e) {
            return [
                // Supported values here include: success, error or info
                "status" => "error",
                "description" => "Unable to drop : {$e->getMessage()}",
            ];
        }
    }
    
    function datasurmanagement_output($vars)
    {
       
        // Get common module parameters
        $modulelink = $vars['modulelink']; // eg. addonmodules.php?module=addonmodule
        $version = $vars['version']; // eg. 1.0
        $_lang = $vars['_lang']; // an array of the currently loaded language variables
        $style_css= "../modules/addons/datasurmanagement/assets/css/style.css";
        $fonts_css="../modules/addons/datasurmanagement/assets/css/fonts.css";
        $gcustom_css="../modules/addons/datasurmanagement/assets/css/gcustom.css";
        $custom_js="../modules/addons/datasurmanagement/assets/js/custom.js";
        $pdf_valid_js="../modules/addons/datasurmanagement/assets/js/pdf_valid.js";
        $download_path="../modules/addons/datasurmanagement/uploads/";
        // $upload_pdf_dir=__DIR__;
        // echo $upload_pdf_dir;
        if(file_exists("".__DIR__."/lib/classes.php"))
        {
            include("".__DIR__."/lib/classes.php"); 
             
        }
        $datasur_obj=new Datasur_namespace\Datasur();
        
        if(file_exists("".__DIR__."/includes/request_handler.php"))
        {
            include("".__DIR__."/includes/request_handler.php");    
        }
        // $clients= $datasur_obj->wgs_fetch_table_record_datasur('tblclients',null,null,null,null,'allData');
        // echo $clients;
        // die(); 
        if(file_exists( "".__DIR__."/includes/action.php"))
        {
            include("".__DIR__."/includes/action.php");   
        }
       
        // $datasur_obj=new Datasur();
        
        
    }
    function datasurmanagement_clientarea($vars) {
        $modulelink = $vars['modulelink'];
        $version = $vars['version'];
        $LANG = $vars['_lang'];
        $uid=$_SESSION['uid'];
        $allRecord =  Capsule::table('datasur_clientsfile')->where('userid',$uid)->get();
        $clientDetails=['details'=>$allRecord];
        return array(
                'pagetitle' => 'Details',
                'breadcrumb' => array('index.php?m=datasurmanagement'=>'Details'),
                'templatefile' => 'clienthome',
                'requirelogin' => true, # accepts true/false
                'vars' => $clientDetails,
            );
            
        // echo "hello";
     
    }


?>