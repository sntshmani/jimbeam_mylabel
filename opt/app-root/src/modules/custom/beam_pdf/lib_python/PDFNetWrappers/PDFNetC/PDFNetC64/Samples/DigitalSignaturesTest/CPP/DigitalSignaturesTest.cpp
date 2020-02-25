//---------------------------------------------------------------------------------------
// Copyright (c) 2001-2019 by PDFTron Systems Inc. All Rights Reserved.
// Consult legal.txt regarding legal and license information.
//---------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------------------------
// This sample demonstrates the basic usage of high-level digital signature API in PDFNet.
//
// The following steps reflect typical intended usage of the digital signature API:
//
//	0.	Start with a PDF with or without form fields in it that one would like to lock (or, one can add a field, see (1)).
//	
//	1.	EITHER: 
//		(a) Call doc.CreateDigitalSignatureField, optionally providing a name. You receive a DigitalSignatureField.
//		-OR-
//		(b) If you didn't just create the digital signature field that you want to sign/certify, find the existing one within the 
//		document by using PDFDoc.DigitalSignatureFieldIterator or by using PDFDoc.GetField to get it by its fully qualified name.
//	
//	2.	Create a signature widget annotation, and pass the DigitalSignatureField that you just created or found. 
//		If you want it to be visible, provide a Rect argument with a non-zero width or height, and don't set the
//		NoView and Hidden flags. [Optionally, add an appearance to the annotation when you wish to sign/certify.]
//		
//	[3. (OPTIONAL) Add digital signature restrictions to the document using the field modification permissions (SetFieldPermissions) 
//		or document modification permissions functions (SetDocumentPermissions) of DigitalSignatureField. These features disallow 
//		certain types of changes to be made to the document without invalidating the cryptographic digital signature's hash once it
//		is signed.]
//		
//	4. 	Call either CertifyOnNextSave or SignOnNextSave. There are three overloads for each one (six total):
//		a.	Taking a PKCS #12 keyfile path and its password
//		b.	Taking a buffer containing a PKCS #12 private keyfile and its password
//		c.	Taking a unique identifier of a signature handler registered with the PDFDoc. This overload is to be used
//			in the following fashion: 
//			i)		Extend and implement a new SignatureHandler. The SignatureHandler will be used to add or 
//					validate/check a digital signature.
//			ii)		Create an instance of the implemented SignatureHandler and register it with PDFDoc with 
//					pdfdoc.AddSignatureHandler(). The method returns a SignatureHandlerId.
//			iii)	Call SignOnNextSaveWithCustomHandler/CertifyOnNextSaveWithCustomHandler with the SignatureHandlerId.
//		NOTE: It is only possible to sign/certify one signature per call to the Save function.
//	
//	5.	Call pdfdoc.Save(). This will also create the digital signature dictionary and write a cryptographic hash to it.
//		IMPORTANT: If there are already signed/certified digital signature(s) in the document, you must save incrementally
//		so as to not invalidate the other signature's('s) cryptographic hashes. 
//
// Additional processing can be done before document is signed. For example, UseSignatureHandler() returns an instance
// of SDF dictionary which represents the signature dictionary (or the /V entry of the form field). This can be used to
// add additional information to the signature dictionary (e.g. Name, Reason, Location, etc.).
//
// Although the steps above describes extending the SignatureHandler class, this sample demonstrates the use of
// StdSignatureHandler (a built-in SignatureHandler in PDFNet) to sign a PDF file.
//----------------------------------------------------------------------------------------------------------------------

// To build and run this sample with OpenSSL, please specify OpenSSL include & lib paths to project settings.
//
// In MSVC, this can be done by opening the DigitalSignatureTest project's properties. Go to Configuration Properties ->
// C/C++ -> General -> Additional Include Directories. Add the path to the OpenSSL headers here. Next, go to
// Configuration Properties -> Linker -> General -> Additional Library Directories. Add the path to the OpenSSL libraries
// here. Finally, under Configuration Properties -> Linker -> Input -> Additional Dependencies, add libeay32.lib,
// crypt32.lib, and advapi32.lib in the list.
//
// For GCC, modify the Makefile, add -lcrypto to the $(LIBS) variable. If OpenSSL is installed elsewhere, it may be
// necessary to add the path to the headers in the $(INCLUDE) variable as well as the location of either libcrypto.a or
// libcrypto.so/libcrypto.dylib.
//

