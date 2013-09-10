<?php
require_once (realpath(dirname(__FILE__)) . '/classes/SpeedTyping.php');
?>
<html>
<head>
    <title>V2 Question 2 - Speed Typing</title>
    <style type="text/css">
        table.keyboard {
            font-family: verdana,arial,sans-serif;
            font-size:11px;
            color:#333333;
            border-width: 1px;
            border-color: #666666;
            border-collapse: collapse;
        }
        table.keyboard td {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #ffffff;
            text-align: center;
            width: 40px;
        }
    </style>
</head>
<body>
<?php
$speedTyping = new SpeedTyping();
$speedTyping->showKeyboard();

$string = 'AbCaBc!$&*()';
echo '<hr />';
$output  = $speedTyping->stringConversion($string);
var_dump($output, $string);

echo '<hr />';
$speedTyping->getKeyboardPosition($string);
?>
</body>
</html>
