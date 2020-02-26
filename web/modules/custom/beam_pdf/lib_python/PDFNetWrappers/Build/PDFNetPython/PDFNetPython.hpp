/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 3.0.12
 *
 * This file is not intended to be easily readable and contains a number of
 * coding conventions designed to improve portability and efficiency. Do not make
 * changes to this file unless you know what you are doing--modify the SWIG
 * interface file instead.
 * ----------------------------------------------------------------------------- */

#ifndef SWIG_PDFNetPython_WRAP_H_
#define SWIG_PDFNetPython_WRAP_H_

#include <map>
#include <string>


class SwigDirector_Callback : public pdftron::PDF::Callback, public Swig::Director {

public:
    SwigDirector_Callback(PyObject *self);
    virtual ~SwigDirector_Callback();
    virtual void RenderBeginEventProc();
    virtual void RenderFinishEventProc(bool cancelled);
    virtual void ErrorReportProc(char const *message);
    virtual void CurrentPageProc(int current_page, int num_pages);
    virtual void JavaScriptEventProc(char const *event_type, char const *json);
    virtual void CurrentZoomProc(double curr_zoom_proc);
    virtual void ThumbAsyncHandler(int page_num, bool was_thumb_found, char const *thumb_buf, int thumb_width, int thumb_height);
    virtual void RequestRenderInWorkerThread();
    virtual void FindTextHandler(bool success, pdftron::PDF::Selection selection);
    virtual void CreateTileProc(char *buffer, int originX, int originY, int width, int height, int pagNum, long long cellNumber, bool finalRender, bool predictionRender, int tilesRemaining, bool firstTile, int canvasWidth, int canvasHeight, int cellSideLength, int cellPerRow, int cellPerCol, int thumbnailId);
    virtual void AnnotBitmapProc(int operation_type, char *buffer, UInt32 width, UInt32 height, UInt32 stride, UInt32 page_num, UInt32 annot_index, void const *annot_key, Int64 x_in_page, Int64 y_in_page, int x_offset, int y_offset, int remaining_tiles, int sequence_number, Int64 x_page_size, Int64 y_page_size);
    virtual void DeluxeCreateTileProc(char *buffer, unsigned int width, unsigned int height, unsigned int stride, unsigned int page_num, UInt64 x_page_loc, UInt64 y_page_loc, unsigned int zoomed_page_width, unsigned int zoomed_page_height, unsigned int tile_id, unsigned int x_in_page, unsigned int y_in_page, int canvas_id, int remaining_tiles, int tile_type, int sequence_number);
    virtual void RemoveTileProc(int canvasNumber, Int64 cellNumber, int thumbnailId, int sequenceNumber);
    virtual void PartDownloadedProc(int dlType, TRN_PDFDoc doc, unsigned int pageNum, unsigned int objNum, char const *message);

/* Internal director utilities */
public:
    bool swig_get_inner(const char *swig_protected_method_name) const {
      std::map<std::string, bool>::const_iterator iv = swig_inner.find(swig_protected_method_name);
      return (iv != swig_inner.end() ? iv->second : false);
    }
    void swig_set_inner(const char *swig_protected_method_name, bool swig_val) const {
      swig_inner[swig_protected_method_name] = swig_val;
    }
private:
    mutable std::map<std::string, bool> swig_inner;

#if defined(SWIG_PYTHON_DIRECTOR_VTABLE)
/* VTable implementation */
    PyObject *swig_get_method(size_t method_index, const char *method_name) const {
      PyObject *method = vtable[method_index];
      if (!method) {
        swig::SwigVar_PyObject name = SWIG_Python_str_FromChar(method_name);
        method = PyObject_GetAttr(swig_get_self(), name);
        if (!method) {
          std::string msg = "Method in class Callback doesn't exist, undefined ";
          msg += method_name;
          Swig::DirectorMethodException::raise(msg.c_str());
        }
        vtable[method_index] = method;
      }
      return method;
    }
private:
    mutable swig::SwigVar_PyObject vtable[14];
#endif

};


class SwigDirector_SignatureHandler : public pdftron::SDF::SignatureHandler, public Swig::Director {

public:
    SwigDirector_SignatureHandler(PyObject *self);
    virtual pdftron::UString GetName() const;
    virtual void AppendData(std::vector< pdftron::UInt8,std::allocator< pdftron::UInt8 > > const &data);
    virtual bool Reset();
    virtual std::vector< pdftron::UInt8,std::allocator< pdftron::UInt8 > > CreateSignature();
    virtual pdftron::SDF::SignatureHandler *Clone() const;
    virtual ~SwigDirector_SignatureHandler();

/* Internal director utilities */
public:
    bool swig_get_inner(const char *swig_protected_method_name) const {
      std::map<std::string, bool>::const_iterator iv = swig_inner.find(swig_protected_method_name);
      return (iv != swig_inner.end() ? iv->second : false);
    }
    void swig_set_inner(const char *swig_protected_method_name, bool swig_val) const {
      swig_inner[swig_protected_method_name] = swig_val;
    }
private:
    mutable std::map<std::string, bool> swig_inner;

#if defined(SWIG_PYTHON_DIRECTOR_VTABLE)
/* VTable implementation */
    PyObject *swig_get_method(size_t method_index, const char *method_name) const {
      PyObject *method = vtable[method_index];
      if (!method) {
        swig::SwigVar_PyObject name = SWIG_Python_str_FromChar(method_name);
        method = PyObject_GetAttr(swig_get_self(), name);
        if (!method) {
          std::string msg = "Method in class SignatureHandler doesn't exist, undefined ";
          msg += method_name;
          Swig::DirectorMethodException::raise(msg.c_str());
        }
        vtable[method_index] = method;
      }
      return method;
    }
private:
    mutable swig::SwigVar_PyObject vtable[5];
#endif

};


#endif