#define USE_STD_SIGNATURE_HANDLER 1 // Comment out this line if you intend to use OpenSSLSignatureHandler rather than StdSignatureHandler.

// standard library includes
#include <cstdio>
#include <iostream>
#include <vector>

// PDFNetC includes
#include <Common/Exception.h>
#include <Common/UString.h>
#include <PDF/Page.h>
#include <PDF/Annot.h>
#include <PDF/Annots/TextWidget.h>
#include <PDF/Date.h>
#include <PDF/Element.h>
#include <PDF/ElementBuilder.h>
#include <PDF/ElementWriter.h>
#include <PDF/Field.h>
#include <PDF/Image.h>
#include <PDF/PDFDoc.h>
#include <PDF/PDFNet.h>
#include <SDF/SignatureHandler.h>
#include <PDF/Annots/SignatureWidget.h>

#if (!USE_STD_SIGNATURE_HANDLER)
// OpenSSL includes
#include <openssl/err.h>
#include <openssl/evp.h>
#include <openssl/pkcs12.h>
#include <openssl/pkcs7.h>
#include <openssl/rsa.h>
#include <openssl/sha.h>
#endif // (!USE_STD_SIGNATURE_HANDLER)

using namespace std;
using namespace pdftron;
using namespace pdftron::SDF;
using namespace pdftron::PDF::Annots;
using namespace pdftron::PDF;

//////////////////// Here follows an example of how to implement a custom signature handler. //////////
#if (!USE_STD_SIGNATURE_HANDLER)
//
// Extend SignatureHandler by using OpenSSL signing utilities.
//
class OpenSSLSignatureHandler : public SignatureHandler
{
public:
	OpenSSLSignatureHandler(const char* in_pfxfile, const char* in_password) : m_pfxfile(in_pfxfile), m_password(in_password)
	{
		FILE* fp = fopen(in_pfxfile, "rb");
		if (fp == NULL)
			throw (Common::Exception("Cannot open private key.", __LINE__, __FILE__, "PKCS7Signature::PKCS7Signature", "Cannot open private key."));

		PKCS12* p12 = d2i_PKCS12_fp(fp, NULL);
		fclose(fp);

		if (p12 == NULL)
			throw (Common::Exception("Cannot parse private key.", __LINE__, __FILE__, "PKCS7Signature::PKCS7Signature", "Cannot parse private key."));

		mp_pkey = NULL;
		mp_x509 = NULL;
		mp_ca = NULL;
		int parseResult = PKCS12_parse(p12, in_password, &mp_pkey, &mp_x509, &mp_ca);
		PKCS12_free(p12);

		if (parseResult == 0)
			throw (Common::Exception("Cannot parse private key.", __LINE__, __FILE__, "PKCS7Signature::PKCS7Signature", "Cannot parse private key."));

		Reset();
	}

	virtual UString GetName() const
	{
		return (UString("Adobe.PPKLite"));
	}

	virtual void AppendData(const std::vector<pdftron::UInt8>& in_data)
	{
		SHA1_Update(&m_sha_ctx, (const void*) &(in_data[0]), in_data.size());
		return;
	}

	virtual bool Reset()
	{
		m_digest.resize(0);
		m_digest.clear();
		SHA1_Init(&m_sha_ctx);
		return (true);
	}

