<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 17-11-2017
 */

class AccountController extends Controller{

    const RESPONSE_SESSION = "accountResponse";

    public function __construct(){
        parent::__construct();
    }

    public function index() {
        if($this->valid)
            App::instance()->redirect('dashboard', 'index');
        return $this->login();
    }

    public function logout(){
        if($this->valid)
            $this->auth->destroy();
        App::instance()->redirect('account', 'login');
    }

    public function register(){
        if($this->valid)
            App::instance()->redirect('dashboard', 'index');
        $method = new Method($_POST);
        if(!$method->isEmpty()) {
            $user = preg_replace('/\s+/', '', $method->fetch('username', false, ""));
            $pass = preg_replace('/\s+/', '', $method->fetch('password', false, ""));
            $pass_validated = preg_replace('/\s+/', '', $method->fetch('password_validated', false, ""));
            if(!empty($pass) && !empty($user)&& $pass===$pass_validated){
                $handler = App::instance()->getDataSource()->getHandler();
                /** @noinspection PhpUnhandledExceptionInspection */
                $handler->insertInto(Auth::DB_TABLE)->values(array(
                    "Username" => $user,
                    "Password" => Security::encrypt($pass)
                ))->execute();
                $this->setResponse("Account is geregistreerd!");
            }else
                $this->setResponse("Account kon niet geregistreerd worden.");
        }
        return new View("login");

    }

    public function login(){
        $method = new Method($_POST);
        if($method->isEmpty()) return new View("login");
        else{
            $user = $method->fetch('username');
            $pass = $method->fetch('password');
            $handler = App::instance()->getDataSource()->getHandler();
            $response = $handler->from(Auth::DB_TABLE)->where('Username', $user);
            if($response->count() > 0){
                $id = $response->fetch('ID');
                $validated = $response->fetch('Validated');
                $hash = $response->fetch('Password');
                if($validated && Security::valid($pass, $hash)){
                    /** @noinspection PhpUnhandledExceptionInspection */
                    $handler->update(Auth::DB_TABLE)
                        ->set(array( 'Token' => $token = Security::getToken()))
                        ->where('ID', $id)
                        ->execute();
                    $auth = new Auth();
                    $auth->invalidate(new Client($id, $token));
                    App::instance()->redirect('dashboard', 'index');
                }
            }
            $this->setResponse("Foutieve inlogpoging: Probeer het opnieuw.");
            return new View("login");
        }
    }

    /**
     * Set a new response message
     * @param $msg String message
     */
    private function setResponse($msg){
        $_SESSION[self::RESPONSE_SESSION] = $msg;
    }

    /**
     * Returns the current response message if there is one
     * @return String message
     */
    public static function getResponse(){
        $msg = isset($_SESSION[self::RESPONSE_SESSION]) ? $_SESSION[self::RESPONSE_SESSION] : "";
        unset($_SESSION[self::RESPONSE_SESSION]);
        return $msg;
    }

} 