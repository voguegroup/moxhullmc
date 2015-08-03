<?php
// --- Smart Image Processor ----------------------------------------------------
// Copyright 2003 - 2006 (c) George Petrov, Patrick Woldberg, www.DMXzone.com
//
// Version: 1.0.7
// ------------------------------------------------------------------------------

class resizeUploadedFiles extends pureUploadAddon
{
  var $version = "1.0.7";
  var $debugger = false;
  
  var $component; //GD, GD2, MagicWand, PHP-IMagick, ImageMagick of NetPBM?
  var $resizeImages;
  var $aspectImages;
  var $maxWidth;
  var $maxHeight;
  var $quality;
  var $makeThumb;
  var $aspectThumb;
  var $pathThumb; // if empty use from ppu
  var $naming; // prefix or suffix
  var $suffix;
  var $maxWidthThumb;
  var $maxHeightThumb;
  var $qualityThumb;
  
  var $orgFileName;
  var $newWidth;
  var $newHeight;
  
  function resizeUploadedFiles(&$upload) {
    global $DMX_debug;
    parent::pureUploadAddon($upload);
    $this->upload->registerAddOn($this);
    $this->debugger = $DMX_debug;
    $this->debug("<br/><font color=\"#009900\"><b>Smart Image Processor version ".$this->version."</b></font><br/><br/>");
    if ($this->upload->version < "2.1.3") {
      $this->error("uploadversion", "2.1.3");
    }
  }

  // Check if version is uptodate
  function checkVersion($version) {
    $testVer=intval(str_replace(".", "",$version));
    $curVer=intval(str_replace(".", "",$this->version));
    if ($testVer < $curVer) {
      $this->error('version');
    }
  }
  
  function doResize() {
    $this->debug("PHP version(<font color=\"#990000\">".phpversion()."</font>)<br/>");
    $this->debug("resizeImages(<font color=\"#990000\">".$this->resizeImages."</font>)<br/>");
    $this->debug("aspectImages(<font color=\"#990000\">".$this->aspectImages."</font>)<br/>");
    $this->debug("maxWidth(<font color=\"#990000\">".$this->maxWidth."</font>)<br/>");
    $this->debug("maxHeight(<font color=\"#990000\">".$this->maxHeight."</font>)<br/>");
    $this->debug("quality(<font color=\"#990000\">".$this->quality."</font>)<br/>");
    $this->debug("makeThumb(<font color=\"#990000\">".$this->makeThumb."</font>)<br/>");
    $this->debug("aspectThumb(<font color=\"#990000\">".$this->aspectThumb."</font>)<br/>");
    $this->debug("pathThumb(<font color=\"#990000\">".$this->pathThumb."</font>)<br/>");
    $this->debug("maxWidthThumb(<font color=\"#990000\">".$this->maxWidthThumb."</font>)<br/>");
    $this->debug("maxHeightThumb(<font color=\"#990000\">".$this->maxHeightThumb."</font>)<br/>");
    $this->debug("qualityThumb(<font color=\"#990000\">".$this->qualityThumb."</font>)<br/>");
    $this->debug("naming(<font color=\"#990000\">".$this->naming."</font>)<br/>");
    $this->debug("suffix(<font color=\"#990000\">".$this->suffix."</font>)<br/>");
    $this->debug("<b>Starting the Resize function</b><br/>");
    if ($this->maxWidth == "") { $this->maxWidth = 100000; }
    if ($this->maxHeight == "") { $this->maxHeight = 100000; }
    if ($this->maxWidthThumb == "") { $this->maxWidthThumb = 100000; }
    if ($this->maxHeightThumb == "") { $this->maxHeightThumb = 100000; }
    
    $this->resize();
    if (!isset($this->upload->debugger) && $this->debugger == true) {
      exit();
    }
  }
  
  function calculateSize($imgWidth, $imgHeight, $create) {
    $this->debug("Calculating size<br/>");
    $aspect = true;
    if ($create == "image") {
      $maxWidth = $this->maxWidth;
      $maxHeight = $this->maxHeight;
      if ($this->aspectImages == "false") {
        $aspect = false;
      }
    } else {
      $maxWidth = $this->maxWidthThumb;
      $maxHeight = $this->maxHeightThumb;
      if ($this->aspectThumb == "false") {
        $aspect = false;
      }
    }
    $this->debug("maxWidth = <font color=\"#000099\"><b>".$maxWidth."</b></font><br/>");
    $this->debug("maxHeight = <font color=\"#000099\"><b>".$maxHeight."</b></font><br/>");
    if (($maxWidth < $imgWidth || $maxHeight < $imgHeight) && $aspect) {
      if ($maxWidth >= $maxHeight) {
        $this->newWidth = round($maxHeight*($imgWidth/$imgHeight), 0);
        $this->newHeight = round($maxHeight, 0);
      } else {
        $this->newWidth = round($maxWidth, 0);
        $this->newHeight = round($maxWidth*($imgHeight/$imgWidth), 0);
      }
      if ($this->newWidth > $maxWidth) {
        $this->newWidth = round($maxWidth, 0);
        $this->newHeight = round($maxWidth*($imgHeight/$imgWidth), 0);
      }
      if ($this->newHeight > $maxHeight) {
        $this->newWidth = round($maxHeight*($imgWidth/$imgHeight), 0);
        $this->newHeight = round($maxHeight, 0);
      }
    } else {
      if ($aspect) {
        $this->newWidth = round($imgWidth, 0);
        $this->newHeight = round($imgHeight, 0);
      } else {
        $this->newWidth = round($maxWidth, 0);
        $this->newHeight = round($maxHeight, 0);
      }
    }
    $this->debug("newWidth = <font color=\"#000099\"><b>".$this->newWidth."</b></font><br/>");
    $this->debug("newHeight = <font color=\"#000099\"><b>".$this->newHeight."</b></font><br/>");
  }
  
