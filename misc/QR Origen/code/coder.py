# Import Library
from io import BytesIO
from math import ceil
import qrcode
import base64

from qrcode import constants
from PIL import Image

small_qrs_text = "LetsCTF es un sueño. ¿Cobb todavía está soñando? Espero que hayas programado la recuperación de este mensaje porque \"tenemos que ir más profundo\". "
big_qr_text = "Mira más cerca"
flag = "LetsCTF{Er3s_1n_cr4ck_d3l_QR}"
output_filename = "inception.png"

img = qrcode.make(flag)
flag_img = BytesIO()
img.save(flag_img)
flag_text = base64.b64encode(flag_img.getvalue()).decode("utf-8")
small_qrs_text = small_qrs_text + flag_text

big_qr_box_size = 260
big_qr_border_boxes = 4
small_qr_box_size = 1
small_qr_border_boxes = 0

qr = qrcode.QRCode(
    error_correction=constants.ERROR_CORRECT_L,
    box_size=big_qr_box_size,
    border=big_qr_border_boxes,
)
qr.add_data(big_qr_text)
qr.make(fit=True)

big_img = qr.make_image()
big_img.save(output_filename)
big_img = Image.open(output_filename)

width_boxes = 21
height_boxes = 21

boxes = width_boxes * height_boxes

stride = ceil(len(small_qrs_text) / boxes)
parts = [small_qrs_text[i:i+stride] for i in range(0, len(small_qrs_text), stride)]
str_index = 0

for i in range(21):
    for j in range(21):
        x = (big_qr_border_boxes * big_qr_box_size) + \
            (i * big_qr_box_size) + \
            int(big_qr_box_size / 2) - \
            int(width_boxes / 2)
        y = (big_qr_border_boxes * big_qr_box_size) + \
            (j * big_qr_box_size) + \
            int(big_qr_box_size / 2) - \
            int(height_boxes / 2)

        black = big_img.getpixel((x, y)) == 0

        qr = qrcode.QRCode(
            error_correction=constants.ERROR_CORRECT_L,
            box_size=small_qr_box_size,
            border=small_qr_border_boxes,
        )
        qr.add_data(parts[str_index] if str_index < len(parts) else "")
        qr.make(fit=True)
        small_chunk = qr.make_image(
            fill_color="black" if not black else "white", back_color="white" if not black else "black"
        )
        img_buffer = BytesIO()
        small_chunk.save(img_buffer)

        str_index = str_index + 1
        chunk_img = Image.open(img_buffer)

        big_img.paste(chunk_img, (x, y))

big_img.save(output_filename)