<?php
class Cookie {
    /* cookie $term */ 
    private $term = "";

    /* cookie life $time */
    private $time = false;

    /* cookie  $name */
    private $username = false;

    private $jsonterm = "";

    public function __construct ($username , $term,$jsonterm , $time = 3600) {
        $this->term = $term;
        $this->time = $time;  
        $this->username = $username; 
        $this->jsonterm = $jsonterm;   
        setcookie( $username,$term , $jsonterm,   time() + $time, '/');           

    }
    
    public function getterm()
    {
        return $this->term;
    }
   

    public function destroy() {
        $this->time =  -1;
    }   
}
?>