  function resize() {
    if ($this->component == "GD" || $this->component == "GD2"){
      $this->debug("Using GD for resizing<br/>");
      if (!extension_loaded('gd')) {
        $this->debug("<font color=\"#FF0000\"><b>GD is not loaded</b></font><br/>");
        if (!dl('gd.so')) {
          $this->debug("<font color=\"#FF0000\"><b>couldn't load GD</b></font><br/>");
          $this->error('gdinstall');
        }
      }
    } else {
      $this->debug("Using ".$this->component." for resizing<br/>");
    }
    foreach ($this->upload->uploadedFiles as $file) {
      if ($file->fileName != "") {
	  $this->debug("<b>Filename</b>".$file->fileName."<br/>");
      $this->imageInfo = @getimagesize($this->upload->path.'/'.$file->fileName);
	  $this->debug("<b>ImageInfo: </b>".$this->imageInfo[2]."<br/>");
        if (($this->imageInfo[2] > 0 & $this->imageInfo[2] < 4 )|| $this->imageInfo[2] == 6 || $this->imageInfo[2] == 15 || $this->imageInfo[2] == 16){
          $this->debug("Starting resize of <font color=\"#000099\"><b>".$file->fileName."</b></font><br/>");
          $this->orgFileName = $file->fileName;
          if ($this->makeThumb == "true") {
              $this->debug("<b>Create Thumbnail</b><br/>");
              $this->calculateSize($file->imageWidth, $file->imageHeight, "thumb");
              if ($this->component == "GD" || $this->component == "GD2"){ 
                if ($this->resize_file_GD($file, "thumb")){
                  $file->setThumbSize($this->newWidth, $this->newHeight);
                }
              } elseif ($this->component == "MagicWand") {
                if ($this->resize_file_MagicWand($file, "thumb")){
                  $file->setThumbSize($this->newWidth, $this->newHeight);
                }
              } elseif ($this->component == "IMagick") {
                if ($this->resize_file_IMagick($file, "thumb")){
                  $file->setThumbSize($this->newWidth, $this->newHeight);
                }
              } elseif ($this->component == "ImageMagick") {
                if ($this->resize_file_ImageMagick($file, "thumb")){
                  $file->setThumbSize($this->newWidth, $this->newHeight);
                }
              } else {
                if ($this->resize_file_NetPBM($file, "thumb")){
                  $file->setThumbSize($this->newWidth, $this->newWidth);
                }
              }
          }
          if ($this->resizeImages == "true") {
            $this->debug("<b>Resize Original Image</b><br/>");
            $this->calculateSize($file->imageWidth, $file->imageHeight, "image");
              if ($this->component == "GD" || $this->component == "GD2"){ 
                if ($this->resize_file_GD($file, "image")) {
                  $file->setImageSize($this->newWidth, $this->newHeight);
                  $_POST[$this->upload->saveWidth] = $this->newWidth;
                  $_POST[$this->upload->saveHeight] = $this->newHeight;
                  $HTTP_POST_VARS[$this->upload->saveWidth] = $this->newWidth;
                  $HTTP_POST_VARS[$this->upload->saveHeight] = $this->newHeight;
                }
              } elseif ($this->component == "MagicWand") {
                if ($this->resize_file_MagicWand($file, "image")){
                  $file->setImageSize($this->newWidth, $this->newHeight);
                  $_POST[$this->upload->saveWidth] = $this->newWidth;
                  $_POST[$this->upload->saveHeight] = $this->newHeight;
                  $HTTP_POST_VARS[$this->upload->saveWidth] = $this->newWidth;
                  $HTTP_POST_VARS[$this->upload->saveHeight] = $this->newHeight;
                }
              } elseif ($this->component == "IMagick") {
                if ($this->resize_file_IMagick($file, "image")) {
                  $file->setImageSize($this->newWidth, $this->newHeight);
                  $_POST[$this->upload->saveWidth] = $this->newWidth;
                  $_POST[$this->upload->saveHeight] = $this->newHeight;
                  $HTTP_POST_VARS[$this->upload->saveWidth] = $this->newWidth;
                  $HTTP_POST_VARS[$this->upload->saveHeight] = $this->newHeight;
                }
              } elseif ($this->component == "ImageMagick") {
                if ($this->resize_file_ImageMagick($file, "image")) {
                  $file->setImageSize($this->newWidth, $this->newHeight);
                  $_POST[$this->upload->saveWidth] = $this->newWidth;
                  $_POST[$this->upload->saveHeight] = $this->newHeight;
                  $HTTP_POST_VARS[$this->upload->saveWidth] = $this->newWidth;
                  $HTTP_POST_VARS[$this->upload->saveHeight] = $this->newHeight;
                  
                }
              } else {
                if ($this->resize_file_NetPBM($file, "image")){
                  $file->setImageSize($this->newWidth, $this->newHeight);
                  $_POST[$this->upload->saveWidth] = $this->newWidth;
                  $_POST[$this->upload->saveHeight] = $this->newHeight;
                  $HTTP_POST_VARS[$this->upload->saveWidth] = $this->newWidth;
                  $HTTP_POST_VARS[$this->upload->saveHeight] = $this->newHeight;
                }
              }
          }
        }
      }
    }
  }
  
