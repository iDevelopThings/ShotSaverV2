<?php


namespace App\Traits;


use Storage;

/**
 * Trait FileOperations
 *
 * This is gross....
 * Since for some reason the laravel ->setVisibility doesn't work with minio
 * this is our only way to set files public/private
 *
 * @package App
 */
trait FileOperations
{


	/**
	 * Set the file to public
	 * We can now use the direct url, rather than pre-signed
	 */
	public function setPublic()
	{
		$client         = Storage::disk('minio')->getDriver()->getAdapter()->getClient();
		$policyReadOnly = '{
			  "Version": "2012-10-17",
			  "Id" : "FilePolicy'.$this->id.'",
			  "Statement": [
			    {
			      "Action": [
			        "s3:GetObject"
			      ],
			      "Effect": "Allow",
			      "Principal": {
			        "AWS": [
			          "*"
			        ]
			      },
			      "Resource": [
			        "arn:aws:s3:::%s/%s/*"
			      ],
			      "Sid": "FilePolicy'.$this->id.'"
			    }
			  ]
			}
			';

		$client->putBucketPolicy([
			'Bucket' => config('filesystems.disks.minio.bucket'),
			'Policy' => sprintf(
				$policyReadOnly,
				config('filesystems.disks.minio.bucket'),
				$this->name
			),
		]);
	}

	/**
	 * Set the file to private
	 * We can now only use a pre-signed temporary time-based url
	 */
	public function setPrivate()
	{
		$client         = Storage::disk('minio')->getDriver()->getAdapter()->getClient();
		$policyReadOnly = '{
			  "Version": "2012-10-17",
			  "Id" : "FilePolicy'.$this->id.'",
			  "Statement": [
			    {
			      "Action": [
			        "s3:GetObject"
			      ],
			      "Effect": "Deny",
			      "Principal": {
			        "AWS": [
			          "*"
			        ]
			      },
			      "Resource": [
			        "arn:aws:s3:::%s/%s/*"
			      ],
			      "Sid": "FilePolicy'.$this->id.'"
			    }
			  ]
			}
			';

		$client->putBucketPolicy([
			'Bucket' => config('filesystems.disks.minio.bucket'),
			'Policy' => sprintf(
				$policyReadOnly,
				config('filesystems.disks.minio.bucket'),
				$this->name
			),
		]);
	}

}