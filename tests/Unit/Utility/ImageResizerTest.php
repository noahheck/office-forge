<?php

namespace Tests\Unit\Utility;

use App\Utility\ImageResizer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Constraint
{
    private $aspectRatioCalled = false;

    public function aspectRatio()
    {
        $this->aspectRatioCalled = true;
    }

    public function getAspectRatioCalled()
    {
        return $this->aspectRatioCalled;
    }
}

class MockImage
{
    private $width;
    private $height;
    private $constraint;

    private $orientateCalled = false;

    private $resizedWidth;
    private $resizedHeight;

    public function __construct($width, $height, $constraint = '')
    {
        $this->width = $width;
        $this->height = $height;
        $this->constraint = $constraint;
    }

    public function width()
    {
        return $this->width;
    }

    public function height()
    {
        return $this->height;
    }

    public function orientate()
    {
        $this->orientateCalled = true;

        return $this;
    }

    public function getOrientateCalled()
    {
        return $this->orientateCalled;
    }

    public function resize($width, $height, $closure)
    {
        $this->resizedWidth = $width;
        $this->resizedHeight = $height;

        $closure($this->constraint);
    }

    public function resizedWidth()
    {
        return $this->resizedWidth;
    }

    public function resizedHeight()
    {
        return $this->resizedHeight;
    }
}

class ImageResizerTest extends TestCase
{
    protected function getImageManager()
    {
        return $this->createMock('\Intervention\Image\ImageManager');
    }

    protected function getImage()
    {
        return $this->getMockBuilder('\Intervention\Image\Image')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testResizeImageToMaxSizeReturnsOriginalImageIfOriginalImageIsWithinBounds()
    {
        $image = new MockImage(50, 50);

        $manager = $this->getImageManager();

        $manager->expects($this->once())
            ->method('make')
            ->willReturn($image);

        $resizer = new ImageResizer($manager);

        $resizer->resizeImageToMaxSize("", 100, 100);

        $this->assertTrue($image->getOrientateCalled());
    }

    public function testResizeImageToMaxSizeReturnsResizedImageToMaxWidthProvidedIfWidthLargerThanHeight()
    {
        $constraint = new Constraint();

        $image = new MockImage(500, 400, $constraint);

        $manager = $this->getImageManager();

        $manager->expects($this->once())
            ->method('make')
            ->willReturn($image);

        $resizer = new ImageResizer($manager);

        $resizer->resizeImageToMaxSize("", 100, 100);

        $this->assertEquals(100, $image->resizedWidth());
        $this->assertNull($image->resizedHeight());

        $this->assertTrue($constraint->getAspectRatioCalled());

        $this->assertTrue($image->getOrientateCalled());
    }

    public function testResizeImageToMaxSizeReturnsResizedImageToMaxHeightProvidedIfHeightLargerThanWidth()
    {
        $constraint = new Constraint();

        $image = new MockImage(400, 500, $constraint);

        $manager = $this->getImageManager();

        $manager->expects($this->once())
            ->method('make')
            ->willReturn($image);

        $resizer = new ImageResizer($manager);

        $resizer->resizeImageToMaxSize("", 100, 100);

        $this->assertEquals(100, $image->resizedHeight());
        $this->assertNull($image->resizedWidth());

        $this->assertTrue($constraint->getAspectRatioCalled());

        $this->assertTrue($image->getOrientateCalled());
    }
}