	virtual std::vector<pdftron::UInt8> CreateSignature()
	{
		if (m_digest.size() == 0) {
			m_digest.resize(SHA_DIGEST_LENGTH);
			SHA1_Final(&(m_digest[0]), &m_sha_ctx);
		}

		PKCS7* p7 = PKCS7_new();
		PKCS7_set_type(p7, NID_pkcs7_signed);

		PKCS7_SIGNER_INFO* p7Si = PKCS7_add_signature(p7, mp_x509, mp_pkey, EVP_sha1());
		PKCS7_add_attrib_content_type(p7Si, OBJ_nid2obj(NID_pkcs7_data));
		PKCS7_add0_attrib_signing_time(p7Si, NULL);
		PKCS7_add1_attrib_digest(p7Si, &(m_digest[0]), (int)m_digest.size());
		PKCS7_add_certificate(p7, mp_x509);

		for (int c = 0; c < sk_X509_num(mp_ca); c++) {
			X509* cert = sk_X509_value(mp_ca, c);
			PKCS7_add_certificate(p7, cert);
		}
		PKCS7_set_detached(p7, 1);
		PKCS7_content_new(p7, NID_pkcs7_data);

		PKCS7_SIGNER_INFO_sign(p7Si);

		int p7Len = i2d_PKCS7(p7, NULL);
		std::vector<unsigned char> result(p7Len);
		UInt8* pP7Buf = &(result[0]);
		i2d_PKCS7(p7, &pP7Buf);

		PKCS7_free(p7);

		return (result);
	}

	virtual OpenSSLSignatureHandler* Clone() const
	{
		return (new OpenSSLSignatureHandler(m_pfxfile.c_str(), m_password.c_str()));
	}

	virtual ~OpenSSLSignatureHandler()
	{
		sk_X509_free(mp_ca);
		X509_free(mp_x509);
		EVP_PKEY_free(mp_pkey);
	}

private:
	std::vector<UInt8> m_digest;
	std::string m_pfxfile;
	std::string m_password;

	SHA_CTX m_sha_ctx;
	EVP_PKEY* mp_pkey;      // private key
	X509* mp_x509;          // signing certificate
	STACK_OF(X509)* mp_ca;  // certificate chain up to the CA
}; // class OpenSSLSignatureHandler
#endif // (!USE_STD_SIGNATURE_HANDLER)
////////// End of the OpenSSLSignatureHandler custom handler code. ////////////////////

string input_path =  "../../TestFiles/";
string output_path = "../../TestFiles/Output/";

void CertifyPDF(const UString& in_docpath,
	const UString& in_cert_field_name,
	const UString& in_private_key_file_path,
	const UString& in_keyfile_password,
	const UString& in_appearance_image_path,
	const UString& in_outpath)
{
	cout << "================================================================================\n";
	cout << "Certifying PDF document\n";

	// Open an existing PDF
	PDFDoc doc(in_docpath);

	cout << "PDFDoc has " << (doc.HasSignatures() ? "signatures" : "no signatures") << "\n";

	Page page1 = doc.GetPage(1);

	// Create a random text field that we can lock using the field permissions feature.
	Annots::TextWidget annot1 = Annots::TextWidget::Create(doc, Rect(50, 550, 350, 600), "asdf_test_field");
	page1.AnnotPushBack(annot1);

	/* Create new signature form field in the PDFDoc. The name argument is optional;
	leaving it empty causes it to be auto-generated. However, you may need the name for later.
	Acrobat doesn't show digsigfield in side panel if it's without a widget. Using a
	Rect with 0 width and 0 height, or setting the NoPrint/Invisible flags makes it invisible. */
	PDF::DigitalSignatureField certification_sig_field = doc.CreateDigitalSignatureField(in_cert_field_name);
	Annots::SignatureWidget widgetAnnot = Annots::SignatureWidget::Create(doc, Rect(0, 100, 200, 150), certification_sig_field);
	page1.AnnotPushBack(widgetAnnot);

	// (OPTIONAL) Add an appearance.

	// Widget AP from image
	PDF::Image img = PDF::Image::Create(doc, in_appearance_image_path);
	widgetAnnot.CreateSignatureAppearance(img);
	// End of optional appearance-adding code.

	// Add permissions. Lock the random text field.
	cout << "Adding document permissions.\n";
	certification_sig_field.SetDocumentPermissions(DigitalSignatureField::e_annotating_formfilling_signing_allowed);
	cout << "Adding field permissions.\n";
	vector<UString> fields_to_lock;
	fields_to_lock.push_back("asdf_test_field");
	certification_sig_field.SetFieldPermissions(DigitalSignatureField::e_include, fields_to_lock);

#ifdef USE_STD_SIGNATURE_HANDLER
	certification_sig_field.CertifyOnNextSave(in_private_key_file_path, in_keyfile_password);
#else
	OpenSSLSignatureHandler sigHandler(in_private_key_file_path, in_keyfile_password);
	SignatureHandlerId sigHandlerId = doc.AddSignatureHandler(sigHandler);
	certification_sig_field.CertifyOnNextSaveWithCustomHandler(sigHandlerId);
#endif

	///// (OPTIONAL) Add more information to the signature dictionary.
	certification_sig_field.SetLocation("Vancouver, BC");
	certification_sig_field.SetReason("Document certification.");
	certification_sig_field.SetContactInfo("www.pdftron.com");
	///// End of optional sig info code.

	// Save the PDFDoc. Once the method below is called, PDFNetC will also sign the document using the information provided.
	doc.Save(in_outpath, 0, NULL);

	cout << "================================================================================\n";
}

