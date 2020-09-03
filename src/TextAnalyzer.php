<?php

namespace wdmg\helpers;

/**
 * Yii2 Text analyzer helper
 *
 * @category        Helpers
 * @version         1.3.4
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @link            https://github.com/wdmg/yii2-helpers
 * @copyright       Copyright (c) 2019 - 2020 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 *
 */

use Yii;

class TextAnalyzer extends StringHelper
{

    public $min_length = 2;
    public $stop_words = ["c", "а", "алло", "без", "белый", "близко", "более", "больше", "большой", "будем", "будет", "будете", "будешь", "будто", "буду", "будут", "будь", "бы", "бывает", "бывь", "был", "была", "были", "было", "быть", "в", "важная", "важное", "важные", "важный", "вам", "вами", "вас", "ваш", "ваша", "ваше", "ваши", "вверх", "вдали", "вдруг", "ведь", "везде", "вернуться", "весь", "вечер", "взгляд", "взять", "вид", "видел", "видеть", "вместе", "вне", "вниз", "внизу", "во", "вода", "война", "вокруг", "вон", "вообще", "вопрос", "восемнадцатый", "восемнадцать", "восемь", "восьмой", "вот", "впрочем", "времени", "время", "все", "все еще", "всегда", "всего", "всем", "всеми", "всему", "всех", "всею", "всю", "всюду", "вся", "всё", "второй", "вы", "выйти", "г", "где", "главный", "глаз", "говорил", "говорит", "говорить", "год", "года", "году", "голова", "голос", "город", "да", "давать", "давно", "даже", "далекий", "далеко", "дальше", "даром", "дать", "два", "двадцатый", "двадцать", "две", "двенадцатый", "двенадцать", "дверь", "двух", "девятнадцатый", "девятнадцать", "девятый", "девять", "действительно", "дел", "делал", "делать", "делаю", "дело", "день", "деньги", "десятый", "десять", "для", "до", "довольно", "долго", "должен", "должно", "должный", "дом", "дорога", "друг", "другая", "другие", "других", "друго", "другое", "другой", "думать", "душа", "е", "его", "ее", "ей", "ему", "если", "есть", "еще", "ещё", "ею", "её", "ж", "ждать", "же", "жена", "женщина", "жизнь", "жить", "за", "занят", "занята", "занято", "заняты", "затем", "зато", "зачем", "здесь", "земля", "знать", "значит", "значить", "и", "иди", "идти", "из", "или", "им", "имеет", "имел", "именно", "иметь", "ими", "имя", "иногда", "их", "к", "каждая", "каждое", "каждые", "каждый", "кажется", "казаться", "как", "какая", "какой", "кем", "книга", "когда", "кого", "ком", "комната", "кому", "конец", "конечно", "которая", "которого", "которой", "которые", "который", "которых", "кроме", "кругом", "кто", "куда", "лежать", "лет", "ли", "лицо", "лишь", "лучше", "любить", "люди", "м", "маленький", "мало", "мать", "машина", "между", "меля", "менее", "меньше", "меня", "место", "миллионов", "мимо", "минута", "мир", "мира", "мне", "много", "многочисленная", "многочисленное", "многочисленные", "многочисленный", "мной", "мною", "мог", "могу", "могут", "мож", "может", "может быть", "можно", "можхо", "мои", "мой", "мор", "москва", "мочь", "моя", "моё", "мы", "на", "наверху", "над", "надо", "назад", "наиболее", "найти", "наконец", "нам", "нами", "народ", "нас", "начала", "начать", "наш", "наша", "наше", "наши", "не", "него", "недавно", "недалеко", "нее", "ней", "некоторый", "нельзя", "нем", "немного", "нему", "непрерывно", "нередко", "несколько", "нет", "нею", "неё", "ни", "нибудь", "ниже", "низко", "никакой", "никогда", "никто", "никуда", "ним", "ними", "них", "ничего", "ничто", "но", "новый", "нога", "ночь", "ну", "нужно", "нужный", "нх", "о", "об", "оба", "обычно", "один", "одиннадцатый", "одиннадцать", "однажды", "однако", "одного", "одной", "оказаться", "окно", "около", "он", "она", "они", "оно", "опять", "особенно", "остаться", "от", "ответить", "отец", "откуда", "отовсюду", "отсюда", "очень", "первый", "перед", "писать", "плечо", "по", "под", "подойди", "подумать", "пожалуйста", "позже", "пойти", "пока", "пол", "получить", "помнить", "понимать", "понять", "пор", "пора", "после", "последний", "посмотреть", "посреди", "потом", "потому", "почему", "почти", "правда", "прекрасно", "при", "про", "просто", "против", "процентов", "путь", "пятнадцатый", "пятнадцать", "пятый", "пять", "работа", "работать", "раз", "разве", "рано", "раньше", "ребенок", "решить", "россия", "рука", "русский", "ряд", "рядом", "с", "с кем", "сам", "сама", "сами", "самим", "самими", "самих", "само", "самого", "самой", "самом", "самому", "саму", "самый", "свет", "свое", "своего", "своей", "свои", "своих", "свой", "свою", "сделать", "сеаой", "себе", "себя", "сегодня", "седьмой", "сейчас", "семнадцатый", "семнадцать", "семь", "сидеть", "сила", "сих", "сказал", "сказала", "сказать", "сколько", "слишком", "слово", "случай", "смотреть", "сначала", "снова", "со", "собой", "собою", "советский", "совсем", "спасибо", "спросить", "сразу", "стал", "старый", "стать", "стол", "сторона", "стоять", "страна", "суть", "считать", "т", "та", "так", "такая", "также", "таки", "такие", "такое", "такой", "там", "твои", "твой", "твоя", "твоё", "те", "тебе", "тебя", "тем", "теми", "теперь", "тех", "то", "тобой", "тобою", "товарищ", "тогда", "того", "тоже", "только", "том", "тому", "тот", "тою", "третий", "три", "тринадцатый", "тринадцать", "ту", "туда", "тут", "ты", "тысяч", "у", "увидеть", "уж", "уже", "улица", "уметь", "утро", "хороший", "хорошо", "хотел бы", "хотеть", "хоть", "хотя", "хочешь", "час", "часто", "часть", "чаще", "чего", "человек", "чем", "чему", "через", "четвертый", "четыре", "четырнадцатый", "четырнадцать", "что", "чтоб", "чтобы", "чуть", "шестнадцатый", "шестнадцать", "шестой", "шесть", "эта", "эти", "этим", "этими", "этих", "это", "этого", "этой", "этом", "этому", "этот", "эту", "я", "являюсь"];
    public $weights = [
        'title' => 30,
        'meta-keywords' => 25,
        'meta-description' => 20,
        'h1' => 15,
        'h2' => 10,
        'h3' => 5,
        'h4' => 4,
        'h5' => 3,
        'h6' => 2,
        'strong' =>  1.8,
        'b' =>  1.8,
        'bold' =>  1.8,
        'em' =>  1.8,
        'i' =>  1.5,
        'italic' =>  1.5,
        '*' =>  1.5,
    ];

