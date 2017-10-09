<?php
/**
 *
 * @author Shaun Hare
 */

namespace ShaunHare\loader;

use Aws\S3\Exception\S3Exception;
use Aws\Sdk;

class AwsClient extends Sdk
{

    /**
     * @var array
     */
    private $bucketDetails;
    private $s3;

    public function __construct(array $bucketDetails, array $args = [])
    {
        parent::__construct($args);
        $this->bucketDetails = $bucketDetails;

        /**
         * Aws/S3/S3Client
         */
        $this->s3 = $this->createS3($this->bucketDetails);
    }


    /**
     * @return array|mixed
     */
    public function listObjects()
    {
        $objects = [];

        try {
            $result = $this->s3->listObjects(array('Bucket' => $this->bucketDetails['Bucket']));
            $objects = $result['Contents'];
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return $objects;
    }

    /**
     * @param $filename
     */
    public function storeToFileFromS3($filename)
    {

        $result = $this->s3->getObject([
            'Bucket' =>$this->bucketDetails['Bucket'] ,
            'Key' => $this->bucketDetails['Key'] ,

        ]);

        file_put_contents($filename, $result[$this->bucketDetails['Key']]);
    }
}
