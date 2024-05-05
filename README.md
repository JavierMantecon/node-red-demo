# node-demo
Node red demo to show the potential of the platform.
It consists of a set of nodes that can be used to:
- Extract text from images with Tesseract OCR.
- Crop images with Imagick (ImageMagick).

## Installation
TODO: Add installation instructions

The nodes are implemented in two versions:
- v1: The one with much arbitrary complexity. It's a good example of use of context variables on Node-RED. For that reason it wasn't removed.
- v2: The simpler one with a right and correct use of modularization, encapsulation and composition.

Don't use this project for production, it's just a demo. Error handling is not poolished nor security of the project was checked.

## V1 test
http://localhost:1880/v1/image/nr-ocr-extractor?url=url_to_process
http://localhost:1880/v1/image/nr-cropper?url=url_to_process
http://localhost:1880/v1/image/nr-cropper-ocr?url=url_to_process
## V2 test
http://localhost:1880/v2/image/nr-ocr-extractor?url=url_to_process
http://localhost:1880/v2/image/nr-cropper?url=url_to_process
http://localhost:1880/v2/image/nr-cropper-ocr?url=url_to_process
