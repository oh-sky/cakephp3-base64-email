<?php
namespace OhSky;

use Cake\Core\Configure;
use OhSky\Cakephp3Base64Email;

class Cakephp3Base64EmailTest extends \PHPUnit_Framework_TestCase
{
    public $cakephp3Base64Email;

    public function setUp()
    {
        Configure::write('App.encoding', 'utf-8');
        $this->cakephp3Base64Email = new Cakephp3Base64Email();
    }

    public function testRenderTemplates()
    {
        $text = 'This is a test for OhSky\Cakephp3Base64Email. I am praing passing your tests completely.';
        $expected = "VGhpcyBpcyBhIHRlc3QgZm9yIE9oU2t5XENha2VwaHAzQmFzZTY0RW1haWwuIEkgYW0gcHJhaW5n\nIHBhc3NpbmcgeW91ciB0ZXN0cyBjb21wbGV0ZWx5Lg==\n";

        $reflection = new \ReflectionClass($this->cakephp3Base64Email);
        $method = $reflection->getMethod('_renderTemplates');
        $method->setAccessible(true);
        $mail = $method->invoke($this->cakephp3Base64Email, $text);
        $this->assertSame($expected, $mail['text']);
    }

    public function testGetContentTransferEncoding()
    {
        $reflection = new \ReflectionClass($this->cakephp3Base64Email);
        $method = $reflection->getMethod('_getContentTransferEncoding');
        $method->setAccessible(true);
        $encoding = $method->invoke($this->cakephp3Base64Email);
        $this->assertSame('base64', $encoding);
    }
}
