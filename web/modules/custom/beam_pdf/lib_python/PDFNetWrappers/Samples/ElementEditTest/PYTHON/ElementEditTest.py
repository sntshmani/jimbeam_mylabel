#---------------------------------------------------------------------------------------
# Copyright (c) 2001-2019 by PDFTron Systems Inc. All Rights Reserved.
# Consult LICENSE.txt regarding license information.
#---------------------------------------------------------------------------------------

import site
site.addsitedir("../../../PDFNetC/Lib")
import sys
from PDFNetPython import *

#---------------------------------------------------------------------------------------
# The sample code shows how to edit the page display list and how to modify graphics state 
# attributes on existing Elements. In particular the sample program strips all images from 
# the page and changes text color to blue. 
#---------------------------------------------------------------------------------------

def ProcessElements(reader, writer, map):
    element = reader.Next()     # Read page contents
    while element != None:
        type = element.GetType()
        if type == Element.e_image:
            # remove all images by skipping them
            pass
        elif type == Element.e_inline_image:            
            # remove all images by skipping them
            pass
        elif type == Element.e_text:    # Process text strings...
            # Set all text to blue color.
            gs = element.GetGState()
            gs.SetFillColorSpace(ColorSpace.CreateDeviceRGB())
            cp = ColorPt(0, 0, 1)
            gs.SetFillColor(cp)
            writer.WriteElement(element)
        elif type == Element.e_form:    # Recursively process form XObjects
            o = element.GetXObject()
            map[o.GetObjNum()] = o
            writer.WriteElement(element)
            pass
        else:
            writer.WriteElement(element)
        element = reader.Next()

def main():
    PDFNet.Initialize()
    
    # Relative path to the folder containing the test files.
    input_path = "../../TestFiles/"
    output_path = "../../TestFiles/Output/"
    input_filename = "newsletter.pdf"
    output_filename = "newsletter_edited.pdf"
    
    print("-------------------------------------------------")
    
    # Open the test file
    print("Opening the input file...")
    doc = PDFDoc(input_path + input_filename)
    doc.InitSecurityHandler()
    
    writer = ElementWriter()
    reader = ElementReader()
    
    itr = doc.GetPageIterator()
    
    while itr.HasNext():
        page = itr.Current()
        reader.Begin(page)
        writer.Begin(page, ElementWriter.e_replacement, False)
        map1 = {}
        ProcessElements(reader, writer, map1)
        writer.End()
        reader.End()
		
        map2 = {}
        while (map1 or map2):
            for k in map1.keys():
                obj = map1[k]
                writer.Begin(obj)
                reader.Begin(obj, page.GetResourceDict())
                ProcessElements(reader, writer, map2)
                reader.End()
                writer.End()

                del map1[k]
            if (not map1 and map2):
                map1.update(map2)
                map2.clear()
        itr.Next()
        
    doc.Save(output_path + output_filename, SDFDoc.e_remove_unused)
    doc.Close()
    print("Done. Result saved in " + output_filename +"...")
    
if __name__ == '__main__':
    main()