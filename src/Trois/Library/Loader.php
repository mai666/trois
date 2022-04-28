<?php

namespace Trois\Library;

class Loader
{
    /**
     * 匹配的字符串内容
     * @var string
     */
    private $html;
    /**
     * 匹配的哪个标签 img a ...
     * @var string
     */
    private $tag;

    /**
     * 匹配的标签的属性
     * @var string
     */
    private $attr;

    /**
     * 匹配到的内容
     * @var array
     */
    private $matches;

    public function __construct($html, $tag = 'img', $attr = 'src')
    {
        $this->html = $html;
        $this->tag = $tag;
        $this->attr = $attr;
    }

    /**
     * 匹配符合规则的内容
     */
    public function getMatches()
    {
        $pattern = '/<' . $this->tag . '[^>]*?' . $this->attr . '="([^"]*?)"[^>]*?>/i';
        preg_match_all($pattern, $this->html, $matches);
        $this->matches = $matches[1];
    }

    /**
     * 整理匹配后的结果
     * @return array
     */
    public function getMatchesList()
    {
        foreach ($this->matches as $k => $v) {
            $this->matches[$k] = str_replace('&#47;', '/', $v);
        }
        return $this->matches;
    }
}