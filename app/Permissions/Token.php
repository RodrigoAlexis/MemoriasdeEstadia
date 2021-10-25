<?php
require_once 'vendor/autoload.php';
require_once 'class-db.php';
 
define('ONEDRIVE_CLIENT_ID', 'CLIENT_ID_HERE');
define('ONEDRIVE_CLIENT_SECRET', 'CLIENT_SECRET_HERE');
define('ONEDRIVE_SCOPE', 'files.read files.read.all files.readwrite files.readwrite.all offline_access');
define('ONEDRIVE_CALLBACK_URL', 'CALLBACK_URL_HERE'); // in my case it is http://localhost/sajid/onedrive/callback.php
 
$config = [
    'callback' => ONEDRIVE_CALLBACK_URL,
    'keys'     => [
                    'id' => ONEDRIVE_CLIENT_ID,
                    'secret' => ONEDRIVE_CLIENT_SECRET
                ],
    'scope'    => ONEDRIVE_SCOPE,
    'authorize_url_parameters' => [
            'approval_prompt' => 'force',
            'access_type' => 'offline'
    ]
];
 
$adapter = new Hybridauth\Provider\MicrosoftGraph( $config );

require_once 'config.php';
 
try {
    $adapter->authenticate();
    $token = $adapter->getAccessToken();
    $db = new DB();
    if($db->is_table_empty()) {
        $db->update_access_token(json_encode($token));
        echo "Access token inserted successfully.";
    }
}
catch( Exception $e ){
    echo $e->getMessage() ;
}