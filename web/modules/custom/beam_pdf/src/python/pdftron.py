import site
import os

# below is the relative path to PDFTron PDFNetC libraries
site.addsitedir(os.path.dirname(os.path.realpath(__file__)) + '/../../lib_python/PDFNetWrappers/PDFNetC/Lib')
from PDFNetPython import *
import statistics

FONT_PATH = os.path.dirname(os.path.realpath(__file__)) + '/static/fonts/'


FONTS = {
    'latin': {
        'name': FONT_PATH + 'agencyfb.ttf',
        'label': FONT_PATH + 'parkside.ttf',
    },
    'cyrillic': {
       'name': FONT_PATH + 'exo2.ttf',
       'label': FONT_PATH + 'elina.ttf',
    }
}


class PDFTron(object):
    def __init__(self, filename, output, name, custom_text, image=False, config={}, alphabet='latin'):
        self.filename = filename
        self.output = output
        self.name = name
        self.custom_text = custom_text
        self.image = image
        self.config = config
        self.fonts = FONTS[alphabet]

    def create_group_name(self, doc, layer, page):
        writer = ElementWriter()
        writer.Begin(doc.GetSDFDoc())
        # Create a path object in the shape of a heart.
        builder = ElementBuilder()

        font_program = self.fonts['name']

        # Begin writing a block of text
        fnt = Font.CreateCIDTrueTypeFont(doc.GetSDFDoc(), font_program, True, True)

        element = builder.CreateTextBegin(fnt, 30)
        writer.WriteElement(element)

        name_converted = self.convert_text_unicode(self.name)

        element = builder.CreateUnicodeTextRun(name_converted, len(name_converted))
        box_width = element.GetBBox().x2 - element.GetBBox().x1
        page_width = page.GetPageWidth()
        offset = ((page_width / 2) - (box_width / 2))

        element.SetTextMatrix(1, 0, 0, 1, offset, self.config['name'][1])

        gstate = element.GetGState()
        gstate.SetFillColorSpace(ColorSpace.CreateDeviceRGB())
        gstate.SetFillColor(ColorPt(0.58, 0.498, 0.282))

        writer.WriteElement(element)

        writer.WriteElement(builder.CreateTextEnd())

        grp_obj = writer.End()

        # Indicate that this form (content group) belongs to the given layer (OCG).
        grp_obj.PutName("Subtype", "Form")
        grp_obj.Put("OC", layer)
        grp_obj.PutRect("BBox", 0, 0, 1000, 1000)  # Set the clip box for the content.

        return grp_obj

    def create_group_label(self, doc, layer, page):
        writer = ElementWriter()
        writer.Begin(doc.GetSDFDoc())

        # Create a path object in the shape of a heart.
        builder = ElementBuilder()

        font_program = self.fonts['label']

        # Begin writing a block of text
        fnt = Font.CreateCIDTrueTypeFont(doc.GetSDFDoc(), font_program, True, True)

        element = builder.CreateTextBegin(fnt, 16)
        writer.WriteElement(element)

        custom_text_converted = self.convert_text_unicode(self.custom_text)

        element = builder.CreateUnicodeTextRun(custom_text_converted, len(custom_text_converted))
        box_width = element.GetBBox().x2 - element.GetBBox().x1
        page_width = page.GetPageWidth()
        offset = ((page_width / 2) - (box_width / 2))

        element.SetTextMatrix(1, 0, 0, 1, offset, self.config['label'][1])

        gstate = element.GetGState()
        gstate.SetFillColorSpace(ColorSpace.CreateDeviceCMYK())
        gstate.SetLeading(2)  # Set the spacing between lines

        writer.WriteElement(element)

        writer.WriteElement(builder.CreateTextEnd())

        grp_obj = writer.End()

        # Indicate that this form (content group) belongs to the given layer (OCG).
        grp_obj.PutName("Subtype", "Form")
        grp_obj.Put("OC", layer)
        grp_obj.PutRect("BBox", 0, 0, 1000, 1000)  # Set the clip box for the content.

        return grp_obj

    def create_group_image(self, doc, layer):
        writer = ElementWriter()
        writer.Begin(doc.GetSDFDoc())

        # Create an Image that can be reused in the document or on the same page.
        img = Image.Create(doc.GetSDFDoc(), self.image)
        builder = ElementBuilder()
        element = builder.CreateImage(img,
                                      Matrix2D(img.GetImageWidth() / self.config['image_ratio'], 0, 0,
                                               img.GetImageHeight() / self.config['image_ratio'],
                                               self.config['image'][0], self.config['image'][1]))
        writer.WritePlacedElement(element)

        grp_obj = writer.End()

        # Indicate that this form (content group) belongs to the given layer (OCG).
        grp_obj.PutName("Subtype", "Form")
        grp_obj.Put("OC", layer)
        grp_obj.PutRect("BBox", 0, 0, 1000, 1000)  # Set the clip box for the content.

        return grp_obj

    def base_create(self, page, element):  # ElementBuilder is used to build new Element objects
        writer = ElementWriter()  # ElementWriter is used to write Elements to the page
        writer.Begin(page)  # Begin writting to the page
        writer.WriteElement(element)
        writer.End()

    def create_name(self, doc, page, layer):
        builder = ElementBuilder()
        element = builder.CreateForm(self.create_group_name(doc, layer.GetSDFObj(), page))
        self.base_create(page, element)

    def create_custom_text(self, doc, page, layer):
        builder = ElementBuilder()
        element = builder.CreateForm(self.create_group_label(doc, layer.GetSDFObj(), page))
        self.base_create(page, element)

    def create_image(self, doc, page, layer):
        builder = ElementBuilder()
        element = builder.CreateForm(self.create_group_image(doc, layer.GetSDFObj()))
        self.base_create(page, element)

    def convert_text_unicode(self, text):
        return [self.byte2int(letter) for letter in text]

    def byte2int(self, bstr, width=32):
        """
        Convert a byte string into a signed integer value of specified width.
        """
        val = sum(ord(b) << 8 * n for (n, b) in enumerate(reversed(bstr)))
        if val >= (1 << (width - 1)):
            val = val - (1 << width)
        return val


    # A utility function used to add new Content Groups (Layers) to the document.
    @staticmethod
    def create_layer(doc, layer_name):
        grp = Group.Create(doc, layer_name)
        cfg = doc.GetOCGConfig()
        if not cfg.IsValid():
            cfg = Config.Create(doc, True)
            cfg.SetName("Default")

        # Add the new OCG to the list of layers that should appear in PDF viewer GUI.
        layer_order_array = cfg.GetOrder()
        if layer_order_array is None:
            layer_order_array = doc.CreateIndirectArray()
            cfg.SetOrder(layer_order_array)
        layer_order_array.PushBack(grp.GetSDFObj())
        return grp

    def render(self):
        PDFNet.Initialize()
        PDFNet.SetDefaultDiskCachingEnabled(False)  # When execute .py script from php

        doc = PDFDoc(self.filename)
        page = doc.GetPage(1)

        init_cfg = doc.GetOCGConfig()
        ctx = Context(init_cfg)

        name_layer = self.create_layer(doc, "VARIABLE DATA NAME")
        self.create_name(doc, page, name_layer)
        label_layer = self.create_layer(doc, "CUSTOM TEXT")
        self.create_custom_text(doc, page, label_layer)
        if self.image:
            image_layer = self.create_layer(doc, "VARIABLE DATA WITH FACE")
            self.create_image(doc, page, image_layer)

        prefs = doc.GetViewPrefs()
        prefs.SetPageMode(PDFDocViewPrefs.e_UseOC)

        ctx.SetNonOCDrawing(True)
        ctx.SetOCDrawMode(Context.e_AllOC)
        doc.Save(self.output, SDFDoc.e_linearized)
        doc.Close()
