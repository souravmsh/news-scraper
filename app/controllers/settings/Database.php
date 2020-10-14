<?php 
class Database extends CI_Controller{

    public function __construct(){ 
        parent::__construct(); 
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->database();
    } 

    private $sql_path = "assets/data/sql/";
    private $csv_path = "assets/data/csv/";

    function csv(){
        $tables = $this->db->list_tables();
        foreach ($tables as $table):
            $file = date("dMY")."_$table.csv";
            $query = $this->db->query("select * from $table"); 
            $delimiter = ",";
            $newline = "\r\n";
            $enclosure = '"';
            $data = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
            write_file("assets/data/csv/$file", $data);  
            // force_download($file, $data);
        endforeach;
    }

    function import($file = NULL){ 
        $csv_file = $this->csv_path; // Name of your CSV file
        echo $table = explode('.',explode('-', $csv_file)[1])[0];
        if (($handle = fopen($csv_file, "r")) !== FALSE):
            while (($data = fgetcsv($handle, 1024, ",")) !== FALSE) {
                $csvData = array(
                    'account_id'       => $this->security->xss_clean($data[0]),
                    'sector_name'      => $this->security->xss_clean($data[1]),
                    'sector_type'      => $this->security->xss_clean($data[2]),
                    'status'           => $this->security->xss_clean($data[3]),
                    'date'             => $this->security->xss_clean($data[4]),
                ); 
                if($this->db->insert($table,$csvData)):
                    echo "row inserted\n";
                else:
                    echo die(mysql_error());
                endif;
            }
            fclose($handle);
            echo "CSV data successfully imported to table!!"; 
        endif;
    }

    /*
     * @function name - backup 
     * @author - Md. Shohrab Hossain
     * @created on - 25/07/2015
     */

    public function sql() { 
        # Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup(); 
        # ---------------------------------------- 
        $file_path = $this->sql_path;
        $path_explode = @explode('/', $file_path);
        if (!is_dir($file_path)) {
            @mkdir($path_explode[0], 0755);
            @mkdir($path_explode[0] . '/' . $path_explode[1], 0755);
            @mkdir($path_explode[0] . '/' . $path_explode[1] . '/' . $path_explode[2], 0755);
            @mkdir($path_explode[0] . '/' . $path_explode[1] . '/' . $path_explode[2] . '/' . $path_explode[3], 0755);
        }
        # ----------------------------------------
        write_file($file_path . date('dMY') . "_db.sql.gz", $backup); 
        force_download( date('dMY') . "_db.sql.gz", $backup);
    }



}