void SignPDF(const UString& in_docpath,
	const UString& in_approval_field_name,
	const UString& in_private_key_file_path,
	const UString& in_keyfile_password,
	const UString& in_appearance_img_path,
	const UString& in_outpath)
{
	cout << "================================================================================\n";
	cout << "Signing PDF document\n";

	// Open an existing PDF
	PDFDoc doc(in_docpath);

	// Sign the approval signatures.
	Field found_approval_field(doc.GetField(in_approval_field_name));
	PDF::DigitalSignatureField found_approval_signature_digsig_field(found_approval_field);
	PDF::Image img2 = PDF::Image::Create(doc, in_appearance_img_path);
	Annots::SignatureWidget found_approval_signature_widget(found_approval_field.GetSDFObj());
	found_approval_signature_widget.CreateSignatureAppearance(img2);

#ifdef USE_STD_SIGNATURE_HANDLER
	found_approval_signature_digsig_field.SignOnNextSave(in_private_key_file_path, in_keyfile_password);
#else
	OpenSSLSignatureHandler sigHandler(in_private_key_file_path, in_keyfile_password);
	SignatureHandlerId sigHandlerId = doc.AddSignatureHandler(sigHandler);
	found_approval_signature_digsig_field.SignOnNextSaveWithCustomHandler(sigHandlerId);
#endif

	doc.Save(in_outpath, SDFDoc::e_incremental, NULL);

	cout << "================================================================================\n";
}

void ClearSignature(const UString& in_docpath,
	const UString& in_digsig_field_name,
	const UString& in_outpath)
{
	cout << "================================================================================\n";
	cout << "Clearing certification signature\n";

	PDFDoc doc(in_docpath);

	DigitalSignatureField digsig(doc.GetField(in_digsig_field_name));
	
	cout << "Clearing signature: " << in_digsig_field_name << "\n";
	digsig.ClearSignature();

	if (!digsig.HasCryptographicSignature())
	{
		puts("Cryptographic signature cleared properly.");
	}

	// Save incrementally so as to not invalidate other signatures' hashes from previous saves.
	doc.Save(in_outpath, SDFDoc::e_incremental, NULL);

	cout << "================================================================================\n";
}

