<?php
/**
 * Example
 * 
 * 
        $data = array(
                'naam' => 'Dim',
                'leeftijd' => 'aaa',
                'email' => 'dimitri;casier@gmail.com'
                );

        $rules = array(
                'naam' => 'required',
                'leeftijd' => 'numeric',
                'email' => 'required|email'
                );
        // -- data valideren
        $v = new Validator();
        $v->validate($data, $rules);

        // -- reageren als de validatie niet geslaagd is
        if($v->failed()){
                print 'validation failed';
                var_dump($v->getMessages());
        }else{
                print 'validation ok';
        }//endif

 */
class Validator {

    private $messages = array();
    
    /**
     * De validatie regels toepassen op de data
     * 
     * @param array $data
     * @param array $rules
     */
    public function validate(array $data, array $rules) {
        // -- messages leegmaken
        $this->messages = array();
        // -- rules overlopen 
        foreach ($rules as $fld => $rule) {
            // -- waarde uit data halen
            $value = isset($data[$fld]) ? $data[$fld] : null;
            $split = explode('|', $rule);
            foreach ($split as $ruleSegment) {
                $this->applyRule($ruleSegment, $value, $fld);
            }//endforeach
        }//endforeach
    }

    /**
     * Controleren of validatie gefaald heeft
     * @return type
     */
    public function failed() {
        return !empty($this->messages);
    }

    /**
     * Validatieberichten opvragen
     * 
     * @return type
     */
    public function getMessages() {
        return $this->messages;
    }
    /**
     * De switch manier
     * 
     * @param type $rule
     * @param type $value
     * @param type $fld
     */
    private function _applyRule($rule, $value, $fld) {
        switch ($rule) {
            case 'required':
                if (is_null($value) || trim($value) == '')
                    $this->messages[$fld] = $fld . ' is required';
                    
                break;
            case 'numeric':
                if ( ! is_numeric($value))
                    $this->messages[$fld] = $fld . ' is not numeric';

                break;

            case 'email':
                if ( ! filter_var($value, FILTER_VALIDATE_EMAIL))
                    $this->messages[$fld] = $fld . ' is not an email';
                break;
        }
    }

    private function applyRule($rule, $value, $fld) {

        // -- checkt als er al een message is
        if (isset($this->messages[$fld]))
            return;

        // -- laadt class
        $class = ucfirst($rule);
       // $path = 'lib/rules/' . $class . '.php';
       // if (!file_exists($path))
       //     throw new Exception('not found: ' . $path);
        
       // include_once $path;

        // -- past rule toe
        $ruleObject = new $class($rule, $value, $fld);
        if (!$ruleObject->succeed())
            $this->messages[$fld] = $ruleObject->getMessage();
    }

}