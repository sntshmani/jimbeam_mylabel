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
//		(a) Call doc.createDigitalSignatureField, optionally providing a name. You receive a DigitalSignatureField.
//		-OR-
//		(b) If you didn't just create the digital signature field that you want to sign/certify, find the existing one within the 
//		document by using PDFDoc.DigitalSignatureFieldIterator or by using PDFDoc.getField to get it by its fully qualified name.
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
//					pdfdoc.addSignatureHandler(). The method returns a SignatureHandlerId.
//			iii)	Call SignOnNextSaveWithCustomHandler/CertifyOnNextSaveWithCustomHandler with the SignatureHandlerId.
//		NOTE: It is only possible to sign/certify one signature per call to the Save function.
//	
//	5.	Call pdfdoc.save(). This will also create the digital signature dictionary and write a cryptographic hash to it.
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

import com.pdftron.common.PDFNetException;
import com.pdftron.pdf.annots.TextWidget;
import com.pdftron.pdf.annots.SignatureWidget;
import com.pdftron.pdf.FieldIterator;
import com.pdftron.pdf.DigitalSignatureFieldIterator;
import com.pdftron.pdf.Field;
import com.pdftron.pdf.Image;
import com.pdftron.pdf.PDFDoc;
import com.pdftron.pdf.PDFNet;
import com.pdftron.pdf.Page;
import com.pdftron.pdf.Rect;
import com.pdftron.pdf.Date;
import com.pdftron.pdf.DigitalSignatureField;
import com.pdftron.sdf.Obj;
import com.pdftron.sdf.SignatureHandler;
import com.pdftron.sdf.SDFDoc;

public class DigitalSignaturesTest 
{
	
	public static void certifyPDF(String in_docpath,
		String in_cert_field_name,
		String in_private_key_file_path,
		String in_keyfile_password,
		String in_appearance_image_path,
		String in_outpath) throws PDFNetException
	{
		System.out.println("================================================================================");
		System.out.println("Certifying PDF document");

		// Open an existing PDF
		PDFDoc doc = new PDFDoc(in_docpath);

		if (doc.hasSignatures())
		{
			System.out.println("PDFDoc has signatures");
		}
		else
		{
			System.out.println("PDFDoc has no signatures");
		}

		Page page1 = doc.getPage(1);

		// Create a random text field that we can lock using the field permissions feature.
		TextWidget annot1 = TextWidget.create(doc, new Rect(50, 550, 350, 600), "asdf_test_field");
		page1.annotPushBack(annot1);

		/* Create new signature form field in the PDFDoc. The name argument is optional;
		leaving it empty causes it to be auto-generated. However, you may need the name for later.
		Acrobat doesn't show digsigfield in side panel if it's without a widget. Using a
		Rect with 0 width and 0 height, or setting the NoPrint/Invisible flags makes it invisible. */
		DigitalSignatureField certification_sig_field = doc.createDigitalSignatureField(in_cert_field_name);
		SignatureWidget widgetAnnot = SignatureWidget.create(doc, new Rect(0, 100, 200, 150), certification_sig_field);
		page1.annotPushBack(widgetAnnot);

		// (OPTIONAL) Add an appearance.

		// Widget AP from image
		Image img = Image.create(doc, in_appearance_image_path);
		widgetAnnot.createSignatureAppearance(img);
		// End of optional appearance-adding code.

		// Add permissions. Lock the random text field.
		System.out.println("Adding document permissions.");
		certification_sig_field.setDocumentPermissions(DigitalSignatureField.DocumentPermissions.e_annotating_formfilling_signing_allowed);
		System.out.println("Adding field permissions.");
		String[] fields_to_lock = {"asdf_test_field"};
		certification_sig_field.setFieldPermissions(DigitalSignatureField.FieldPermissions.e_include, fields_to_lock);

		certification_sig_field.certifyOnNextSave(in_private_key_file_path, in_keyfile_password);

		///// (OPTIONAL) Add more information to the signature dictionary.
		certification_sig_field.setLocation("Vancouver, BC");
		certification_sig_field.setReason("Document certification.");
		certification_sig_field.setContactInfo("www.pdftron.com");
		///// End of optional sig info code.

		// Save the PDFDoc. Once the method below is called, PDFNetC will also sign the document using the information provided.
		doc.save(in_outpath, SDFDoc.SaveMode.NO_FLAGS, null);

		System.out.println("================================================================================");
	}

