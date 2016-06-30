<?php

class JsonFile {

    protected $file = null;

    public function __construct($file) {
        $this->file = $file;
    }

    public function read() {
        
        if (!file_exists($this->file))
            return array();
        
        // -- lees inhoud
        $jsonList = file_get_contents($this->file);
        if ($jsonList === false)
            return false;

        // -- zet json om naar array
        return json_decode($jsonList, true);
    }

    public function write(array $list) {
        $jsonList = json_encode($list);

        return file_put_contents($this->file, $jsonList);
    }

    public function setFile($file) {
        $this->file = $file;
    }

}

?>