void PrintSignaturesInfo(const UString& in_docpath)
{
	cout << "================================================================================\n";
	cout << "Reading and printing digital signature information\n";

	PDFDoc doc(in_docpath);
	if (!doc.HasSignatures())
	{
		cout << "Doc has no signatures.\n";
		cout << "================================================================================\n";
		return;
	}
	else
	{
		cout << "Doc has signatures.\n";
	}

	
	for (FieldIterator fitr = doc.GetFieldIterator(); fitr.HasNext(); fitr.Next())
	{
		fitr.Current().IsLockedByDigitalSignature() ? puts("==========\nField locked by a digital signature") :
			puts("==========\nField not locked by a digital signature");

		cout << "Field name: " << fitr.Current().GetName() << "\n";
		puts("==========");
	}

	puts("====================\nNow iterating over digital signatures only.\n====================");

	DigitalSignatureFieldIterator digsig_fitr = doc.GetDigitalSignatureFieldIterator();
	for (; digsig_fitr.HasNext(); digsig_fitr.Next())
	{
		puts("==========");
		cout << "Field name of digital signature: " << Field(digsig_fitr.Current().GetSDFObj()).GetName() << "\n";

		DigitalSignatureField digsigfield(digsig_fitr.Current());
		if (!digsigfield.HasCryptographicSignature())
		{
			cout << "Either digital signature field lacks a digital signature dictionary, "
				"or digital signature dictionary lacks a cryptographic hash entry. "
				"Digital signature field is not presently considered signed.\n"
				"==========\n";
			continue;
		}

		UInt32 cert_count = digsigfield.GetCertCount();
		cout << "Cert count: " << cert_count << "\n";
		for (UInt32 i = 0; i < cert_count; ++i)
		{
			std::vector<unsigned char> cert = digsigfield.GetCert(i);
			cout << "Cert #" << i << " size: " << cert.size() << "\n";
		}

		DigitalSignatureField::SubFilterType subfilter = digsigfield.GetSubFilter();

		cout << "Subfilter type: " << (int)subfilter << "\n";

		if (subfilter != DigitalSignatureField::e_ETSI_RFC3161)
		{
			cout << "Signature's signer: " << digsigfield.GetSignatureName() << "\n";

			Date signing_time(digsigfield.GetSigningTime());
			if (signing_time.IsValid())
			{
				cout << "Signing day: " << (int)signing_time.day << "\n";
			}

			cout << "Location: " << digsigfield.GetLocation() << "\n";
			cout << "Reason: " << digsigfield.GetReason() << "\n";
			cout << "Contact info: " << digsigfield.GetContactInfo() << "\n";
		}
		else
		{
			cout << "SubFilter == e_ETSI_RFC3161 (DocTimeStamp; no signing info)\n";
		}

		cout << ((digsigfield.HasVisibleAppearance()) ? "Visible" : "Not visible") << "\n";

		DigitalSignatureField::DocumentPermissions digsig_doc_perms = digsigfield.GetDocumentPermissions();
		vector<UString> locked_fields(digsigfield.GetLockedFields());
		for (vector<UString>::iterator it = locked_fields.begin(); it != locked_fields.end(); ++it)
		{
			cout << "This digital signature locks a field named: " << it->ConvertToAscii() << "\n";
		}

		switch (digsig_doc_perms)
		{
		case DigitalSignatureField::e_no_changes_allowed:
			cout << "No changes to the document can be made without invalidating this digital signature.\n";
			break;
		case DigitalSignatureField::e_formfilling_signing_allowed:
			cout << "Page template instantiation, form filling, and signing digital signatures are allowed without invalidating this digital signature.\n";
			break;
		case DigitalSignatureField::e_annotating_formfilling_signing_allowed:
			cout << "Annotating, page template instantiation, form filling, and signing digital signatures are allowed without invalidating this digital signature.\n";
			break;
		case DigitalSignatureField::e_unrestricted:
			cout << "Document not restricted by this digital signature.";
			break;
		default:
			BASE_ASSERT(false, "Unrecognized digital signature document permission level.");
		}
		puts("==========");
	}

	cout << "================================================================================\n";
}