    private $_results = [];

    private $_symbols_count = 0;
    private $_symbols_count_clear = 0;

    private $_prominence_max = 1;
    private $_prominence_min = 0;
    private $_relevance_max = 1;
    private $_relevance_min = 0;

    /**
     * Prepares text and translates into an array of words
     *
     * @param $source
     * @param $stop_words
     * @param $min_length
     * @return array
     */
    private function prepare($source, $stop_words, $min_length) {

        // Add some airiness
        $source = str_replace('<', ' <', $source);
        $source = str_replace('>', '> ', $source);
        $source = str_replace("\n", " ", $source);
        $source = str_replace("<br />", " ", $source);
        $source = str_replace('  ', ' ', $source);

        // Clear from tags
        $text = strip_tags($source);

        // Punctuation clearing
        $text = preg_replace('/[^\w\s]/u', ' ', $text);

        // Count the number of characters with a space
        $this->_symbols_count = mb_strlen($text);

        $text = trim(preg_replace('/\s+/', ' ', $text));

        // Convert the string into an array of words
        $words = $this->string2array ($text, $stop_words, $min_length);
        return $words;

    }

    /**
     * Convert the string into an array of words
     *
     * @param $string
     * @return array
     */
    private function string2array($string, $stop_words, $min_length) {

        $words = mb_split(' +', $string);

        foreach ($words as &$word) {
            $word = trim($word);
        }

        // Counting the number of characters without a space
        $this->_symbols_count_clear = mb_strlen(implode('', $words));

        // All words into lower case
        $words = array_map('mb_strtolower', $words);

        // Delete stop words from an array of words
        $words = array_diff($words, $stop_words);

        // Filter words that are longer than 2 characters
        return array_filter($words, function ($word) use ($min_length) {
            return mb_strlen($word) > intval($min_length);
        });
    }

