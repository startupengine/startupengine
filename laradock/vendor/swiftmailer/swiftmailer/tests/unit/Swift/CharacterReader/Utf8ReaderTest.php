<?php

class Swift_CharacterReader_Utf8ReaderTest extends \PHPUnit\Framework\TestCase
{
    private $reader;

    protected function setUp()
    {
        $this->reader = new Swift_CharacterReader_Utf8Reader();
    }

    public function testLeading7BitOctetCausesReturnZero()
    {
        for ($ordinal = 0x00; $ordinal <= 0x7f; ++$ordinal) {
            $this->assertSame(
                0,
                $this->reader->validateByteSequence([$ordinal], 1)
            );
        }
    }

    public function testLeadingByteOf2OctetCharCausesReturn1()
    {
        for ($octet = 0xc0; $octet <= 0xdf; ++$octet) {
            $this->assertSame(
                1,
                $this->reader->validateByteSequence([$octet], 1)
            );
        }
    }

    public function testLeadingByteOf3OctetCharCausesReturn2()
    {
        for ($octet = 0xe0; $octet <= 0xef; ++$octet) {
            $this->assertSame(
                2,
                $this->reader->validateByteSequence([$octet], 1)
            );
        }
    }

    public function testLeadingByteOf4OctetCharCausesReturn3()
    {
        for ($octet = 0xf0; $octet <= 0xf7; ++$octet) {
            $this->assertSame(
                3,
                $this->reader->validateByteSequence([$octet], 1)
            );
        }
    }

    public function testLeadingByteOf5OctetCharCausesReturn4()
    {
        for ($octet = 0xf8; $octet <= 0xfb; ++$octet) {
            $this->assertSame(
                4,
                $this->reader->validateByteSequence([$octet], 1)
            );
        }
    }

    public function testLeadingByteOf6OctetCharCausesReturn5()
    {
        for ($octet = 0xfc; $octet <= 0xfd; ++$octet) {
            $this->assertSame(
                5,
                $this->reader->validateByteSequence([$octet], 1)
            );
        }
    }
}
