<?php
/**
 * Plugin Name: Buddy Rest Api 
 * 
 * PLugin URI:
 *
 * Description: This Plugin Is used To 
 * 
 * Version:0.0.1
 * 
 * Author: Divyraj Chavda
 * 
 * Author URI: www.google.com
 *
 */
if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
Class My_Rest_Controller
 {

    public function __construct()
    {
        $this->namespace = '/custom-buddy/v1';
    }

  
    public function register_routes()
    {

        register_rest_route( $this->namespace, '/all_demo', array(
            array(
                'methods'   => 'POST',
                'callback'  => array( $this, 'test_demo' ),
                 'pemission callback' => array($this,'get_items_permissions_check'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/get_xprofile_data', array(
            array(
                'methods'   => 'POST',
                'callback'  => array( $this, 'get_xprofile' ),
                 'pemission callback' => array($this,'get_items_permissions_check'),
            )
        ) );

        register_rest_route( $this->namespace, '/create_users', array(
            array(
                'methods'   => 'POST',
                'callback'  => array( $this, 'create_users' ),
                 'pemission callback' => array($this,'get_items_permissions_check'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/get_all_friends', array(
            array(
                'methods'   => 'POST',
                'callback'  => array( $this, 'get_friends' ),
                 'pemission callback' => array($this,'get_items_permissions_check'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/get_activity_motify', array(
            array(
                'methods'   => 'POST',
                'callback'  => array( $this, 'activity_notification' ),
                 'pemission callback' => array($this,'get_items_permissions_check'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/get_friends_motify', array(
            array(
                'methods'   => 'POST',
                'callback'  => array( $this, 'friends_notification' ),
                 'pemission callback' => array($this,'get_items_permissions_check'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/get_message_motify', array(
            array(
                'methods'   => 'POST',
                'callback'  => array( $this, 'message_notification' ),
                 'pemission callback' => array($this,'get_items_permissions_check'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/get_comments_motify', array(
            array(
                'methods'   => 'POST',
                'callback'  => array( $this, 'comments_notification' ),
                 'pemission callback' => array($this,'get_items_permissions_check'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/get_conversion', array(
            array(
                'methods'   => 'POST',
                'callback'  => array( $this, 'message_conversion' ),
                 'pemission callback' => array($this,'get_items_permissions_check'),
            )
        ) );

        register_rest_route($this->namespace,'reset_password',array(
            array(
                'methods' => 'POST',
                'callback' => array($this,'reset_password'),
                //'pemission callback' => array($this,'get_items_permissions_check'),
            )
        ));

        register_rest_route( $this->namespace, '/check_reset_password', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'check_reset_password_string'),
            )
        ) );

        register_rest_route( $this->namespace, '/update_user_password', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'update_password'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/get_unread_message', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'unread_message'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/send_request', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'send_friend_request'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/accept_request', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'accept_friend_request'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/get_all_activity', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'get_activity_by_user_id'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/get_all_stared_Messages', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'get_stared_message'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/cancel_request', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'cancel_friend_request'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/upload_image', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'upload_image'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/request_pending', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'pending_request'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/get_all_message_by_user_id', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'get_message_user_id'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/get_all_friends_by_user_id', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'get_friendship_by_user_id'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/get_friends_request', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'get_all_friend_requests'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/get_all_stared_activity', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'stared_activity'),
            )
        ) );
        
        register_rest_route( $this->namespace, '/send_message', array(
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'compose_message'),
            )
        ) );

    }

    public function err_query_response(){
        return $res = [
            "status" => 500,
            "message" => "Something Went Wrong. Please Contact Admin."
        ];
    }
    
    public function test_demo(){
        return "Testing api";
    }

    /**************************************************************************
     * >this function to create user 
     *  give three parameter value like user_name,email,password,mobile.
     * 
     * >if users email is already in database then user cant be register 
     *  give message email is already in database 
     *  use another email.
     * 
     * >if users email not registerd in database then create user
     *  then its return user_id.
     * 
     ***************************************************************************/
    public function create_users(){
        global $wpdb;
        $user_name = $_POST['user_name'];
        $email= $_POST['email'];
        $password= $_POST['password'];
        $mobile = $_POST['mobile'];

        if($user_name != null && $email != null && $password != null && $mobile !=null){
            $exists = email_exists($email);
            if($exists){
                $data = $email."email is already in database";
                return $data;
            }else{
                $user_id=wp_create_user($user_name,$email,$password,$mobile);
                if(is_object($user_id)){
                    return $user_id;
                }
                else{
                    return $user_id;
                }
            }
        }
        else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    /*********************************************************
     * >this function function to genrate a random string .
     * 
     * >random string length 5 
     * 
     * >return random string like 'St4hn'.
     * 
     **********************************************************/
    function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /******************************************************
     * >this function to reset passwrod 
     * 
     * >give one parameters email then its return
     *  one time password (otp) and give email.
     * 
     * >give message email send successfully.
     * 
     * 
     * 
     *****************************************************/
    public function reset_password(){
        global $wpdb;
        $email = $_POST['email'];
        if($email != null){
            $data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."users WHERE user_email='".$email."'");
            if($data != null){
                $random = $this->generateRandomString(5);
                $result = update_user_meta($data->ID,'reset_password_token',$random);
                if($result != null){
                    // send mail with random string.
                    return $res = [
                        'status' => 200,
                        'message' => "Email Send Successfully....",
                        'data' => $random
                    ];
                }else{
                    return $res = [
                        'status' => 500,
                        'message' => "Something Went Wrong !"
                    ];
                }
                
            }else{
                return $res = [
                    'status' => 400,
                    'message' => 'This Email is Not Registered in Database Please Use Another Email.'
                ];
            }
        }else{
            return $res = [
                'status' => 500,
                'message' => 'Required Email For Reset Password , Please Enter Email.'
            ];
        }
    }

    /***********************************************
     * >give 2 parameters otp adn email otp retrive in reset_password()
     *  
     * >then input otp and email if otp and email is matched then return
     *  email and user all data.
     * 
     * >if otp matched then matched then display data 
     *  otherwise send message otp doesnt match.
     * 
     * 
     *************************************************/
    public function check_reset_password_string(){
        global $wpdb;
        $string = $_POST['otp'];
        $email = $_POST['email'];
        if($string != null && $email != null){
            $data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."users WHERE user_email='".$email."'");
            if($data != null){
                $stored_string = get_user_meta($data->ID,'reset_password_token',true);
                if($stored_string == $string){
                    return $res = [
                        'status' => 200,
                        'message' => 'Opt Matched.',
                        'data' => $data
                    ];
                }else{
                    return $res = [
                        'status' => 400,
                        'message' => 'Opt is Not Matched Enter Again.'
                    ];
                }
            }else{
                return $res = [
                    'status' => 400,
                    'message' => 'This Email is Not Registered in Database Use Another Email;.'
                ];
            }
        }else{
            return $res = [
                'status' => 500,
                'message' => 'Requested Param Missing Full Fill All Fields.'
            ];
        }
    }

    /**********************************************
     * >in this function give 2 parameters user_id or 
     *  our new password 
     * 
     * >if all parameters all inputed then password 
     *  change successfully 
     * 
     * >otherwise send message parameters are missing
     * 
     * 
     *********************************************/
    public function update_password(){
        $user_id = $_POST['user_id'];
        $new_password = $_POST['password'];
        if($user_id != null && $new_password != null){
            $data = wp_set_password($new_password,$user_id);
            return $res = [
                'status' => 200,
                'message' => 'Password Changed Sucessfully.'
            ];
        }else{
            return $res = [
                'status' => 400,
                'message' => 'Requested Params Missing Full Fill All Fields.'
            ];
        }
    }

    /***************************************************
     * >using this function we get our social profile 
     *  or our user information 
     * 
     * >input only 1 parameter user_id then display 
     *  user_id profile.
     * 
     ***************************************************/
    public function get_xprofile(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        
        if($user_id != null){
            $results['xprofile'] = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_xprofile_data WHERE user_id = ".$user_id);
            $results['users'] = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."users WHERE ID =".$user_id);       
            return $results;
        }
        else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    /*************************************************
     * 
     * >in this function all details of 
     *  our user friends
     * 
     *************************************************/
    public function get_friends(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        if($user_id != null ){
            $friends = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_friends WHERE initiator_user_id = ".$user_id);
            return $friends;
        }else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    /************************************************
     * >this function give notification of 
     *  our activities 
     * 
     * >if any new activity available then 
     *  display by user id
     * 
     * 
     ***********************************************/
    public function activity_notification(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        if($user_id != null ){
            $notify = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_notifications WHERE (user_id = ".$user_id." ) AND component_name = 'activity'");
            return $notify;
        }else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    /*********************************************
     * >this function to display friend request
     *  
     * >if any users friends request is pending 
     *  but accepted then send notification
     * 
     * 
     ********************************************/
    public function friends_notification(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        if($user_id != null ){
            $notify = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_notifications WHERE (user_id = ".$user_id." ) AND component_name = 'friends'");
            return $notify;
        }else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    /********************************************
     * >if any new message of user then 
     *  display in notification 
     * 
     * 
     ********************************************/
    public function message_notification(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        if($user_id != null ){
            $notify = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_notifications WHERE (user_id = ".$user_id." ) AND component_name = 'messages'");
            return $notify;
        }else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    /*******************************************
     * >if any friend send messages 
     *  then user have unread message 
     *  notification 
     * 
     * 
     *******************************************/
    public function unread_message(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        if($user_id != null ){
            $notify = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_notifications WHERE (user_id = ".$user_id." ) AND is_new = 1");
            return $notify;
        }else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    //Comment notification........
    public function comments_notification(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        if($user_id != null ){
            $notify = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_notifications WHERE (user_id = ".$user_id." ) AND component_name = 'comments'");
            return $notify;
        }else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    //Pending......................................................Work
    public function message_conversion(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        
        if( $user_id != null){
            
            $result = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_messages_recipients WHERE user_id = ".$user_id);
            return $result;
        }else{
            return $con;
        }
    }

    /*******************************************
     * >using this function to send 
     *  friend request to our other
     *  friends 
     * 
     *>if your friends on database then 
     * possibale 
     * 
     * 
     *******************************************/
    public function send_friend_request(){
        global $wpdb;
        $sender_id = $_POST['sender_id']; 
        $friend_id = $_POST['friend_id'];
        if($sender_id != null && $friend_id != null){
            $results = $wpdb->insert(
                $wpdb->prefix."bp_friends", 
                array(
                    // 'id' => NULL,
                    'initiator_user_id' => $sender_id,
                    'friend_user_id' => $friend_id,
                    'is_confirmed' => 0,
                    'is_limited' => 0,
                    'date_created' => '2019-04-23 03:00:00'
                ),
                array(
                    '%d',
                    '%d',
                    '%d',
                    '%d',
                    '%s'
                )
            );
            $row = $wpdb->insert_id;
            if($row){
                return $result =[
                    'status' =>200,
                    'data' =>$row,
                    'message' =>"Send Successfully."
                ];
            }else{
                return $result = [
                    "status" => 500,
                    "message" => "Something went wrong. please check all your params."
                ];
            }
        }else{
            return $res = [
                "status" => 400,
                "message" => "Please Insert User ID ."
            ];
        }
    }

    /*******************************************
     * >this function to use accept your friend
     *  reques.
     * 
     *******************************************/
    public function accept_friend_request(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        $friend_id = $_POST['friend_id'];
        if($user_id != null && $friend_id != null){
            $result = $wpdb->update(
                $wpdb->prefix."bp_friends",
                array( 'is_confirmed' => 1 ),
                array( 'initiator_user_id' => $user_id, 'friend_user_id' => $friend_id )
            );
            
            if($result != null){
                return $res = [
                    "status" => 200,
                    "data" => true,
                    "message" => "Friend Request Accepted."
                ];
            }else{
                return $res = [
                    "status" => 500,
                    "message" => "Please Check All Your Params."
                ];
            }
        }else{
            return $res = [
                "status" => 400,
                "message" => "Please Insert User ID and Friend Id ."
            ];
        }

    }

    /***************************************
     * >get all activity of specific user
     * 
     * 
     * 
     ***************************************/
    public function get_activity_by_user_id(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        if($user_id != null ){
            $res = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_activity WHERE user_id = ".$user_id);
            return $res;
        }else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    /***************************************
     * >if u have important message then 
     *  select as stared 
     * 
     * >then this message stored as stared
     ***************************************/
    public function get_stared_message(){
        global $wpdb;
        $message_id = $_POST['message_id'];
        if($message_id != null ){
            $res = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_messages_meta WHERE message_id = ".$message_id);
            return $res;
        }else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    /**************************************
     * >if user wants to cancel friend
     *  request then this function used.
     * 
     * >give user_id and friend_id 
     *  their are 2 parameters
     * 
     **************************************/
    public function cancel_friend_request(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        $friend_id = $_POST['friend_id'];
        if($user_id != null && $friend_id != null ){
            $res = $wpdb->get_results("UPDATE ".$wpdb->prefix."bp_friends SET is_confirmed = 0 WHERE initiator_user_id = ".$user_id." AND friend_user_id = ".$friend_id);
            return "Request Cancled";
        }else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    /********************************************
     * > using this function we can upload image 
     *   and this function give url of image.
     * 
     * 
     ********************************************/
    function upload_image(){
        global $wpdb;
        if($_FILES['file'] != null){
            $uploadedfile = $_FILES['file'];
            $upload_overrides = ['test_form' => false ];
            $movefile = wp_handle_upload( $uploadedfile,$upload_overrides );
            if($movefile && ! isset($movefile['error'])){
                return $movefile['url'];
            }else{
                return $movefile['error'];
            }
        }else{
            return "missing file.";
        }
    }

    /***************************************
     * >one user send request to another 
     *  this user not accept the request 
     *  this this request on pending request
     *  using this 
     * 
     ***************************************/
    public function pending_request(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        
        if($user_id != null){
            $res = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_friends WHERE initiator_user_id = ".$user_id." AND is_confirmed = 0");
            return $res ;
        }else{  
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    /**************************************
     * >get all conversion or messages by
     *  user id then this function is use
     * 
     *
     **************************************/
    public function get_message_user_id(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        if($user_id != null){
            $res = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_messages_messages WHERE sender_id = ".$user_id);
            return $res;
        }else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    /********************************************
     * >get all friends list by user id
     *  then this function use and their also
     *  give users profile data
     * 
     * 
     ********************************************/
    public function get_friendship_by_user_id(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        
        if($user_id != null){
            $res['friendships'] = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_friends WHERE initiator_user_id = ".$user_id." AND is_confirmed = 1");
            $res['profile_data'] = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."users WHERE ID = ".$user_id);
            return $res;
        }else{
            return $res = [
                "status" => 400,
                "message" => "Userid is Not Found."
            ];
        }            
    }

    /*******************************************
     * >if so many people request to other
     *  user then get all friend request 
     *  list using this function.
     *  
     ********************************************/
    public function get_all_friend_requests(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        
        if($user_id != null){
            $res = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_friends WHERE friend_user_id = ".$user_id." AND is_confirmed = 0");
            return $res;
        }else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }         
    }

    /********************************************
     * >if u have important activity then 
     *  select as stared 
     * 
     * >then this activity stored as stared
     ********************************************/
    public function stared_activity(){
        global $wpdb;
        $user_id = $_POST['user_id'];
        if($user_id != null ){
            $res = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bp_activity WHERE user_id = ".$user_id);
            return $res;
        }else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    public function remove_activity(){
        global $wpdb;
        $activity_id = $_POST['activity_id'];
        if(activity_id != null){
            $results = $wpdb->delete(
                $wpdb->prefix."bp_activity",
                array(
                    'ID' => $activity_id
                )
            );
            if($results){
                return $res = [
                    'status' => 200,
                    'message' => "Activity Remove successfully."
                ];
            }
            else{
                return $res = [
                    'status' => 500,
                    'message' => "Something Went Wrong."
                ];
            }
        }else{
            return $res = [
                "status" => 400,
                "message" => "Param is Missing."
            ];
        }
    }

    public function compose_message(){
        global $wpdb;
        $res = $wpdb->get_row("SELECT thread_id FROM wp_bp_messages_recipients ORDER BY id DESC LIMIT 1");
        $thrd= $res->thread_id + 1;

        $user_id = $_POST['user_id'];
        $friend_id = $_POST['friend_id'];
       
        if($user_id != null && $friend_id != null){
            $results = $wpdb->insert(
                $wpdb->prefix."bp_messages_recipients", 
                array(
                    'user_id' => $user_id,
                    'thread_id' => $thrd,
                    'unread_count' => 0,
                    'sender_only' => 0,
                    'is_deleted' => 0
                ),
                array(
                    '%d',
                    '%d',
                    '%d',
                    '%d',
                    '%d'
                )
            );
            $result = $wpdb->insert(
                $wpdb->prefix."bp_messages_recipients",
                array(
                    'user_id' => $friend_id,
                    'thread_id' => $thrd,
                    'unread_count' => 0,
                    'sender_only' => 0,
                    'is_deleted' => 0
                ),
                array(
                    '%d',
                    '%d',
                    '%d',
                    '%d',
                    '%d'
                )
            );
            $row = $wpdb->insert_id;
            if($row){
                return $result =[
                    'status' =>200,
                    'data' =>$row,
                    'message' => "Message Sent Successfully."
                ];
            }else{
                return $result = [
                    "status" => 500,
                    "message" => "Something went wrong. please check all your params."
                ];
            }
        }else{
            return $res = [
                "status" => 400,
                "message" => "Please Insert User ID ."
            ];
        }
    }


}

function prefix_register_my_rest_routes() {

    $controller = new My_Rest_Controller();
    $controller->register_routes();

}
 
add_action( 'rest_api_init', 'prefix_register_my_rest_routes' );

?>