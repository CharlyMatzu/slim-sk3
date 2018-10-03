<?php namespace App\Persistence;

use App\Exceptions\PersistenceException;
use App\Exceptions\RequestException;
use App\Includes\Responses;
use App\Includes\SingletonExample;
use App\Model\People;

class DummySingleton
{
    private static $instance;

    const READ_ONLY_TOP     = "r";
    const READ_WRITE_TOP    = "r+";
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


    /**
     * write on file
     *
     * @param $data array data to write
     * @throws PersistenceException
     */
    private function writeOnCSV( $data ){
        try{
            $handle = fopen(ROOT_PATH . DS . "media" . DS . "dummy.csv", self::READ_WRITE_TOP);
            //get header for CSV
            $header = fgets($handle);

            $dataToWrite = "";
            foreach ( $data as $item )
                $dataToWrite .= implode(",", $item) . PHP_EOL; // FIXME cuidar las comas dentro de comillas

            //concat header with data
            $str = $header . PHP_EOL . $dataToWrite;
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
     * @throws RequestException
     */
    public function getAll(  ){
        try {
            $data = $this->readCSV(self::READ_ONLY_TOP);
        } catch (PersistenceException $e) {
            throw new RequestException( Responses::INTERNAL_SERVER_ERROR, $e->getMessage() );
        }


        if( empty($data) )
            throw new RequestException( Responses::NO_CONTENT, "There are not dummy data" );

        return $data;
    }


    /**
     * @param $search
     * @return array|false|null
     * @throws RequestException
     */
    public function searchDummy($search){
        $data = $this->getAll();

        $content = [];
        foreach( $data as $dummy ){
            $str = implode(",", $dummy); // FIXME cuidar las comas dentro de comillas
            if( stripos( $str, $search ) !== false )
                $content[] = $dummy;
        }

        if( empty($content) )
            throw new RequestException( Responses::NO_CONTENT, "Not data found" );

        return $content;
    }


    /**
     * @param $id
     * @return void
     * @throws RequestException
     */
    public function removeDummy_ById($id){
        $data = $this->getAll();

        $content = $data;
        $index = 0;
        foreach ( $content as $item ){
            if( $index === $id ) {
                unset( $content[$index] );
                break;
            }
            $index++;
        }

        //compare
        if( count($data) == count($content) )
            throw new RequestException( Responses::NOT_FOUND, "ID does not exist" );

        //write
        try {
            $this->writeOnCSV($content);
        } catch (PersistenceException $e) {
            throw new RequestException( Responses::INTERNAL_SERVER_ERROR, $e->getMessage() );
        }
    }

}