  function resize_file_MagicWand(&$file, $create) {
    $image = NewMagickWand();
    MagickReadImage($image, $this->upload->path.'/'.$this->orgFileName);
    MagickResizeImage($image, $this->newWidth, $this->newHeight, MW_MitchellFilter, 1);
    MagickSetImageCompressionQuality($image, $this->quality);
	
	//Set the extension of the new file
	$ext = $this->GetNewfileExtension();
	
    if (file_exists($this->upload->path.'/'.$file->name.".".$ext) and ($file->name.".".$ext <> $file->fileName) and ($this->upload->nameConflict == "uniq")) {
      $file->setFileName($this->upload->createUniqName($file->name.".".$ext));
    }
    if ($create == "image") {
      $fileName = $file->name.".".$ext;
      @unlink($this->upload->path.'/'.$this->orgFileName);
      MagickWriteImage($image, $this->upload->path.'/'.$fileName);
      $file->setFileName($fileName);
    } else {
      if ($this->pathThumb == "") {
        $this->pathThumb = $this->upload->path;
      }
      if ($this->naming == "suffix") {
        $fileName = $file->name.$this->suffix.".".$ext;
      } else {
        $fileName = $this->suffix.$file->name.".".$ext;
      }
      MagickWriteImage($image, $this->pathThumb.'/'.$fileName);
      $file->setThumbFileName($fileName, $this->pathThumb, $this->naming, $this->suffix);
    }
    DestroyMagickWand($image);
  }
  
  function resize_file_IMagick(&$file, $create) {
  	$handle = imagivk_readimage(getcwd().'/'.$this->upload->path.'/'.$this->orgFileName);
  	if (imagick_iserror($handle)) {
      $reason = imagick_failedreason($handle);
      $description = imagick_faileddescription($handle);
      echo "Handle failed!<br/>Reason: $reason<br/>Description: $description";
      exit;
  	}
    if (!imagick_resize($handle, $this->newWidth, $this->newHeight, IMAGICK_FILTER_UNKNOWN, 0, "!")) {
      $reason = imagick_failedreason($handle);
      $description = imagick_faileddescription($handle);
      echo "imagick_resize() failed!<br/>Reason: $reason<br/>Description: $description";
      exit;
    }
	
	//Set the extension of the new file
	$ext = $this->GetNewfileExtension();
	
    if (file_exists($this->upload->path.'/'.$file->name.".".$ext) && ($file->name.".".$ext <> $file->fileName) && ($this->upload->nameConflict == "uniq")) {
      $file->setFileName($this->upload->createUniqName($file->name.".jpg"));
    }
    if ($create == "image") {
      $fileName = $file->name.".".$ext;
      @unlink($this->upload->path.'/'.$this->orgFileName);
      if (!imagick_writeimage($handle, getcwd().'/'.$this->upload->path.'/'.$fileName)) {
        $reason = imagick_failedreason($handle);
        $description = imagick_faileddescription($handle);
        echo "imagick_writeimage() failed!<br/>Reason: $reason<br/>Description: $description";
        exit;
      }
      $file->setFileName($fileName);
    } else {
      if ($this->pathThumb == "") {
        $this->pathThumb = $this->upload->path;
      }
      if ($this->naming == "suffix") {
        $fileName = $file->name.$this->suffix.".".$ext;
      } else {
        $fileName = $this->suffix.$file->name.".".$ext;
      }
      if (!imagick_writeimage($handle, getcwd().'/'.$this->pathThumb.'/'.$fileName)) {
        $reason = imagick_failedreason($handle);
        $description = imagick_faileddescription($handle);
        echo "imagick_writeimage() failed!<br/>Reason: $reason<br/>Description: $description";
        exit;
      }
      $file->setThumbFileName($fileName, $this->pathThumb, $this->naming, $this->suffix);
    }
  }
  
