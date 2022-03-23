<?php

class repository_dspacerepo extends repository {
    
	public $default_rest_url = "https://repositorio.uci.cu/rest/";
    public $api_url = "";
	
    public function __construct($repositoryid, $context = SYSCONTEXTID, $options = array(), $readonly=0) {
        parent::__construct($repositoryid, $context, $options, $readonly);
        $this->api_url = get_config('dspacerepo', 'dspace_url');
    }


    function supported_returntypes() {

     return  FILE_EXTERNAL;

    }

    function supported_filetypes() {
        return '*';
    }

    public static function get_type_option_names() {
        
	//Observación: En las versiones actuales se hace de esta manera	
	return array_merge(parent::get_type_option_names(), array('dspace_url'));

	//$option_names = array('dspace_url');
        //return $option_names;
    }

	//Observación: La documentacion dice que debe ser 
	//public static function type_config_form($mform, $classname='repository')  

    public static function type_config_form($mform, $classname='repository') {
        parent::type_config_form($mform);
	
        $dspaceUrl = get_config('dspacerepo', 'dspace_url');
		
        //$mform->addElement('text', 'dspace_url', get_string('dspace_url', 'repository_dspacerepo'), array('value' => $dspaceUrl,'size' => '60'));
        //Observación: no se especifica el value en la documentacion actual
	    $mform->addElement('text', 'dspace_url', get_string('dspace_url', 'repository_dspacerepo'), array('size' => '200'));
        //Hacemos requerido la url del repositorio
        $mform->addRule('dspace_url', get_string('required'), 'required', null, 'client');

		//Observación: Si no estecifico tipo da un warning
        $mform->setType('dspace_url', PARAM_TEXT);
        
        //Observación: Pudiera poner por defecto el dspace de la UCI?
        //$mform->setDefault('dspace_url', $default_rest_url);
        
    }

/*
    //Observación: Puede tener una validacion de dspace_url
    type_form_validation($mform, $data, $errors)
    This function must be declared static
    Optional. Use this function if you need to validate some variables submitted by plugin settings form. To use it, check through the associative array of data provided ('settingname' => value) for any errors. Then push the items to $error array in the format ("fieldname" => "human readable error message") to have them highlighted in the form.
    
    With the example above, this function may look like:
    */
    // public static function type_form_validation($mform, $data, $errors) {
    //     if (!is_dir($data['dspace_url'])) {
    //         $errors['dspace_url'] = get_string('invaliddspaceurl', 'repository_dspacerepo');
    //     }
    //     return $errors;
    // }
    