	public static void signPDF(String in_docpath,
		String in_approval_field_name,
		String in_private_key_file_path,
		String in_keyfile_password,
		String in_appearance_img_path,
		String in_outpath) throws PDFNetException
	{
		System.out.println("================================================================================");
		System.out.println("Signing PDF document");

		// Open an existing PDF
		PDFDoc doc = new PDFDoc(in_docpath);

		// Sign the approval signatures.
		Field found_approval_field = doc.getField(in_approval_field_name);
		DigitalSignatureField found_approval_signature_digsig_field = new DigitalSignatureField(found_approval_field);
		Image img2 = Image.create(doc, in_appearance_img_path);
		SignatureWidget found_approval_signature_widget = new SignatureWidget(found_approval_field.getSDFObj());
		found_approval_signature_widget.createSignatureAppearance(img2);

		found_approval_signature_digsig_field.signOnNextSave(in_private_key_file_path, in_keyfile_password);

		doc.save(in_outpath, SDFDoc.SaveMode.INCREMENTAL, null);

		System.out.println("================================================================================");
	}

	public static void clearSignature(String in_docpath,
		String in_digsig_field_name,
		String in_outpath) throws PDFNetException
	{
		System.out.println("================================================================================");
		System.out.println("Clearing certification signature");

		PDFDoc doc = new PDFDoc(in_docpath);

		DigitalSignatureField digsig = new DigitalSignatureField(doc.getField(in_digsig_field_name));
		
		System.out.println("Clearing signature: " + in_digsig_field_name);
		digsig.clearSignature();

		if (!digsig.hasCryptographicSignature())
		{
			System.out.println("Cryptographic signature cleared properly.");
		}

		// Save incrementally so as to not invalidate other signatures' hashes from previous saves.
		doc.save(in_outpath, SDFDoc.SaveMode.INCREMENTAL, null);

		System.out.println("================================================================================");
	}

	 public static void printSignaturesInfo(String in_docpath) throws PDFNetException
	{
		System.out.println("================================================================================");
		System.out.println("Reading and printing digital signature information");

		PDFDoc doc = new PDFDoc(in_docpath);
		if (!doc.hasSignatures())
		{
			System.out.println("Doc has no signatures.");
			System.out.println("================================================================================");
			return;
		}
		else
		{
			System.out.println("Doc has signatures.");
		}

		
		for (FieldIterator fitr = doc.getFieldIterator(); fitr.hasNext(); )
		{
			Field current = fitr.next();
			if (current.isLockedByDigitalSignature())
			{
				System.out.println("==========\nField locked by a digital signature");
			}
			else
			{
				System.out.println("==========\nField not locked by a digital signature");
			}

			System.out.println("Field name: " + current.getName());
			System.out.println("==========");
		}

		System.out.println("====================\nNow iterating over digital signatures only.\n====================");

		DigitalSignatureFieldIterator digsig_fitr = doc.getDigitalSignatureFieldIterator();
		for (; digsig_fitr.hasNext(); )
		{
			DigitalSignatureField current = digsig_fitr.next();
			System.out.println("==========");
			System.out.println("Field name of digital signature: " + new Field(current.getSDFObj()).getName());

			DigitalSignatureField digsigfield = current;
			if (!digsigfield.hasCryptographicSignature())
			{
				System.out.println("Either digital signature field lacks a digital signature dictionary, " +
					"or digital signature dictionary lacks a cryptographic hash entry. " +
					"Digital signature field is not presently considered signed.\n" +
					"==========");
				continue;
			}

			int cert_count = digsigfield.getCertCount();
			System.out.println("Cert count: " + cert_count);
			for (int i = 0; i < cert_count; ++i)
			{
				byte[] cert = digsigfield.getCert(i);
				System.out.println("Cert #" + i + " size: " + cert.length);
			}

			DigitalSignatureField.SubFilterType subfilter = digsigfield.getSubFilter();

			System.out.println("Subfilter type: " + subfilter.ordinal());

			if (subfilter != DigitalSignatureField.SubFilterType.e_ETSI_RFC3161)
			{
				System.out.println("Signature's signer: " + digsigfield.getSignatureName());

				Date signing_time = digsigfield.getSigningTime();
				if (signing_time.isValid())
				{
					System.out.println("Signing day: " + signing_time.getDay());
				}

				System.out.println("Location: " + digsigfield.getLocation());
				System.out.println("Reason: " + digsigfield.getReason());
				System.out.println("Contact info: " + digsigfield.getContactInfo());
			}
			else
			{
				System.out.println("SubFilter == e_ETSI_RFC3161 (DocTimeStamp; no signing info)");
			}

			if (digsigfield.hasVisibleAppearance())
			{
				System.out.println("Visible");
			}
			else
			{
				System.out.println("Not visible");
			}
			
			DigitalSignatureField.DocumentPermissions digsig_doc_perms = digsigfield.getDocumentPermissions();
			String[] locked_fields = digsigfield.getLockedFields();
			for (String it : locked_fields)
			{
				System.out.println("This digital signature locks a field named: " + it);
			}

			switch (digsig_doc_perms)
			{
			case e_no_changes_allowed:
				System.out.println("No changes to the document can be made without invalidating this digital signature.");
				break;
			case e_formfilling_signing_allowed:
				System.out.println("Page template instantiation, form filling, and signing digital signatures are allowed without invalidating this digital signature.");
				break;
			case e_annotating_formfilling_signing_allowed:
				System.out.println("Annotating, page template instantiation, form filling, and signing digital signatures are allowed without invalidating this digital signature.");
				break;
			case e_unrestricted:
				System.out.println("Document not restricted by this digital signature.");
				break;
			default:
				System.err.println("Unrecognized digital signature document permission level.");
				assert(false);
			}
			System.out.println("==========");
		}

		System.out.println("================================================================================");
	}