  function resize_file_ImageMagick(&$file, $create) {
  	$inFile = escapeshellarg(getcwd().'/'.$this->upload->path.'/'.$this->orgFileName);
	
	//Set the extension of the new file
	$ext = $this->GetNewfileExtension();
	
    if (file_exists($this->upload->path.'/'.$file->name.".".$ext) && ($file->name.".".$ext <> $file->fileName) && ($this->upload->nameConflict == "uniq")) {
      $file->setFileName($this->upload->createUniqName($file->name.".".$ext));
    }
    if ($create == "image") {
      $fileName = $file->name.".".$ext;
      $outFile = escapeshellarg(getcwd().'/'.$this->upload->path.'/'.$fileName);
      $this->debug("convert ".$inFile." -resize ".$this->newWidth."x".$this->newHeight."! ".$outFile."<br/>");
      exec("convert ".$inFile." -resize ".$this->newWidth."x".$this->newHeight."! ".$outFile, $ret_val);
      $this->debug("<pre>".implode("\n", $ret_val)."</pre><br/>");
      $file->setFileName($fileName);
    } else {
      if ($this->pathThumb == "") {
        $this->pathThumb = $this->upload->path;
      }
      if ($this->naming == "suffix") {
        $fileName = $file->name.$this->suffix.".".$ext;
      } else {
        $fileName = $this->suffix.$file->name.".".$ext;
      }
      $outFile = escapeshellarg(getcwd().'/'.$this->pathThumb.'/'.$fileName);
      $this->debug("convert '".$inFile."' -resize ".$this->newWidth."x".$this->newHeight."! '".$outFile."'<br/>");
      exec("convert ".$inFile." -resize ".$this->newWidth."x".$this->newHeight."! ".$outFile, $ret_val);
      $this->debug("<pre>".implode("\n", $ret_val)."</pre><br/>");
      $file->setThumbFileName($fileName, $this->pathThumb, $this->naming, $this->suffix);
    }
  }

  
  function resize_file_GD(&$file, $create) {
    $gdfuncs = get_extension_funcs("gd");
    $this->debug("Current imagesize is (<font color=\"#000099\"><b>".$this->imageInfo[0]."x".$this->imageInfo[1]."</b></font>)<br/>");
    switch ($this->imageInfo[2]) {
    case 1:
      // tot GD Library 1.6
      $this->debug("imagetype is <font color=\"#000099\"><b>GIF</b></font><br/>");
      if (!array_search("imagecreatefromgif", $gdfuncs)) {
        $this->debug("<font color=\"#FF0000\"><b>imagecreatefromgif function is not supported</b></font><br/>");
        //$this->error('gdinvalid', 'gif');
        return(false);
      }
      $src_img = @imagecreatefromgif($this->upload->path.'/'.$this->orgFileName);
      break;
    case 2:
      // vanaf PHP 3.0.16
      $this->debug("imagetype is <font color=\"#000099\"><b>JPEG</b></font><br/>");
      if (!array_search("imagecreatefromjpeg", $gdfuncs)) {
        $this->debug("<font color=\"#FF0000\"><b>imagecreatefromjpeg function is not supported</b></font><br/>");
        //$this->error('gdinvalid', 'jpeg');
        return(false);
      }
      $src_img = imagecreatefromjpeg($this->upload->path.'/'.$this->orgFileName);
      break;
    case 3:
      // vanaf PHP 3.0.13
      $this->debug("imagetype is <font color=\"#000099\"><b>PNG</b></font><br/>");
      if (!array_search("imagecreatefrompng", $gdfuncs)) {
        $this->debug("<font color=\"#FF0000\"><b>imagecreatefrompng function is not supported</b></font><br/>");
        //$this->error('gdinvalid', 'png');
        return(false);
      }
      $src_img = @imagecreatefrompng($this->upload->path.'/'.$this->orgFileName);
      break;
	case 6:
		$this->debug("imagetype is <font color=\"#000099\"><b>BMP</b></font><br/>");
		$src_img = $this->imagecreatefrombmp($this->upload->path.'/'.$this->orgFileName);
		break;
    case 15:
      // vanaf PHP 4.0.1
      $this->debug("imagetype is <font color=\"#000099\"><b>WBMP</b></font><br/>");
      if (!array_search("imagecreatefromwbmp", $gdfuncs)) {
        $this->debug("<font color=\"#FF0000\"><b>imagecreatefromwbmp function is not supported</b></font><br/>");
        //$this->error('gdinvalid', 'wbmp');
        return(false);
      }
      $src_img = @imagecreatefromwbmp($this->upload->path.'/'.$this->orgFileName);
      break;
    case 16:
      // vanaf PHP 4.0.1
      $this->debug("imagetype is <font color=\"#000099\"><b>XBM</b></font><br/>");
      if (!array_search("imagecreatefromxbm", $gdfuncs)) {
        $this->debug("<font color=\"#FF0000\"><b>imagecreatefromxbm function is not supported</b></font><br/>");
        //$this->error('gdinvalid', 'xbm');
        return(false);
      }
      $src_img = @imagecreatefromxbm($this->upload->path.'/'.$this->orgFileName);
      break;
    default:
      $this->debug("<font color=\"#FF0000\"><b>not a valid imagetype</b></font><br/>");
      return(false);
    }
    if(!function_exists("gd_info")) {
      $this->debug("gd_info does not exist, using alternative<br/>");
      $gdinfo = $this->gd_info();
    } else {
      $this->debug("getting gd information<br/>");
      $gdinfo = gd_info();
    }
    $this->debug("GD Version = <font color=\"#000099\"><b>".$gdinfo["GD Version"]."</b></font><br/>");
    if (array_search("imagecreatetruecolor", $gdfuncs) and array_search("imagecopyresampled", $gdfuncs) and (!stristr($gdinfo["GD Version"],"1.") or $this->component == "GD2")) {
      // Requires GD 2.0.1 or higher
      $this->debug("using imagecreatetruecolor function<br/>");
      if ($dst_img = @imagecreatetruecolor($this->newWidth,$this->newHeight)) {
        //$this->debug("imagecreatetruecolor(".$this->newWidth.",".$this->newHeight.")<br/>");
        @imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $this->newWidth, $this->newHeight, $file->imageWidth, $file->imageHeight);
      }
      $this->debug("imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, ".$this->newWidth.", ".$this->newHeight.", ".$file->imageWidth.", ".$file->imageHeight.")<br/>");
    }
    if (!$dst_img) {
      $this->debug("using imagecreate function<br/>");
      $dst_img = @imagecreate($this->newWidth,$this->newHeight);
      $this->debug("imagecreate(".$this->newWidth.",".$this->newHeight.")<br/>");
      @imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, $this->newWidth, $this->newHeight, $file->imageWidth, $file->imageHeight);
      $this->debug("imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, ".$this->newWidth.", ".$this->newHeight.", ".$file->imageWidth.", ".$file->imageHeight.")<br/>");
    }
	
	//Set the extension of the new file
	$ext = $this->GetNewfileExtension();
	
    // Check if exist and create new unique name if needed
    if (file_exists($this->upload->path.'/'.$file->name.".".$ext) and ($file->name.".".$ext <> $file->fileName) and ($this->upload->nameConflict == "uniq")) {
      $file->setFileName($this->upload->createUniqName($file->name.".".$ext));
    }
    // Write new image
    if ($create == "image") {
      $fileName = $file->name.".".$ext;
      @unlink($this->upload->path.'/'.$this->orgFileName);
      @imagejpeg($dst_img, $this->upload->path.'/'.$fileName, $this->quality); // vanaf PHP 3.0.16
      $this->debug("imagejpeg(".$dst_img.", ".$this->upload->path.".'/'.".$fileName.", ".$this->quality.")<br/>");
      $file->setFileName($fileName);
    } else {
      if ($this->pathThumb == "") {
        $this->pathThumb = $this->upload->path;
      }
      if ($this->naming == "suffix") {
        $fileName = $file->name.$this->suffix.".".$ext;
      } else {
        $fileName = $this->suffix.$file->name.".".$ext;
      }
      @imagejpeg($dst_img, $this->pathThumb.'/'.$fileName, $this->quality); // vanaf PHP 3.0.16
      $this->debug("imagejpeg(".$dst_img.", ".$this->pathThumb.".'/'.".$fileName.", ".$this->quality.")<br/>");
      $file->setThumbFileName($fileName, $this->pathThumb, $this->naming, $this->suffix);
    }
    $this->debug("new image <Font color=\"#000099\"><b>".$fileName."</b></font> is created<br/>");
    @imagedestroy($src_img);
    @imagedestroy($dst_img);
    return(true);
  }
