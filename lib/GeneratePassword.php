<?php

namespace Lib;

use Lib\Constants as Constants;

/**
 * GeneratePassword class
 * 
 * @author Niesuch
 */
class GeneratePassword {

    /**
     * The length of the generated password
     * @var int
     */
    private $_length;

    /**
     * Number of passwords to be generated
     * @var int
     */
    private $_count;

    /**
     * Types of characters to be used in the password
     * @var array
     */
    private $_characters;

    /**
     * Class constructor 
     */
    public function __construct() {
        $this->_length = Constants::DEFAULT_LENGTH;
        $this->_count = Constants::DEFAULT_COUNT;
        $this->_characters = [
            Constants::LOWERCASE,
            Constants::UPPERCASE,
            Constants::NUMBERS,
            Constants::SPECIALSYMBOLS
        ];
    }

    /**
     * Get length value
     * @return int
     */
    public function getLength() {
        return $this->_length;
    }

    /**
     * Get count value
     * @return int
     */
    public function getCount() {
        return $this->_count;
    }

    /**
     * Get characters array
     * @return array
     */
    public function getCharacters() {
        return $this->_characters;
    }

    /**
     * Set length value
     * @param int $value
     */
    public function setLength($value) {
        if ($value > Constants::MAX_LENGTH) {
            trigger_error('Max length should be ' . Constants::MAX_LENGTH . '.', E_USER_ERROR);
        }
        
        if ($value < Constants::MIN_LENGTH) {
            trigger_error('Min length should be ' . Constants::MIN_LENGTH . '.', E_USER_ERROR);
        }

        if ($value <= 0) {
            trigger_error('Length should be more than 0.', E_USER_ERROR);
        }

        $this->_length = $value;
    }

    /**
     * Set count value
     * @param int $value
     */
    public function setCount($value) {
        if ($value > Constants::MAX_COUNT) {
            trigger_error('Max count should be ' . Constants::MAX_COUNT . '.', E_USER_ERROR);
        }
        
        if ($value < Constants::MIN_COUNT) {
            trigger_error('Min count should be ' . Constants::MIN_COUNT . '.', E_USER_ERROR);
        }

        if ($value <= 0) {
            trigger_error('Count should be more than 0.', E_USER_ERROR);
        }

        $this->_count = $value;
    }

    /**
     * Set characters array
     * @param array $array
     */
    public function setCharacters($array) {
        if (empty($array)) {
            trigger_error('Symbol type not selected.', E_USER_ERROR);
        }

        $this->_characters = $array;
    }

    /**
     * Get symbols based on choosen type
     * @param string $type
     * @return string
     */
    function getSymbols($type) {
        if ($type == Constants::LOWERCASE) {
            return 'abcdefghijklmnopqrstuvwxyz';
        } elseif ($type == Constants::UPPERCASE) {
            return 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } elseif ($type == Constants::NUMBERS) {
            return '1234567890';
        } elseif ($type == Constants::SPECIALSYMBOLS) {
            return '!@#$%^&*()-_=+[]{}\\|;:\'"<>,.?/';
        } else {
            trigger_error('Bad type of symbols.', E_USER_ERROR);
        }
    }

    /**
     * Generate random password based on user configuration
     * @return array
     */
    function generate() {
        $passwords = [];
        $usedSymbols = '';

        foreach ($this->_characters as $value) {
            $usedSymbols .= $this->getSymbols($value);
        }

        for ($i = 0; $i < $this->_count; $i++) {
            $temp = '';

            for ($j = 0; $j < $this->_length; $j++) {
                $temp .= $usedSymbols[rand(0, strlen($usedSymbols) - 1)];
            }

            $passwords[] = $temp;
        }

        return $passwords;
    }

}
