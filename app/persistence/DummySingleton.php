<?php namespace App\Persistence;

use App\Exceptions\PersistenceException;
use App\Exceptions\RequestException;
use App\Includes\Responses;
use App\Includes\SingletonExample;
use App\Model\User;
use App\Model\People;

class DummySingleton
{
    private static $instance;

    const READ_ONLY_TOP     = "r";
    const READ_WRITE_TOP    = "r+";
    const WRITE_ONLY_ZERO   = "w";
    const READ_WRITE_ZERO   = "w+";
    const READ_ONLY_BOTTOM  = "a";
    const READ_WRITE_BOTTOM = "a+";

    // SingletonExample instance

    /**
     * @return DummySingleton
     */
    public static function getInstance()
    {
        if (!isset( self::$instance )) {
            $myClass = __CLASS__;
            self::$instance = new $myClass;
        }
        return self::$instance;
    }

    public function __clone() { trigger_error("Clone of this class is forbidden"); }

    private function __construct() { }


    //----------------PERSISTENCE METHODS

    /**
     * @param $method String method for file read
     * @return array|false|null
     * @throws PersistenceException
     */
    private function readCSV( $method )
    {
        try{
            $handle = fopen(ROOT_PATH . DS . "media" . DS . "dummy.csv", $method);
            // fgets() Gets a line from file pointer and read the first line from $handle and ignore it.
            $header = fgets($handle);
            // While loop used here and  fgetcsv() parses the line it reads for fields in CSV format and returns an array containing the fields read.
            ini_set('auto_detect_line_endings', true);

            $content = [];
            while ( ($data = fgetcsv($handle)) !== false ){
                if( !empty($data) || count($data) < 7 )
                    $content[] = $data;
            }

            //close file
            if( $method === self::READ_ONLY_TOP || $method === self::READ_ONLY_BOTTOM )
                fclose($handle);

            return $content;
        }catch (\Exception $ex){
            throw new PersistenceException($ex->getMessage());
        }
    }

    private function concatToWrite( $dummy ){
        $str = $dummy[0] .",".
            $dummy[1] .",".
            $dummy[2] .",".
            $dummy[3] .",".
            $dummy[4] .",".
            $dummy[5] .",".
            $dummy[6] .",".
            $dummy[7] .",".
            "\"". $dummy[8] ."\"" . PHP_EOL; // adding slash quotes to join coordinates as a same word and ignore comma separator
        return $str;
    }


    /**
     * write on file
     *
     * @param $data array data to write
     * @throws PersistenceException
     */
    private function writeOnCSV( $data ){
        try{
            $handle = fopen(ROOT_PATH . DS . "media" . DS . "dummy.csv", self::READ_ONLY_TOP);
            // getting header for CSV (first line)
            $header = fgets($handle);
            fclose($handle);

            $dataToWrite = "";
            foreach ( $data as $item )
                $dataToWrite .= $this->concatToWrite( $item );

            //concat header with data
            $handle = fopen(ROOT_PATH . DS . "media" . DS . "dummy.csv", self::WRITE_ONLY_ZERO); //Remove all content
            $str = $header . $dataToWrite;
            fwrite($handle, $str);
            fclose($handle);

        }catch (\Exception $ex){
            throw new PersistenceException($ex->getMessage());
        }
    }


    /**
     * Get all dummies on the CSV
     *
     * @return array|false|null
     * @throws PersistenceException
     */
    public function getAll(  ){
        $data = $this->readCSV(self::READ_ONLY_TOP);
        // if data is empty
        if( empty($data) )
            return null;

        return $data;
    }


    /**
     * @param $search
     * @return array|null
     * @throws PersistenceException
     */
    public function searchDummy($search){
        $data = $this->readCSV( self::READ_ONLY_TOP );

        $content = [];
        foreach( $data as $dummy ){
            $str = implode( ",", $dummy); // all values in the same string
            if( stripos( $str, $search ) !== false )
                $content[] = $dummy;
        }

        if( empty($content) )
            return null;

        return $content;
    }


    /**
     * @param $dummy User
     * @return bool TRUE if success
     * @throws PersistenceException
     */
    public function addDummy( $dummy ){
        $data = $this->getAll();
        $new_id = 1;
        $last = 0;

        if( !empty($data) ) {
            $last = count($data);
            $new_id = (int) $data[ $last -1 ][0] + 1;
        }
        // add id for new dummy
        $dummy->setId( $new_id );

        $data[ $last ] = [
            $dummy->getId(),
            $dummy->getNames(),
            $dummy->getEmail(),
            $dummy->getCompany(),
            $dummy->getAddress(),
            $dummy->getCity(),
            $dummy->getZip(),
            $dummy->getCountry(),
            $dummy->getCoordinates()
        ];
        //write data
        $this->writeOnCSV($data);
        return true;

    }


    /**
     * @param $id int dummy's id
     * @return bool TRUE success, FALSE if element was no removed or not found
     * @throws PersistenceException
     */
    public function removeDummy_ById( $id ){
        $data = $this->getAll();

        $content = $data;
        $index = 0;
        foreach ( $content as $item ){
            if( $item[0] === "".$id ) {
                unset( $content[$index] );
                break;
            }
            $index++;
        }

        // compare original with new
        if( count($data) == count($content) )
            return false;

        //write data
        $this->writeOnCSV($content);
        return true;
    }



}