int main(void)
{
	// Initialize PDFNetC
	PDFNet::Initialize();

#if (!USE_STD_SIGNATURE_HANDLER)
	// Initialize OpenSSL library
	CRYPTO_malloc_init();
	ERR_load_crypto_strings();
	OpenSSL_add_all_algorithms();
#endif // (!USE_STD_SIGNATURE_HANDLER)

	int ret = 0;

	//////////////////// TEST 0: 
	/* Create an approval signature field that we can sign after certifying.
	(Must be done before calling CertifyOnNextSave/SignOnNextSave/WithCustomHandler.) */
	try
	{
		PDFDoc doc(input_path + "tiger.pdf");
		PDF::DigitalSignatureField approval_signature_field = doc.CreateDigitalSignatureField("PDFTronApprovalSig");
		Annots::SignatureWidget widgetAnnotApproval = Annots::SignatureWidget::Create(doc, Rect(300, 300, 500, 200), approval_signature_field);
		Page page1 = doc.GetPage(1);
		page1.AnnotPushBack(widgetAnnotApproval);
		doc.Save(output_path + "tiger_withApprovalField_output.pdf", SDFDoc::e_remove_unused, 0);
	}
	catch (Common::Exception& e)
	{
		cerr << e << "\n";
		ret = 1;
	}
	catch (exception& e)
	{
		cerr << e.what() << "\n";
		ret = 1;
	}
	catch (...)
	{
		cerr << "Unknown exception.\n";
		ret = 1;
	}

	//////////////////// TEST 1: certify a PDF.
	try
	{
		CertifyPDF(input_path + "tiger_withApprovalField.pdf",
			"PDFTronCertificationSig",
			input_path + "pdftron.pfx",
			"password",
			input_path + "pdftron.bmp",
			output_path + "tiger_withApprovalField_certified_output.pdf");
		PrintSignaturesInfo(output_path + "tiger_withApprovalField_certified_output.pdf");
	}
	catch (Common::Exception& e)
	{
		cerr << e << "\n";
		ret = 1;
	}
	catch (exception& e)
	{
		cerr << e.what() << "\n";
		ret = 1;
	}
	catch (...)
	{
		cerr << "Unknown exception.\n";
		ret = 1;
	}

	//////////////////// TEST 2: sign a PDF with a certification and an unsigned signature field in it.
	try
	{
		SignPDF(input_path + "tiger_withApprovalField_certified.pdf",
			"PDFTronApprovalSig",
			input_path + "pdftron.pfx",
			"password",
			input_path + "signature.jpg",
			output_path + "tiger_withApprovalField_certified_approved_output.pdf");
		PrintSignaturesInfo(output_path + "tiger_withApprovalField_certified_approved_output.pdf");
	}
	catch (Common::Exception& e)
	{
		cerr << e << "\n";
		ret = 1;
	}
	catch (exception& e)
	{
		cerr << e.what() << "\n";
		ret = 1;
	}
	catch (...)
	{
		cerr << "Unknown exception.\n";
		ret = 1;
	}

	//////////////////// TEST 3: Clear a certification from a document that is certified and has two approval signatures.
	try
	{
		ClearSignature(input_path + "tiger_withApprovalField_certified_approved.pdf",
			"PDFTronCertificationSig",
			output_path + "tiger_withApprovalField_certified_approved_certcleared_output.pdf");
		PrintSignaturesInfo(output_path + "tiger_withApprovalField_certified_approved_certcleared_output.pdf");
	}
	catch (Common::Exception& e)
	{
		cerr << e << "\n";
		ret = 1;
	}
	catch (exception& e)
	{
		cerr << e.what() << "\n";
		ret = 1;
	}
	catch (...)
	{
		cerr << "Unknown exception.\n";
		ret = 1;
	}

	//////////////////// End of tests. ////////////////////

	if (!ret)
	{
		cout << "Tests successful.\n==========\n";
	}
	else
	{
		cout << "Tests FAILED!!!\n==========\n";
	}

	PDFNet::Terminate();

#if (!USE_STD_SIGNATURE_HANDLER)
	ERR_free_strings();
	EVP_cleanup();
#endif // (!USE_STD_SIGNATURE_HANDLER)

	return ret;
}