	public static void main(String[] args) 
	{
		// Initialize PDFNet
		PDFNet.initialize();

		boolean result = true;
		String input_path = "../../TestFiles/";
		String output_path = "../../TestFiles/Output/";

		//////////////////// TEST 0: 
		/* Create an approval signature field that we can sign after certifying.
		(Must be done before calling CertifyOnNextSave/SignOnNextSave/WithCustomHandler.) */
		try
		{
			PDFDoc doc = new PDFDoc(input_path + "tiger.pdf");
			DigitalSignatureField approval_signature_field = doc.createDigitalSignatureField("PDFTronApprovalSig");
			SignatureWidget widgetAnnotApproval = SignatureWidget.create(doc, new Rect(300, 300, 500, 200), approval_signature_field);
			Page page1 = doc.getPage(1);
			page1.annotPushBack(widgetAnnotApproval);
			doc.save(output_path + "tiger_withApprovalField_output.pdf", SDFDoc.SaveMode.REMOVE_UNUSED, null);
		}
		catch (Exception e)
		{
			System.err.println(e.getMessage());
			e.printStackTrace(System.err);
			result = false;
		}

		//////////////////// TEST 1: certify a PDF.
		try
		{
			certifyPDF(input_path + "tiger_withApprovalField.pdf",
				"PDFTronCertificationSig",
				input_path + "pdftron.pfx",
				"password",
				input_path + "pdftron.bmp",
				output_path + "tiger_withApprovalField_certified_output.pdf");
			printSignaturesInfo(output_path + "tiger_withApprovalField_certified_output.pdf");
		}
		catch (Exception e)
		{
			System.err.println(e.getMessage());
			e.printStackTrace(System.err);
			result = false;
		}

		//////////////////// TEST 2: sign a PDF with a certification and an unsigned signature field in it.
		try
		{
			signPDF(input_path + "tiger_withApprovalField_certified.pdf",
				"PDFTronApprovalSig",
				input_path + "pdftron.pfx",
				"password",
				input_path + "signature.jpg",
				output_path + "tiger_withApprovalField_certified_approved_output.pdf");
			printSignaturesInfo(output_path + "tiger_withApprovalField_certified_approved_output.pdf");
		}
		catch (Exception e)
		{
			System.err.println(e.getMessage());
			e.printStackTrace(System.err);
			result = false;
		}

		//////////////////// TEST 3: Clear a certification from a document that is certified and has two approval signatures.
		try
		{
			clearSignature(input_path + "tiger_withApprovalField_certified_approved.pdf",
				"PDFTronCertificationSig",
				output_path + "tiger_withApprovalField_certified_approved_certcleared_output.pdf");
			printSignaturesInfo(output_path + "tiger_withApprovalField_certified_approved_certcleared_output.pdf");
		}
		catch (Exception e)
		{
			System.err.println(e.getMessage());
			e.printStackTrace(System.err);
			result = false;
		}

		//////////////////// End of tests. ////////////////////

		if (result)
		{
			System.out.println("Tests successful.\n==========");
		}
		else
		{
			System.out.println("Tests FAILED!!!\n==========");
		}
	}
}
