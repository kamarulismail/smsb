<?php

/**
 * Description of SpeedTyping
 *
 * @author Kamarul Ariffin Ismail <kamarul.ismail@gmail.com>
 */
class SpeedTyping {
    protected $_onscreenKeyboard = array();
    protected $_htmlEntities     = array();

    public function __construct() {
        //ROW 1
        $_onscreenKeyboard[0] = range('A', 'Z');

        //ROW 2
        $_onscreenKeyboard[1] = range('a', 'z');

        //ROW 3
        $row3 = array(
            'EXCLAMATION_POINT',
            'AT_SYMBOL',
            'NUMBER_SIGN',
            'DOLLAR_SIGN',
            'PERCENT_SIGN',
            'CARET',
            'AMPERSAND',
            'ASTERISK',
            'OPENING_PARENTHESIS',
            'CLOSING_PARENTHESIS',
            'QUESTION_MARK',
            'SLASH',
            'VERTICAL_BAR',
            'BACKSLASH',
            'PLUS_SIGN',
            'MINUS_SIGN'
        );
        $_onscreenKeyboard[2] = array_merge(range('0', '9'), $row3);

        //ROW 4
        $row4 = array(
            'GRAVE_ACCENT',
            'TILDE',
            'OPENING_BRACKET',
            'CLOSING_BRACKET',
            'OPENING_BRACE',
            'CLOSING_BRACE',
            'LESS_THAN_SIGN',
            'GREATER_THAN_SIGN',
            'EMPTY_SPACE',
            'SPACE', 'SPACE', 'SPACE', 'SPACE', 'SPACE', 'SPACE', 'SPACE',
            'PERIOD',
            'COMMA',
            'SEMICOLON',
            'COLON',
            'SINGLE_QUOTE',
            'DOUBLE_QUOTES',
            'UNDERSCORE',
            'EQUAL_SIGN',
            'BACKSPACE', 'BACKSPACE'
        );
        $_onscreenKeyboard[3] = $row4;

        //
        $this->_onscreenKeyboard = $_onscreenKeyboard;

        //
        $_htmlEntities = array(
            'EXCLAMATION_POINT'     => '&#33',
            'AT_SYMBOL'             => '&#64;',
            'NUMBER_SIGN'           => '&#35;',
            'DOLLAR_SIGN'           => '&#36;',
            'PERCENT_SIGN'          => '&#37;',
            'CARET'                 => '&#94;',
            'AMPERSAND'             => '&#38;',
            'ASTERISK'              => '&#42;',
            'OPENING_PARENTHESIS'   => '&#40;',
            'CLOSING_PARENTHESIS'   => '&#41;',
            'QUESTION_MARK'         => '&#63;',
            'SLASH'                 => '&#47;',
            'VERTICAL_BAR'          => '&#124;',
            'BACKSLASH'             => '&#92;',
            'PLUS_SIGN'             => '&#43;',
            'MINUS_SIGN'            => '&#45;',
            'GRAVE_ACCENT'          => '&#96;',
            'TILDE'                 => '&#126;',
            'OPENING_BRACKET'       => '&#91;',
            'CLOSING_BRACKET'       => '&#93;',
            'OPENING_BRACE'         => '&#123;',
            'CLOSING_BRACE'         => '&#125;',
            'LESS_THAN_SIGN'        => '&#60;',
            'GREATER_THAN_SIGN'     => '&#62;',
            'EMPTY_SPACE'           => '&nbsp;',
            'PERIOD'                => '&#46;',
            'COMMA'                 => '&#44;',
            'SEMICOLON'             => '&#59;',
            'COLON'                 => '&#58;',
            'SINGLE_QUOTE'          => '&#39;',
            'DOUBLE_QUOTES'         => '&#34;',
            'UNDERSCORE'            => '&#95;',
            'EQUAL_SIGN'            => '&#61;',
            'BACKSPACE'             => 'BS'
        );
        $this->_htmlEntities = $_htmlEntities;
    }

    public function showKeyboard(){
        $_htmlEntities = $this->_htmlEntities;
        echo '<table class="keyboard">';
        foreach($this->_onscreenKeyboard as $row){
            echo '<tr>'  . PHP_EOL;
            $keyCount = count($row);
            for($keyIndex = 0; $keyIndex < $keyCount; $keyIndex++){
                $key = $row[$keyIndex];
                $key = isset($_htmlEntities[$key]) ? $_htmlEntities[$key] : $key;
                echo "<td><b>{$key}</b></td>" . PHP_EOL;
            }
            echo '</tr>' . PHP_EOL;
        }
        echo '</table>';
    }

    public function stringConversion($string){
        $output = str_split($string);
        foreach ($output as $charIndex => $char) {
            if(preg_match('([A-Z]|[a-z]|[0-9])', $char)){
                continue;
            }

            $output[$charIndex] = '&#' . ord($char) . ';';
        }
        return $output;
    }

    public function getKeyboardPosition($string){
        $charList      = $this->stringConversion($string);
        $_keyboard     = $this->_onscreenKeyboard;
        $_htmlEntities = $this->_htmlEntities;

        $result = array();
        foreach($charList as $char){
            foreach($_keyboard as $rowIndex => $row){
                if($char[0] === '&'){
                    $row = $_htmlEntities;
                }
                //var_dump($row);
                foreach($row as $columnIndex => $key){
                    if($key == $char){
                        var_dump($key, "Found {$char} | R({$rowIndex}) | C({$columnIndex})");
                        echo '<hr />';
                        break 2;
                    }
                }

            }
        }
    }
}

?>
