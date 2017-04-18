#!/bin/bash
convert -colorspace srgb -density $1 $2 -resize $3x$4 ../images/png_image.png