//----- Begin Extension Fix New Function 1.07 -----------   
  function GetNewfileExtension()
  {
  	//Get file extension
	$ext = substr(strrchr($this->orgFileName, '.'), 1);
	//$this->debug("File extension: <font color=\"#000099\"><b>".$ext."</b></font><br/>");
	
	//If the extension is not jpg set it to jpg
	//Else return the original one
	if (strtolower($ext)!= "jpg")
	{
		$ext = "jpg";
	}
	return $ext;
  }
//----- End Extension Fix New Function 1.07 -----------

//----- Begin BMP Fix New Functions 1.07 ----------- 
  function ConvertBMP2GD($src, $dest = false) {
  //Convert BMP -> GD
	if(!($src_f = fopen($src, "rb"))) {
		 $this->debug("Cannot open the source. <font color=\"#FF0000\"><b>".$src."</b></font><br/>");
		 return false;
	}
	if(!($dest_f = fopen($dest, "wb"))) {
		$this->debug("Cannot open the destination for writing <font color=\"#FF0000\"><b>".dest."</b></font><br/>");
		return false;
	}
	$header = unpack("vtype/Vsize/v2reserved/Voffset", fread($src_f,
	14));
	$info = unpack("Vsize/Vwidth/Vheight/vplanes/vbits/Vcompression/Vimagesize/Vxres/Vyres/Vncolor/Vimportant",
	fread($src_f, 40));
	
	extract($info);
	extract($header);
	
	if($type != 0x4D42) { // signature "BM"
		$this->debug("The file is from wrong format. <font color=\"#FF0000\"><b>Does not contain BMP signature!</b></font><br/>");
		return false;
	}
	
	$palette_size = $offset - 54;
	$ncolor = $palette_size / 4;
	$gd_header = "";
	// true-color vs. palette
	$gd_header .= ($palette_size == 0) ? "\xFF\xFE" : "\xFF\xFF";
	$gd_header .= pack("n2", $width, $height);
	$gd_header .= ($palette_size == 0) ? "\x01" : "\x00";
	if($palette_size) {
		$gd_header .= pack("n", $ncolor);
	}
	// no transparency
	$gd_header .= "\xFF\xFF\xFF\xFF";
	
	fwrite($dest_f, $gd_header);
	
	if($palette_size) {
		$palette = fread($src_f, $palette_size);
		$gd_palette = "";
		$j = 0;
		while($j < $palette_size) {
			$b = $palette{$j++};
			$g = $palette{$j++};
			$r = $palette{$j++};
			$a = $palette{$j++};
			$gd_palette .= "$r$g$b$a";
		}
		$gd_palette .= str_repeat("\x00\x00\x00\x00", 256 - $ncolor);
		fwrite($dest_f, $gd_palette);
	}
	
	$scan_line_size = (($bits * $width) + 7) >> 3;
	$scan_line_align = ($scan_line_size & 0x03) ? 4 - ($scan_line_size &
	0x03) : 0;
	
	for($i = 0, $l = $height - 1; $i < $height; $i++, $l--) {
		// BMP stores scan lines starting from bottom
		fseek($src_f, $offset + (($scan_line_size + $scan_line_align) *
		$l));
		$scan_line = fread($src_f, $scan_line_size);
		if($bits == 24) {
			$gd_scan_line = "";
			$j = 0;
			while($j < $scan_line_size) {
				$b = $scan_line{$j++};
				$g = $scan_line{$j++};
				$r = $scan_line{$j++};
				$gd_scan_line .= "\x00$r$g$b";
			}
		}
		else if($bits == 8) {
			$gd_scan_line = $scan_line;
		}
		else if($bits == 4) {
			$gd_scan_line = "";
			$j = 0;
			while($j < $scan_line_size) {
				$byte = ord($scan_line{$j++});
				$p1 = chr($byte >> 4);
				$p2 = chr($byte & 0x0F);
				$gd_scan_line .= "$p1$p2";
			} $gd_scan_line = substr($gd_scan_line, 0, $width);
		}
		else if($bits == 1) {
			$gd_scan_line = "";
			$j = 0;
			while($j < $scan_line_size) {
				$byte = ord($scan_line{$j++});
				$p1 = chr((int) (($byte & 0x80) != 0));
				$p2 = chr((int) (($byte & 0x40) != 0));
				$p3 = chr((int) (($byte & 0x20) != 0));
				$p4 = chr((int) (($byte & 0x10) != 0));
				$p5 = chr((int) (($byte & 0x08) != 0));
				$p6 = chr((int) (($byte & 0x04) != 0));
				$p7 = chr((int) (($byte & 0x02) != 0));
				$p8 = chr((int) (($byte & 0x01) != 0));
				$gd_scan_line .= "$p1$p2$p3$p4$p5$p6$p7$p8";
			} $gd_scan_line = substr($gd_scan_line, 0, $width);
		}

		fwrite($dest_f, $gd_scan_line);
	}
		
	fclose($src_f);
	fclose($dest_f);
	return true;
  }
	
  function imagecreatefrombmp($filename) {
	//Create image from BMP
	$this->debug("Execute function: <b>imagecreatefrombmp</b><br/>");
	$tmp_name = tempnam("/tmp", "GD");
	$this->debug("Filename: <b>".$filename."</b><br/>");
	$this->debug("Tempfilename: <b>".$tmp_name."</b><br/>");
	if($this->ConvertBMP2GD($filename, $tmp_name)) {
		$img = imagecreatefromgd($tmp_name);
		unlink($tmp_name);
		$this->debug("ConvertBMP2GD successful execution");
		return $img;
	} 
	$this->debug("<font color=\"#FF0000\"><b>ConvertBMP2GD</b></font> failed!");
	return false;
  }
