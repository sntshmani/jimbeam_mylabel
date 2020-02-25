// This file is autogenerated: please see the codegen template "Options"
#ifndef PDFTRON_H_CPPPDFDiffOptions
#define PDFTRON_H_CPPPDFDiffOptions

#include <PDF/OptionsBase.h>
#include <PDF/GState.h>

namespace pdftron{ namespace PDF{ 

class DiffOptions
{
public:
	DiffOptions();
	~DiffOptions();

	
	/*
	* Gets the value AddGroupAnnots from the options object
	* Whether we should add an annot layer indicating the difference regions
	* @ return a bool, the current value for AddGroupAnnots.
	*/
	bool GetAddGroupAnnots();

	/*
	* Sets the value for AddGroupAnnots in the options object
	* Whether we should add an annot layer indicating the difference regions
	* @param value: the new value for AddGroupAnnots
	* @return this object, for call chaining
	*/
	DiffOptions& SetAddGroupAnnots(bool value);

	
	/*
	* Gets the value BlendMode from the options object
	* How the two colors should be blended.
	* @ return a GState::BlendMode, the current value for BlendMode.
	*/
	GState::BlendMode GetBlendMode();

	/*
	* Sets the value for BlendMode in the options object
	* How the two colors should be blended.
	* @param value: the new value for BlendMode
	* @return this object, for call chaining
	*/
	DiffOptions& SetBlendMode(GState::BlendMode value);

	
	/*
	* Gets the value ColorA from the options object
	* The difference color for the first page.
	* @ return a ColorPt, the current value for ColorA.
	*/
	ColorPt GetColorA();

	/*
	* Sets the value for ColorA in the options object
	* The difference color for the first page.
	* @param value: the new value for ColorA
	* @return this object, for call chaining
	*/
	DiffOptions& SetColorA(ColorPt value);

	
	/*
	* Gets the value ColorB from the options object
	* The difference color for the second page
	* @ return a ColorPt, the current value for ColorB.
	*/
	ColorPt GetColorB();

	/*
	* Sets the value for ColorB in the options object
	* The difference color for the second page
	* @param value: the new value for ColorB
	* @return this object, for call chaining
	*/
	DiffOptions& SetColorB(ColorPt value);

	
	// @cond PRIVATE_DOC
	#ifndef SWIGHIDDEN
	SDF::Obj& GetInternalObj();

private:
	SDF::ObjSet m_obj_set;
	SDF::Obj m_dict;
	#endif
};

}
}

#include "../Impl/DiffOptions.inl"
#endif // PDFTRON_H_CPPPDFDiffOptions