    // Listing
    function get_listing($path="/", $page="") {
        global $CFG;
        global $OUTPUT;

        $pathArray = explode("/", $path);

        $list = array();
        $list['nologin'] = true;
        $list['dynload'] = true;
        $list['nosearch'] = true;
        $list['list'] = array();
        
        
        //Filtramos el path por communities y collections y agregamos unos iconos

        if(count($pathArray)<=2) {
            $results = $this->call_api("GET", "communities");
			
            foreach($results as $result) {
                $list['list'][] = array(
					'dynload'=>true,
                    'title' => $result->name,
                    'children'=> array(),
                    'icon' => $CFG->wwwroot."/repository/dspacerepo/pix/com.jpeg",
                    'path' =>  $result->link,
                );
            } 
			$list['path'] = array(array('name'=>'Comunidades','path'=>'/'));

			
        }
        elseif(array_search("communities",$pathArray)){
            //print_r($path);
            $results_communities = $this->call_api("GET", str_replace("/rest/","",$path)."/?expand=subCommunities");
            foreach($results_communities->subcommunities as $result) {

                $list['list'][] = array(
                    'dynload'=>true,
                    'title' => $result->name,
                    'children'=> array(),
					'path' => $result->link,
                    'icon' => $CFG->wwwroot."/repository/dspacerepo/pix/com.jpeg", 
                );
            } 

		    $results_collections = $this->call_api("GET", str_replace("/rest/","",$path)."/?expand=collections");
            foreach($results_collections->collections as $result) {
                $list['list'][] = array(
                    'dynload'=>true,
                    'title' => $result->name,
                    'children'=> array(),
					'path' => $result->link,
                    'icon' => $CFG->wwwroot."/repository/dspacerepo/pix/col.jpeg", 
                );
            }            

		   $list['path'] = array(array('name'=>'Comunidades','path'=>'/'), array('name'=>$results_communities->name, 'path'=>$path ));
           
           //$this->supported_returntypes()->FILE_EXTERNAL;
        }
        
        elseif(array_search("collections",$pathArray)){
            //print_r($path);
		    $results = $this->call_api("GET", str_replace("/rest/","",$path)."/?expand=items");
			//print_r($results);
           
        
        /////////////////////////////
        $countItems= count($results->items);
        

        $meta = array();
        $license  = optional_param('license', $CFG->sitedefaultlicense, PARAM_TEXT);
                      
        foreach($results->items as $result) {
            $meta = $this->call_api("GET", "items/".$result->id ."/?expand=metadata");
            $mdata = $this->call_api("GET", "items/".$result->id ."/metadata");
            ///Palacios:hacemos un arreglo por referencia
            $metar = array();
            //$meta->metadata[$i]->key

            for($i=0; $i<count($meta[0]->metadata);$i++){
                $metar[$meta[0]->metadata[$i]->key]=$meta[0]->metadata[$i]->value;
           }


            //$indexItem = 0;
            //foreach ($mdata->metadataentry as $m ) {
            //     die($m.'<-');
                //$indexItem++;
                
                //$metar[$m->key]=$m->value;
            //}

            //var_dump($meta[0]->metadata[0]->value);
            //var_dump($metar);
            
                $dateItem = explode("-",$metar["dc.date.available"] );
                $day = $dateItem[2][0] . $dateItem[2][1];
                $hour = $dateItem[2][3] . $dateItem[2][4];
                $minute = $dateItem[2][6] . $dateItem[2][7];
                $second = $dateItem[2][9] . $dateItem[2][10];
                $date = mktime($hour, $minute, $second, $dateItem[1], $day, $dateItem[0]);


            $list['list'][] = array(
                'dynload'=>true,
                'title' => $result->name,
                'url' => str_replace("rest","handle",$this->api_url).$result->handle,
                'source' => str_replace("rest","handle",$this->api_url).$result->handle,
                //'title'=> $metar["dc.title"],
                //'url' => $metar["dc.identifier.uri"],
                //'source' => $metar["dc.identifier.uri"],
                'author' => $metar["dc.contributor.author"],
                'license' => $license,
                'date' => $date,
            );


         }
       
    //     $list['path'] = array(array('name'=>'items','path'=>'/'), array('name'=>$pathArray[1], 'path'=>'/'.$pathArray[1]));
        
    // }
        /////////////////////////
        
        
        
		   $list['path'] = array(array('name'=>'Comunidades','path'=>'/'), array('name'=>$result->name, 'path'=>$path ));
           
           //$this->supported_returntypes()->FILE_EXTERNAL;
        }
        else{
            $list['path'] = array(array('name'=>'Comunidades','path'=>'/'));
        }

       
           
		 

        return $list; 
    }



    // REST

    function call_api($method, $endpoint, $data = false)
    {
	
        $curl = curl_init();

        $url = $this->api_url.$endpoint;
		
        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        } 

        curl_setopt($curl, CURLOPT_URL, $url);
		    curl_setopt($curl, CURLOPT_VERBOSE, true);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));

        $result = curl_exec($curl);

        curl_close($curl);

        return json_decode($result); 
    }
	 public function set_option($options = array()) {
        if (!empty($options['dspace_url'])) {
            set_config('dspace_url', trim($options['dspace_url']), 'dspacerepo');
        }
        unset($options['dspace_url']);
        $ret = parent::set_option($options);
        return $ret;
     }
    public function get_option($config = '') {
        if ( $config == 'dspace_url') {
            return trim(get_config('dspacerepo', $config));
        }

        $options = parent::get_option($config);
        return $options;
    }




}