    /**
     * Analyzes the location of keywords in source tags
     * and assigns conditional weight to each such keyword
     *
     * @param $source
     * @param $stop_words
     * @param $min_length
     * @param $weights
     * @return array
     */
    private function analyze($source, $stop_words, $min_length, $weights)
    {
        $containers = [];
        $doc = new \DOMDocument();

        // Customize encoding to UTF-8
        $source = mb_convert_encoding($source, 'HTML-ENTITIES', "UTF-8");

        if ($doc->loadHTML('<?xml encoding="UTF-8">' . $source)) {
            if (is_array($weights)) {
                foreach ($weights as $tag => $weight) {

                    if ($tag == 'meta-keywords' || $tag == 'meta-description')
                        $elements = $doc->getElementsByTagName('meta');
                    else
                        $elements = $doc->getElementsByTagName($tag);

                    if (!$elements)
                        continue;

                    if (is_object($elements)) {
                        foreach ($elements as $element) {

                            if ($tag == 'keywords' || $tag == 'description') {
                                $string = $element->getAttribute('content');
                            } else {
                                $string = $element->textContent;
                            }

                            // Prepare the text and translation into an array of words
                            if ($words = $this->prepare($string, $stop_words, $min_length)) {
                                foreach ($words as $word) {
                                    if (isset($containers[$word])) {
                                        $containers[$word] = (intval($containers[$word]) + intval($weight) / 2);
                                    } else {
                                        $containers[$word] = $weight;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $containers;
    }

    /**
     * Start process to prepares and parses text for keywords
     *
     * @param $source the source text string | html
     * @return array
     */
    public function process($source) {

        $results = [];

        // Prepare the text and translation into an array of words
        $words = $this->prepare($source, $this->stop_words, $this->min_length);
        
        // Count the number of all words
        $words_count = count($words);
        
        // We determine the frequency of words, for this we uniquely identify an array of words
        $unique_words = array_unique($words);
        
        // and count the number of occurrences
        $unique_words_count = array_count_values($words);
        
        // Let's analyze the location of words in tags
        $containers = $this->analyze($source, $this->stop_words, $this->min_length, $this->weights);

        // Calculations
        foreach ($unique_words as $word) {

            // We determine the word density
            $density = ($unique_words_count[$word] / $words_count) * 100;

            // Determine the significance of the word depending on its position in the text, the words at the beginning are more important
            $keys = array_keys($words, $word);
            $position = array_sum($keys) + count($keys);
            $prominence = ($words_count - (($position - 1) / count($keys))) * (100 / $words_count);

            // Determine the significance of a word depending on the type of tag; words in the title and meta tags are more important
            $base = ((isset($containers[$word])) ? intval($containers[$word]) : 0.1) * count($containers);
            $relevance = (($density) * $prominence) * (($base) ? $base : 1);

            // Remember the minimal and maximal of the values
            if ($prominence > $this->_prominence_max)
                $this->_prominence_max = $prominence;
            elseif ($prominence < $this->_prominence_min)
                $this->_prominence_min = $prominence;

            if ($relevance > $this->_relevance_max)
                $this->_relevance_max = $relevance;
            elseif ($relevance < $this->_relevance_min)
                $this->_relevance_min = $relevance;

            $results[$word] = [
                'word' => $word,
                'count' => $unique_words_count[$word],
                'density' => round($density, 2),
                'prominence' => round($prominence, 2),
                'relevance' => round($relevance, 2)
            ];

        }

        // Normalization in%
        foreach ($results as &$result) {
            $result['prominence'] = round((((intval($result['prominence']) + abs($this->_prominence_min)) / ($this->_prominence_max + abs($this->_prominence_min))) * 100), 2);
            $result['relevance'] = round((((intval($result['relevance']) + abs($this->_relevance_min)) / ($this->_relevance_max + abs($this->_relevance_min))) * 100), 2);
            $result['mixin'] = ($result['prominence'] + $result['relevance']) / 2;
        }

        $this->_results['words'] = $results;
        $this->_results['stat'] = [
            'symbols_count' => $this->_symbols_count,
            'symbols_count_clear' => $this->_symbols_count_clear,
            'words_count' => $words_count,
            'words_count_unique' => count($unique_words_count)
        ];

        return $this->_results;
    }

    /**
     * Sort word meanings
     *
     * @param int $sorting sorting type, where 1 - by frequency of use, 2 - by prominence, 3 - by relevance, 4 - mixing prominence/relevance
     * @return array
     */
    public function sorting($sorting = 3) {

        uasort($this->_results['words'], function($a, $b) use ($sorting) {
            $result = 0;

            if ($sorting == 1)
                $cond = 'density';
            elseif ($sorting == 2)
                $cond = 'prominence';
            elseif ($sorting == 3)
                $cond = 'relevance';
            else
                $cond = 'mixin';

            if ($a[$cond] < $b[$cond])
                $result = 1;
            elseif ($a[$cond] > $b[$cond])
                $result = -1;

            return $result;
        });

        return $this->_results;
    }

    /**
     * Returns the top keywords based on sorting
     *
     * @param int $count number of words returned, 0 - unlimited
     * @param int $sorting sorting type, 3 - by default
     * @see sorting() function
     * @return array
     */
    public function keywords($count = 0, $sorting = 3) {

        $results = $this->sorting(intval($sorting));
        $words = $results['words'];

        if ($count)
            $keywords = array_slice($words, 0, intval($count));
        else
            $keywords = $words;

        return array_keys($keywords);
    }
}