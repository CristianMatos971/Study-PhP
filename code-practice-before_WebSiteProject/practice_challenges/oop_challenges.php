<?php

$output = null;

//challenge 1: 

class Article
{
    public $title;
    public $content;
    private $published = false;

    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function publish()
    {
        $this->published = true;
    }

    public function isPublished()
    {
        return $this->published;
    }
}

$a1 = new Article('first article', 'exampleContent');
$a2 = new Article('second article', 'secondExampleContent');

$a1->publish();

var_dump($a1);
echo '<br/>';
var_dump($a2);

//challenge 2: 

class StringUtility
{
    public static function shout($string)
    {
        return strtoupper($string) . '!!';
    }

    public static function whisper($string)
    {
        return strtolower($string) . '!';
    }

    public static function repeat($string, $times = 2)
    {
        $out_str = '';
        for ($i = 0; $i < $times; $i++)
            $out_str .= $string . ' ';
        return $out_str;
    }
}

echo '<br/>';
echo StringUtility::shout('you should be a calmer person');
echo '<br/>';
echo StringUtility::whisper('STOP SCREAMING MAN');
echo '<br/>';
echo StringUtility::repeat('I told you not to do that!', 3);
