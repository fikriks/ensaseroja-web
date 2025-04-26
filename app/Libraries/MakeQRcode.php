<?php

namespace App\Libraries;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use App\Libraries\Aes;

class MakeQRcode
{

	public function __construct() {}

	function make($rand, $data)
	{
		$initial = new PngWriter();
		$imgQR = $this->encrypt($data);
		$makeQR = QrCode::create($imgQR)->setEncoding(new Encoding("UTF-8"))->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
			->setSize(100)->setMargin(5)->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())->setForegroundColor(new Color(0, 0, 0))
			->setBackgroundColor(new Color(255, 255, 255));
		$res = $initial->write($makeQR);
		$filename = $rand . "QrCode_" . date("Y-m-d_H-i-s") . ".png";
		$res->saveToFile(ROOTPATH . "public/QRcode/" . $filename);
		$data = $res->getDataUri();


		return $filename;
	}

	function encrypt($plaintext)
	{
		$AES = new Aes();

		$cipher = bin2hex($AES->encrypt($plaintext));
		return $cipher;
	}

	function decrypt($cipher)
	{
		$AES = new Aes();

		$decrypted = $AES->decrypt(hex2bin($cipher));
		return $decrypted;
	}
}
