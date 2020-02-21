<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'PhpOffice/PhpPresentation/Autoloader.php';
PhpOffice\PhpPresentation\Autoloader::register();

require_once 'PhpOffice/Common/Autoloader.php';
\PhpOffice\Common\Autoloader::register();

use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Alignment;
use PhpOffice\PhpPresentation\Shape\Drawing\File;
use PhpOffice\PhpPresentation\Shape\Drawing;


class Ppt_stuff {

  public function make_ppt($campana,$fotos) {

    $objPHPPowerPoint = new PhpPresentation();

// Create slide
    $currentSlide = $objPHPPowerPoint->getActiveSlide();

// Create a shape (drawing)
    $shape = $currentSlide->createDrawingShape();
    $shape->setName('Master Plan logo')
        ->setDescription('Master Plan logo')
        ->setPath(realpath('.') . '/assets/css/logo.jpg')
        ->setWidth(100)
        ->setHeight(45)
        ->setOffsetX(25)
        ->setOffsetY(25);
    $shape1 = $currentSlide->createDrawingShape();
    $shape1->setName('PHPPresentation logo')
        ->setDescription('PHPPresentation logo')
        ->setPath(realpath('.') . '/assets/css/disecom-icon.png')
        ->setWidth(200)
        ->setHeight(60)
        ->setOffsetX(775)
        ->setOffsetY(15);

// Create a shape (text)
    $shape = $currentSlide->createRichTextShape()
            ->setHeight(300)
            ->setWidth(620)
            ->setOffsetX(170)
            ->setOffsetY(120);
    $shape->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $textRun = $shape->createTextRun($campana["campana"]);
    $textRun->getFont()->setBold(true)
    ->setSize(60)
    ->setColor(new Color('FFE06B20'));

    $x=1;
    for($j=0; $j < count($fotos); $j++){        
      // var_dump(file_get_contents($fotos[$j]["url_foto"]));      
      if(file_get_contents($fotos[$j]["url_foto"])!==false){
        if($x==1){
         $currentSlide = $objPHPPowerPoint->createSlide();
         $shape = $currentSlide->createDrawingShape();
         $shape->setName('Master Plan logo')
         ->setDescription('Master Plan logo')
         ->setPath(realpath('.') . '/assets/css/logo.jpg')
         ->setWidth(100)
         ->setHeight(45)
         ->setOffsetX(25)
         ->setOffsetY(25);
         $shape1 = $currentSlide->createDrawingShape();
         $shape1->setName('PHPPresentation logo')
         ->setDescription('PHPPresentation logo')
         ->setPath(realpath('.') . '/assets/css/disecom-icon.png')
         ->setWidth(200)
         ->setHeight(60)
         ->setOffsetX(775)
         ->setOffsetY(15);
         $off=(25*$x)+1;
         $x+=1;
       } else if($x==2){
        $off=(243*$x)+1;
        $x=1;
      } else {
        $x+=1;
        $off=(50*$x)+1;
      }

      $oShape = new Drawing\Base64();
      $imageData = "data:image/jpeg;base64,".base64_encode(file_get_contents($fotos[$j]["url_foto"]));

      $oShape->setName('PHPPresentation logo')
      ->setDescription('PHPPresentation logo')
      ->setData($imageData)
      ->setResizeProportional(false)
      ->setHeight(410)
      ->setWidth(430)
      ->setOffsetX($off)
      ->setOffsetY(150);

      $parrafo = $currentSlide->createRichTextShape()
      ->setHeight(60)
      ->setWidth(200)
      ->setOffsetX($off)
      ->setOffsetY(570);
      $parrafo->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
      $textRun = $parrafo->createTextRun($fotos[$j]["nombre"]);
      $textRun->getFont()->setBold(true)
      ->setSize(20)
      ->setColor(new Color(Color::COLOR_BLACK));

                    // $oShape->setName('Unique name')
                    //         ->setDescription('Description of the drawing');
                    // $oShape->getHyperLink()->setUrl($fotos[$i][$j]["url_foto"])->setTooltip($fotos[$i][$j]["url_foto"]);
      $currentSlide->addShape($oShape);
    }
  }



    $oWriterPPTX = IOFactory::createWriter($objPHPPowerPoint, 'PowerPoint2007');
    header('Content-Type: application/vnd.ms-powerpoint; charset=UTF-8');
    header('Content-Disposition: attachment;filename="'.$campana["campana"].'.ppt"');
    header('Cache-Control: max-age=0'); 
    $oWriterPPTX->save('php://output');


  }

}