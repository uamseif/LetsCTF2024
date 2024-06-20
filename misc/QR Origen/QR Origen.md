# QR Origen
## Description
Mi jefe leyó en una revista que en China la gente utiliza códigos QR para pagar productos. Él cree que es el futuro y quiere que haya códigos QR en todas partes, desde el sitio web de la empresa hasta su máquina de café. Para cumplir con los nuevos requisitos de mi jefe, me pidió que escribiera una aplicación que genere códigos QR. Pasé días en ello, ya que el alcance siempre cambia.

Gracias a Dios, llegó el fin de semana y puedo olvidarme de estos códigos QR. Ayer, vi "Origen" de Christopher Nolan, fue genial, pero la noche no terminó bien y tuve sueños extraños.

Les comparto una imagen que tomé durante mi sueño (sí puedo, porque soy un hacker). Bienvenidos a mi "inception" de códigos QR...!


Archivos:
- `inception.png`

## Solution
El reto se puede resolver con el siguiente script:

```python
import base64
import os
from io import BytesIO
import numpy as np
import pyboof as pb
from PIL import Image, ImageOps

output_filename = "inception.png"
temp_filename = "temp.png"

big_qr_box_size = 260
big_qr_border_boxes = 4
small_qr_box_size = 1
small_qr_border_boxes = 0
width_boxes = 21
height_boxes = 21

big_img = Image.open(output_filename)

final_text = ""

for i in range(21):
    for j in range(21):
        x = (big_qr_border_boxes * big_qr_box_size) + \
            (i * big_qr_box_size) + \
            int(big_qr_box_size / 2) - \
            int(width_boxes / 2) - 2
        y = (big_qr_border_boxes * big_qr_box_size) + \
            (j * big_qr_box_size) + \
            int(big_qr_box_size / 2) - \
            int(height_boxes / 2) - 2

        box = (x, y, x + width_boxes + 4, y + height_boxes + 4)

        chunk = big_img.crop(box)
        new_size = (250, 250)
        chunk = chunk.resize(new_size)
        black = chunk.getpixel((0, 0)) == 0
        if black:
            chunk = ImageOps.invert(chunk)

        chunk.save(temp_filename)

        image = pb.load_single_band(temp_filename, np.uint8)

        detector = pb.FactoryFiducial(np.uint8).qrcode()
        detector.detect(image)

        if len(detector.detections) > 0:
            final_text = final_text + detector.detections[0].message
            #print(final_text)

base_str = final_text.split("\". ")[1]

data = base64.b64decode(base_str)
final_image = Image.open(BytesIO(data))

final_image.save(temp_filename)

image = pb.load_single_band(temp_filename, np.uint8)
detector = pb.FactoryFiducial(np.uint8).qrcode()
detector.detect(image)

if len(detector.detections) > 0:
    print(detector.detections[0].message)

os.remove(temp_filename)
```