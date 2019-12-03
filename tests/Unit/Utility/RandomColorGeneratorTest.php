<?php

namespace Tests\Unit\Utility;

use App\Utility\RandomColorGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RandomColorGeneratorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testGenerateHexReturnsValidHexadecimalColorString()
    {
        $generator = new RandomColorGenerator();

        for ($x = 0; $x < 1000; $x++) {
            $color = $generator->generateHex();

            if (!preg_match("/^#[a-f0-9]{6}$/", $color)) {
                $this->fail();
            }

        }

        $this->assertTrue(true);
    }

    public function testGenerateHexWithLightSubsetReturnsLighterColorString()
    {
        $generator = new RandomColorGenerator();

        for ($x = 0; $x < 1000; $x++) {
            $color = $generator->generateHex(RandomColorGenerator::COLOR_LIGHT);

            $noHash = substr($color, 1);

            $pieces = str_split($noHash, 2);

            foreach ($pieces as $piece) {
                $decNum = hexdec($piece);

                if ($decNum < 120) {
                    $this->fail("Light random color string wasn't generated correctly");
                }
            }
        }

        $this->assertTrue(true);
    }

    public function testGenerateHexWithDarkSubsetReturnsDarkerColorString()
    {
        $generator = new RandomColorGenerator();

        for ($x = 0; $x < 1000; $x++) {
            $color = $generator->generateHex(RandomColorGenerator::COLOR_DARK);

            $noHash = substr($color, 1);

            $pieces = str_split($noHash, 2);

            foreach ($pieces as $piece) {
                $decNum = hexdec($piece);

                if ($decNum > 160) {
                    $this->fail("Dark random color string wasn't generated correctly");
                }
            }
        }

        $this->assertTrue(true);
    }
}