//----- End BMP Fix New Functions 1.07 ----------- 
  
  function resize_file_NetPBM(&$file, $create) {
    $tmpfname = tempnam($this->upload->path, "sip");
    $this->debug("Current imagesize is (<font color=\"#000099\"><b>".$this->imageInfo[0]."x".$this->imageInfo[1]."</b></font>)<br/>");
    switch ($this->imageInfo[2]) {
    case 1:
      // GIF
      $this->debug("imagetype is <font color=\"#000099\"><b>GIF</b></font><br/>");
      if (!file_exists(dirname(__FILE__)."/giftopnm")) {
        $this->debug("<font color=\"#FF0000\"><b>giftopnm is not found</b></font><br/>");
        //$this->error('giftopnm');
        return false;
      } else {
        system(dirname(__FILE__)."/giftopnm ".$this->upload->path."/".$this->orgFileName.">".$tmpfname);
      }
      break;
    case 2:
      // JPEG
      $this->debug("imagetype is <font color=\"#000099\"><b>JPEG</b></font><br/>");
      if (!file_exists(dirname(__FILE__)."/jpegtopnm")) {
        $this->debug("<font color=\"#FF0000\"><b>jpegtopnm is not found</b></font><br/>");
        //$this->error('jpegtopnm');
        return false;
      } else {
        system(dirname(__FILE__)."/jpegtopnm ".$this->upload->path.'/'.$this->orgFileName.">".$tmpfname);
      }
      break;
    case 3:
      // PNG
      $this->debug("imagetype is <font color=\"#000099\"><b>PNG</b></font><br/>");
      if (!file_exists(dirname(__FILE__)."/pngtopnm")) {
        $this->debug("<font color=\"#FF0000\"><b>pngtopnm is not found</b></font><br/>");
        //$this->error('pngtopnm');
        return false;
      } else {
        system(dirname(__FILE__)."/pngtopnm ".$this->upload->path.'/'.$this->orgFileName.">".$tmpfname);
      }
      break;
    case 15: 
      // WBMP
      $this->debug("imagetype is <font color=\"#000099\"><b>WBMP</b></font><br/>");
      if (!file_exists(dirname(__FILE__)."/pngtopnm")) {
        $this->debug("<font color=\"#FF0000\"><b>wbmptopnm is not found</b></font><br/>");
        //$this->error('wbmptopnm');
        return false;
      } else { 
        system(dirname(__FILE__)."/wbmptopnm ".$this->upload->path.'/'.$this->orgFileName.">".$tmpfname);
      }
      break;
    case 16:
      // XBM
      $this->debug("imagetype is <font color=\"#000099\"><b>XBM</b></font><br/>");
      if (!file_exists(dirname(__FILE__)."/xbmtopnm")) {
        $this->debug("<font color=\"#FF0000\"><b>xbmtopnm is not found</b></font><br/>");
        //$this->error('xbmtopnm');
        return false;
      } else {
        system(dirname(__FILE__)."/xbmtopnm ".$this->upload->path.'/'.$this->orgFileName.">".$tmpfname);
      }
      break;
    default:
      $this->debug("<font color=\"#FF0000\"><b>not a valid imagetype</b></font><br/>");
        //$this->error('invalid');
       return false;
    }
	
	//Set the extension for the new file
	$ext = $this->GetNewfileExtension();
	
    // Check if exist and create new unique name if needed
    if (file_exists($this->upload->path.'/'.$file->name.".".$ext) and ($file->name.".".$ext <> $file->fileName) and ($this->upload->nameConflict == "uniq")) {
      $file->setFileName($this->createUniqName($file->name.".".$ext));
    }
    if ($create == "image") {
      $fileName = $file->name.".".$ext;
      unlink($this->upload->path.'/'.$this->orgFileName);
      $this->debug("Creating the new jpeg<br/>");
      system(dirname(__FILE__)."/pnmscale -xy ".$this->newWidth." ".$this->newHeight." ".$tmpfname." | ".dirname(__FILE__)."/ppmtojpeg -qual ".$this->quality." >".$this->upload->path.'/'.$fileName); 
      $file->setFileName($fileName);
    } else {
      if ($this->pathThumb == "") {
        $this->pathThumb = $this->upload->path;
      }
      if ($this->naming == "suffix") {
        $fileName = $file->name.$this->suffix.".".$ext;
      } else {
        $fileName = $this->suffix.$file->name.".".$ext;
      }
      $this->debug("Creating the thumbnail<br/>");
      system(dirname(__FILE__)."/pnmscale -xy ".$this->newWidth." ".$this->newHeight." ".$tmpfname." | ".dirname(__FILE__)."/ppmtojpeg -qual ".$this->quality." >".$this->pathThumb.'/'.$fileName); 
      $file->setThumbFileName($fileName, $this->pathThumb, $this->naming, $this->suffix);
    }
    unlink($tmpfname);
    $this->debug("new image <Font color=\"#000099\"><b>".$fileName."</b></font> is created<br/>");
    return true;
  }

  function check_php_version($version) {
    $testVer=intval(str_replace(".", "",$version));
    $curVer=intval(str_replace(".", "",phpversion()));
    if( $curVer < $testVer ){
      return false;
    }
    return true;
  }
  
  function gd_info() {
    $array = Array(
      "GD Version" => "",
      "FreeType Support" => 0,
      "FreeType Support" => 0,
      "FreeType Linkage" => "",
      "T1Lib Support" => 0,
      "GIF Read Support" => 0,
      "GIF Create Support" => 0,
      "JPG Support" => 0,
      "PNG Support" => 0,
      "WBMP Support" => 0,
      "XBM Support" => 0
    );
    $gif_support = 0;
    ob_start();
    eval("phpinfo();");
    $this->debug("getting php information<br/>");
    $info = ob_get_contents();
    ob_end_clean();
    $this->debug("extracting gd information<br/>");
    foreach(explode("\n", $info) as $line) {
      if(strpos($line, "GD Version")!==false) {
        $array["GD Version"] = trim(str_replace("GD Version", "", strip_tags($line)));
      } else {
        $array["GD Version"] = "Unknown, probably 1.x.x";
      }
      if(strpos($line, "FreeType Support")!==false)
        $array["FreeType Support"] = trim(str_replace("FreeType Support", "", strip_tags($line)));
      if(strpos($line, "FreeType Linkage")!==false)
        $array["FreeType Linkage"] = trim(str_replace("FreeType Linkage", "", strip_tags($line)));
      if(strpos($line, "T1Lib Support")!==false)
        $array["T1Lib Support"] = trim(str_replace("T1Lib Support", "", strip_tags($line)));
      if(strpos($line, "GIF Read Support")!==false)
        $array["GIF Read Support"] = trim(str_replace("GIF Read Support", "", strip_tags($line)));
      if(strpos($line, "GIF Create Support")!==false)
        $array["GIF Create Support"] = trim(str_replace("GIF Create Support", "", strip_tags($line)));
      if(strpos($line, "GIF Support")!==false)
        $gif_support = trim(str_replace("GIF Support", "", strip_tags($line)));
      if(strpos($line, "JPG Support")!==false)
        $array["JPG Support"] = trim(str_replace("JPG Support", "", strip_tags($line)));
      if(strpos($line, "PNG Support")!==false)
        $array["PNG Support"] = trim(str_replace("PNG Support", "", strip_tags($line)));
      if(strpos($line, "WBMP Support")!==false)
        $array["WBMP Support"] = trim(str_replace("WBMP Support", "", strip_tags($line)));
      if(strpos($line, "XBM Support")!==false)
        $array["XBM Support"] = trim(str_replace("XBM Support", "", strip_tags($line)));
    }
    if ($gif_support==="enabled") {
      $array["GIF Read Support"]   = 1;
      $array["GIF Create Support"] = 1;
    }
    if ($array["FreeType Support"]==="enabled") {
      $array["FreeType Support"] = 1;
    }
    if($array["T1Lib Support"]==="enabled") {
      $array["T1Lib Support"] = 1;
    }
    if($array["GIF Read Support"]==="enabled") {
      $array["GIF Read Support"] = 1;
    }
    if($array["GIF Create Support"]==="enabled") {
      $array["GIF Create Support"] = 1;
    }
    if($array["JPG Support"]==="enabled") {
      $array["JPG Support"] = 1;
    }
    if($array["PNG Support"]==="enabled") {
      $array["PNG Support"] = 1;
    }
    if($array["WBMP Support"]==="enabled") {
      $array["WBMP Support"] = 1;
    }
    if($array["XBM Support"]==="enabled") {
      $array["XBM Support"] = 1;
    }
    return $array;
  }
  
  function error($error, $extra = "") {
    // Display error
    echo "<b>Error occurred in the Smart Image Processor</b><br/><br/>";

    switch ($error) {
    // Incorrect version
    case 'version':
      echo "<b>You don't have latest version of incResize.php uploaded on the server.</b><br/>";
      echo "This library is required for the current page.<br/>";
      break;

    // Needs newer version of Pure PHP Upload
    case 'uploadversion':
      echo "This version of Smart Image Processor requires version ".$extra." or later of Pure PHP Upload<br/>";
      break;

    // Error renaming the file
    case 'invalid':
      echo "The uploaded file is not an valid image format that is supported<br/>";
      break;

    // Error with netpbm
    case 'netpbm':
      echo "There is an error occurred with the NetPBM Component<br/>";
      break;

    // Error renaming the file
    case 'gdinvalid':
      echo "The GD Library that is installed does not support ".$extra."<br/>";
      break;

    // GD Library is not found
    case 'gdinstall':
      echo "The GD Library is not installed correctly<br/>";
      break;
    }
    
    // Allow to go back and stop the script
    echo "Please correct and <a href=\"javascript:history.back(1)\">try again</a>";
    $this->upload->failUpload();
    exit;
  }
  
  function debug($info) {
    if ($this->debugger) {
      echo "<font face=\"verdana\" size=\"2\">".$info."</font>";
    }
  }
  
  /*function cleanUp() {
    foreach ($this->upload->uploadedFiles as $file) {
      $fileName = $file->name.$this->suffix.".jpg";
      $this->debug("<font color=\"#FF0000\"><b>Deleting ".$fileName."</b></font><br/>");
      @unlink($filename);
    }
  }*/
}

?>