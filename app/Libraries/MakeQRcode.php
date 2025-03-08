<?php 

namespace App\Libraries;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use App\Libraries\Aes;

class MakeQRcode{

	public function __construct(){}

	function make($rand, $data, $tgl_produksi, $tgl_expire){

		$initial = new PngWriter();
		$imgQR = $this->encrypt($rand, $data, $tgl_produksi, $tgl_expire);
		$makeQR = QrCode::create($imgQR)->setEncoding(new Encoding("UTF-8"))->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
				->setSize(100)->setMargin(5)->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())->setForegroundColor(new Color(0, 0, 0))
				->setBackgroundColor(new Color(255,255,255));
		$res = $initial->write($makeQR);
		$filename = "QrCode_".date("Y-m-d_H-i-s").".png";
		$res->saveToFile(ROOTPATH."public/QRcode/".$filename);
		$data = $res->getDataUri();


		return $filename;

	}

	function encrypt($rand, $plaintext, $tgl_produksi, $tgl_expire){
		$AES = new Aes();
		
		$data = [ 
		    "plainText" => $plaintext,
		    "tgl_produksi" => $tgl_produksi,
		    "tgl_expire" => $tgl_expire
		];

		$cipher = bin2hex($AES->encrypt($plaintext));
		return $cipher;
	}

	function decrypt($cipher){
		$AES = new Aes();
        
        $decrypted = $AES->decrypt(hex2bin($cipher));
		return $decrypted;
	}
}
