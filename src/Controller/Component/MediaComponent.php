<?php
namespace Cake\Controller\Component;

use Cake\Controller\Component;

class MediaComponent extends Component {
	
	public function upload($image, $folder){
		$targetPath = $this->target.$folder;
		if (!file_exists(WWW_ROOT.'img/'.$targetPath)) {
			mkdir(WWW_ROOT.'img/'.$targetPath, 0777, true);
		}
		
		if($image->getSize() > 0 ){
			$extension = $this->getfileext($image);
			$filename = md5(uniqid(rand(), true)).".".$extension;
			$targetPath = $targetPath."/".$filename;
			$filemove = $image->moveTo(WWW_ROOT.'img/'.$targetPath);
			return $targetPath;
		}else{
			return "";
		}
	}
	
	public function getfilesize($file){
	    return $file->getSize();
	}
	public function getfileext($file){
		$ext = $file->getClientMediaType();
		
		
		$return = "jpg";
		switch ($ext){
			case "image/png":
				$return = "png";
			break;
			case "image/jpeg":
				$return = "jpg";
			break;
			default:
				$return	= pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
			break;
			
		}
		return $return;
	}
	
	
	
}