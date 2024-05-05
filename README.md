# node-red-demo
Node red demo to show the potential of the platform.
It consists of a set of nodes that can be used to:
- Extract text from images with Tesseract OCR.
- Crop images with Imagick (ImageMagick).

These two functionalities are hosted on a container with PHP Slim 4 framework

## Installation
1. Clone this repository.
2. `cd node-red-demo`
3. `make run` for building images and executing docker compose up.

## Usage

**DISCLAIMER:** Don't use this project for production, it's just a demo. Error handling is not poolished nor security of
the project was checked.

The nodes are implemented in two versions. Using anyone of them leads to the same result.
- **v1**: The one with much arbitrary complexity. It's a good example of use of context variables on Node-RED. For that
reason it wasn't removed.
- **v2**: The simpler one with a right and correct use of modularization, encapsulation and composition.

Node-RED is running on http://localhost:1880

Nginx with PHP Slim 4 is running on http://localhost:8080

API endpoints from PHP code served by Nginx container can be consumed on Node-RED panel using f.e the following URL
(communication inside internal docker network):
http://nginx/image/cropper

### Node-RED V1 endpoints
- http://localhost:1880/v1/image/nr-ocr-extractor?url=url_to_process
- http://localhost:1880/v1/image/nr-cropper?url=url_to_process
- http://localhost:1880/v1/image/nr-cropper-ocr?url=url_to_process
### Node-RED V2 endpoints
- http://localhost:1880/v2/image/nr-ocr-extractor?url=url_to_process
- http://localhost:1880/v2/image/nr-cropper?url=url_to_process
- http://localhost:1880/v2/image/nr-cropper-ocr?url=url_to_process
