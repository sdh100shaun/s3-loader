<?php
/**
 * Created by PhpStorm.
 * User: shaunhare
 * Date: 07/10/2017
 * Time: 18:02
 */

namespace ShaunHare\Tests;

use Aws\MockHandler;
use Aws\Result;
use Dotenv\Dotenv;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use ShaunHare\loader\AwsClient;

class AwsClientTest extends TestCase
{

    private $mock;
    private $awsClient;

    public function setUp()
    {
        $this->mock = new MockHandler();
        $config = ['region'  => 'us-west-2',
        'version' => 'latest',
        'handler' => $this->mock ];
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load();

        $bucketDetails = ['Bucket' => 'shaun', 'Key' => 'foo'];
        $this->awsClient = new AwsClient($bucketDetails, $config);

        $this->root = vfsStream::setup('dir');
    }


    public function testS3SaveContentsToFile()
    {
        $this->mock->append(new Result(['foo' => 'bar']));
        $this->awsClient->storeToFileFromS3(vfsStream::url('dir').'/test.txt');
        $this->assertTrue($this->root->hasChild('test.txt'));
        $this->assertEquals("bar", file_get_contents(vfsStream::url('dir').'/test.txt'));
    }
}
