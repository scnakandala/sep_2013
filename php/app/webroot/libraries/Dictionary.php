<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Class for Dictionary Data Structure
 * 
 * Copyright (c) 2013 Supun Nakandala
 * Version 1.0 released 14 August 2013
 */
class Dictionary implements ArrayAccess {

    private $_keys = array();
    private $_values = array();

    public function offsetExists($key) {
        return false !== array_search($key, $this->_keys, true);
    }

    public function offsetGet($key) {
        if (false === ( $index = array_search($key, $this->_keys, true) )) {
            //throw new OutOfBoundsException('Invalid dictionary key');
            return false;
        }

        if (!isset($this->_values[$index])) {
            throw new LogicException('No matching value found for dictionary key');
        }
        
        return $this->_values[$index];
    }

    public function offsetSet($key, $value) {
        if (false !== ( $index = array_search($key, $this->_keys, true) )) {
            $this->_values[$index] = $value;
        } else {
            $this->_keys[] = $key;
            $this->_values[] = $value;
        }
    }

    public function offsetUnset($key) {
        if (false === ( $index = array_search($key, $this->_keys, true) )) {
            //throw new OutOfBoundsException('Invalid dictionary key');
            return false;
        }

        if (!isset($this->_values[$index])) {
            throw new LogicException('No matching value found for dictionary key');
        }

        array_splice($this->_keys, $index, 1);
        array_splice($this->_values, $index, 1);
    }
}
?>
