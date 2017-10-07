<?php
/**
 *
 * @author Shaun Hare
 */

namespace ShaunHare\loader;

use Aws\Sdk;

class AwsClient extends Sdk
{

    /**
     * @var array
     */
    private $bucketDetails;

    public function __construct(array $bucketDetails, array $args = [])
    {
        parent::__construct($args);
        $this->bucketDetails = $bucketDetails;
    }



    public function storeToFileFromS3($filename)
    {
        /**
         * Aws/S3/S3Client
         */
        $s3 = $this->createS3($this->bucketDetails);

        $result = $s3->getObject([
            'Bucket' =>$this->bucketDetails['Bucket'] ,
            'Key' => $this->bucketDetails['Key'] ,

        ]);

        file_put_contents($filename, $result[$this->bucketDetails['Key']]);
    }
}
