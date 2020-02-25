# -*- coding: utf-8 -*-
# Python imports

# 3rd Party imports

# App imports
from pdftron import PDFTron
import sys
import json
import base64
import os

STATIC_PATH = os.path.dirname(os.path.realpath(__file__)) + '/static/'
PATH = STATIC_PATH + 'templates/'

PDFS = {
    'NOFOTO': {
        'bottle_15l': '1.5L_PERSONALISED_LABEL/JB225_1.5L_PERSONALISED_LABEL_NO_FACE_AW03_HR.pdf',
        'bottle_1l': '1L_PERSONALISED_LABEL/JB225_1L_PERSONALISED_LABEL_NO_FACE_AW03_HR.pdf',
        'bottle_70cl': '70CL_PERSONALISED_LABEL/JB225_70CL_PERSONALISED_LABEL_NO_FACE_AW03_HR.pdf',
        'bottle_75cl': '75CL_PERSONALISED_LABEL/JB225_75CL_PERSONALISED_LABEL_NO_FACE_AW03_HR.pdf',
    },
    'FOTO': {
        'bottle_15l': '1.5L_PERSONALISED_LABEL/JB225_1.5L_PERSONALISED_LABEL_WITH_FACE_AW03_HR.pdf',
        'bottle_1l': '1L_PERSONALISED_LABEL/JB225_1L_PERSONALISED_LABEL_WITH_FACE_AW03_HR.pdf',
        'bottle_70cl': '70CL_PERSONALISED_LABEL/JB225_70CL_PERSONALISED_LABEL_WITH_FACE_AW03_HR.pdf',
        'bottle_75cl': '75CL_PERSONALISED_LABEL/JB225_75CL_PERSONALISED_LABEL_WITH_FACE_AW03_HR.pdf',
    }
}

CONFIGS = {
    'bottle_15l': {
        'name': (303, 308),
        'label': (305, 337),
        'image': (515, 285),
        'image_ratio': 1.5,
    },
    'bottle_1l': {
        'name': (262, 307),
        'label': (264, 337),
        'image': (440, 285),
        'image_ratio': 1.5,
    },
    'bottle_70cl': {
        'name': (240, 295),
        'label': (242, 325),
        'image': (404, 270),
        'image_ratio': 1.6,
    },
    'bottle_75cl': {
        'name': (240, 295),
        'label': (242, 325),
        'image': (404, 270),
        'image_ratio': 1.6,
    },
}


def create_pdfs(id, name, label, bottle, image=False, alphabet='latin'):
    if image:
      pdf = PDFS['FOTO'][bottle]
    else:
      pdf = PDFS['NOFOTO'][bottle]
    config=CONFIGS[bottle]

    pdftron = PDFTron(PATH + pdf, '/tmp/drawing-' + id + '.pdf', name,
        label, image, config, alphabet)

    pdftron.render()


if __name__ == '__main__':
    data = sys.argv[1]
    b64 = base64.b64decode(data)
    result = json.loads(b64)

    id = result[0]
    subhead = result[1]
    label = result[2]
    bottle = result[3]
    image = result[4]
    alphabet = result[5]

    create_pdfs(id, subhead, label, bottle, image, alphabet)
