<?php

namespace Goodby\CSV\Import\Tests\Standard\Join;

use Mockery as m;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\Config;

use Goodby\CSV\Import\Tests\Standard\Join\CSVFiles;

class LexerTest extends \PHPUnit_Framework_TestCase
{
    public function test_shift_jis_CSV()
    {
        $shiftJisCsv = CSVFiles::getShiftJisCsv();
        $lines = array(
            array('あ', 'い', 'う', 'え', 'お'),
            array('日本語', '日本語', '日本語', '日本語', '日本語'),
            array('ぱ', 'ぴ', 'ぷ', 'ぺ', 'ぽ'),
            array('"quoted"', "a'quote'", 'a, b and c', '', ''),
        );

        $interpreter = $this->getMock('Goodby\CSV\Import\Standard\Interpreter', array('interpret'));
        $interpreter->expects($this->at(0))->method('interpret')->with($lines[0]);
        $interpreter->expects($this->at(1))->method('interpret')->with($lines[1]);
        $interpreter->expects($this->at(2))->method('interpret')->with($lines[2]);
        $interpreter->expects($this->at(3))->method('interpret')->with($lines[3]);

        $config = new Config();
        $config->setToCharset('UTF-8')->setFromCharset('SJIS-win');
        $lexer = new Lexer($config);
        $lexer->parse($shiftJisCsv, $interpreter);
    }

    public function test_mac_excel_csv()
    {
        $csv   = CSVFiles::getMacExcelCsv();
        $lines = CSVFiles::getMacExcelLines();

        $interpreter = $this->getMock('Goodby\CSV\Import\Standard\Interpreter', array('interpret'));
        $interpreter->expects($this->at(0))->method('interpret')->with($lines[0]);
        $interpreter->expects($this->at(1))->method('interpret')->with($lines[1]);

        $config = new Config();
        $lexer = new Lexer($config);
        $lexer->parse($csv, $interpreter);
    }
}