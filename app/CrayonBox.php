<?php declare(strict_types = 1);

namespace App;

use App\Color;

class CrayonBox
{
    /**
     * Return valid colors as color name => array(red, green, blue)
     * 
     * Note the array is returned from function call
     * because we want to have getColor able to be called statically
     * so we can't have instance variables to store the array
     * 
     * @return array
     */

     public static function colorList(): array
     {
         return [
             'black' => [0, 0, 0],
             'green' => [0, 128, 0],
             'red' => [255, 0, 0],
             'lime' => [0, 255, 0],
             // the rest of colors ...
             'aqua' => [0, 255, 255],
         ];
     }

     /**
      * Factory method to return a Color
      * 
      * @param string $colorName    the name of the desired color
      * @return Color
      */
      static public function getColor($colorName)
      {
          $colorName = strtolower($colorName);

          if (array_key_exists($colorName, $colors = CrayonBox::colorList())) {
              $color = $colors[$colorName];

              return new Color($color[0], $color[1], $color[2]);
          }

          trigger_error("No color '$colorName' available");
          
          // defalut to black
          return new Color;
      }
}