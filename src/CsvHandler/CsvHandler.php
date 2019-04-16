<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 16/04/2019
 * Time: 12:29
 */
namespace CsvHandler;

class CsvHandler
{
    /**
     * @var null
     */
    private $delimiter;

    /**
     * @var null
     */
    private $file;

    /**
     * @var array|null
     */
    private $mapping = ['documentValue' => 'newValue'];

    /**
     * @var bool
     */
    private $rowToObjects; // default true returns each row as object false returns as array

    /**
     * CsvHandler constructor.
     * @param null $file
     * @param null $mapping
     * @param bool $rowToObjects
     * @param null $delimiter
     */
    public function __construct(
        $file = null, $mapping = null, $rowToObjects = true, $delimiter = null)
    {
        $this->file = $file;
        $this->mapping = $mapping;
        $this->rowToObjects = $rowToObjects;
        $this->delimiter = $delimiter;
    }

    /**
     * @return array|bool|string
     */
    public function getData()
    {
        $errorMessage = $this->passCheck();
        return ( $errorMessage === false ) ? $this->processRequest() : $errorMessage;
    }

    /**
     * @return bool|string
     */
    private function passCheck()
    {
        if (!$this->file) {
            return 'no file';
        }
        return false;
    }

    /**
     * @return array
     */
    private function processRequest()
    {
        if (!$this->delimiter || $this->delimiter ===',') {

            $rows = array_map('str_getcsv', file($this->file));
        } else {

            $rows = array_map( function( $row ) {
                return str_getcsv($row, $this->delimiter);
            },
                file($this->file)
            );
        }
        $header = array_shift($rows);
        $csv    = array();
        foreach($rows as $row) {
            $csv[] = array_combine($header, $row);
        }

        return ( $this->mapping ) ? $this->returnMapped( $csv ) : $csv;
    }

    /**
     * @param $data
     * @return array
     */
    public function returnMapped( $data )
    {
        $items = array();
        foreach ( $data as $row ) {
            $items[] = $this->buildObject($row);
        }
        return  $items;
    }

    /**
     * @param $data
     * @return array|object
     */
    public function buildObject($data)
    {
        $result = array();
        foreach ($data as $key => $value) {
            if (array_key_exists( $key, $this->mapping)) {
                $key = $this->mapping[$key];
                $result[$key] = $value;
            }
        }
        return ($this->rowToObjects === true) ? (object)$result : $result;
    }
}
