<?php 


class Signature 
{
	
	private $doc ;

	protected $prefix = "ds:";

	const XML_DSIG_NS = 'http://www.w3.org/2000/09/xmldsig#';

	const CN_EXC = 'http://www.w3.org/2001/10/xml-exc-c14n#';

	const DS_MTHD = "http://www.w3.org/2001/04/xmldsig-more#rsa-sha256";

	private $private_k ;

	private $certs;

	public function setRootDoc($doc){
		$this->doc = $doc;
	}

	public function setPK($pk){
		$this->private_k = $pk;
	}

	public function setCerts($ncerts){
		$this->certs = $ncerts;
	}

	private function calculateDigestValue(){
		$rootNode = $this->doc->getElementsByTagName("FacuturaElectronica")->item(0);

		$c14data =  $rootNode->C14N(true,false);

		return base64_encode(hash("sha256",$c14data,false));

	}

	private function createSignNode(){
		$sigNode = $this->doc->createElement($this->prefix."Signature");
		$sigNode->setAttribute('xmlns:ds','http://www.w3.org/2000/09/xmldsig#');
		$this->doc->getElementsByTagName("FacuturaElectronica")->item(0)->appendChild($sigNode);
	}

	private function createSignStructure(){

		$this->createSignNode();

		// Nodo Signed Info

		$signedinfo = $this->doc->createElement($this->prefix."SignedInfo");
		$this->doc->getElementsByTagName($this->prefix."Signature")->item(0)->appendChild($signedinfo);

		// Nodo CanonicalizationMethod
		$canonicalize = $this->doc->createElement($this->prefix."CanonicalizationMethod");
		$canonicalize->setAttribute("Algorithm",'http://www.w3.org/2001/10/xml-exc-c14n#');
		$signedinfo->appendChild($canonicalize);

		// SingMethod

		$signmethod = $this->doc->createElement($this->prefix."SignatureMethod");
		$signmethod->setAttribute("Algorithm","http://www.w3.org/2001/04/xmldsig-more#rsa-sha256");
		$signedinfo->appendChild($signmethod);

		// Reference Secction

		$reference = $this->doc->createElement($this->prefix."Reference");
		$signedinfo->appendChild($reference);

		$transforms = $this->doc->createElement($this->prefix."Transforms");
		$reference->appendChild($transforms);

		$transform = $this->doc->createElement($this->prefix."Transform");
		$transform->setAttribute("Algorithm","http://www.w3.org/2000/09/xmldsig#enveloped-signature");
		$transforms->appendChild($transform);

		$digesmethod = $this->doc->createElement($this->prefix."DigestMethod");
		$digesmethod->setAttribute("Algorithm","http://www.w3.org/2001/04/xmlenc#sha256");
		$reference->appendChild($digesmethod);

		$digestvalue = $this->doc->createElement($this->prefix."DigestValue",$this->calculateDigestValue());
		$reference->appendChild($digestvalue);

		//End Secction Reference


	}

	private function keyInfoStructure(){

		$keyinfo = $this->doc->createElement($this->prefix."KeyInfo");
		$this->doc->getElementsByTagName($this->prefix."Signature")->item(0)->appendChild($keyinfo);

		$c_data = $this->doc->createElement($this->prefix."X509Data");
		$keyinfo->appendChild($c_data);

		$c_cert = $this->doc->createElement($this->prefix."X509Certificate",$this->certs);
		$c_data->appendChild($c_cert);
	}

	public function signXML(){

		$this->createSignStructure();

		$c14datasign = $this->doc->getElementsByTagName($this->prefix."SignedInfo")->item(0)->C14N(true,false);

		if (openssl_sign($c14datasign,$signature,$this->private_k,"sha256")) {

			$sign_value = $this->doc->createElement($this->prefix."SignatureValue",base64_encode($signature));
			$this->doc->getElementsByTagName($this->prefix."Signature")->item(0)->appendChild($sign_value);

		}else{
			print_r("No se pudo firmar");
		}

		$this->keyInfoStructure();

		$this->xadesEpesTags();
	}


	private function calculateDigestValueXades(){

		$rootNode = $this->doc->getElementsByTagName($this->prefix."X509Certificate")->item(0);

		$c14data =  $rootNode->C14N(true,false);

		return base64_encode(hash("sha1",$c14data,false));
	}

	private function xadesEpesTags(){
		$xades_prefix= "xades:";

		$obj = $this->doc->createElement($this->prefix."Object");
		$this->doc->getElementsByTagName($this->prefix."Signature")->item(0)->appendChild($obj);

		$qualy = $this->doc->createElement($xades_prefix."QualifyingProperties");
		$qualy->setAttribute("xmlns:xades","http://uri.etsi.org/01903/v1.3.2#");
		$obj->appendChild($qualy);

		$sign_prop = $this->doc->createElement($xades_prefix."SignedProperties");
		$qualy->appendChild($sign_prop);

		$sign_sig_prop = $this->doc->createElement($xades_prefix."SignedSignatureProperties");
		$sign_prop->appendChild($sign_sig_prop);

		$sign_time = $this->doc->createElement($xades_prefix."SigningTime",date(DATE_ATOM));
		$sign_sig_prop->appendChild($sign_time);

		// SigningCertificate Secction

		$sign_certs = $this->doc->createElement($xades_prefix."SigningCertificate");
		$sign_sig_prop->appendChild($sign_certs);

		$sign_cert = $this->doc->createElement($xades_prefix."Cert");
		$sign_certs->appendChild($sign_cert);

		$cert_digest = $this->doc->createElement($xades_prefix."CertDigest");
		$sign_cert->appendChild($cert_digest);

		$digesmethod = $this->doc->createElement($this->prefix."DigestMethod");
		$digesmethod->setAttribute("Algorithm","http://www.w3.org/2000/09/xmldsig#sha1");
		$cert_digest->appendChild($digesmethod);

		$digestvalue = $this->doc->createElement($this->prefix."DigestValue",$this->calculateDigestValueXades());
		$cert_digest->appendChild($digestvalue);

		$issuer = $this->doc->createElement($xades_prefix."IssuerSerial");
		$sign_cert->appendChild($issuer);

		$issuer_name = $this->doc->createElement($this->prefix."X509IssuerName","CN=CA SINPE - PERSONA FISICA,OU=DIVISION DE SERVICIOS
FINANCIEROS,O=BANCO CENTRAL DE COSTA RICA,C=CR,2.5.4.5=#130c342d3030302d303034303137");
		$cert_digest->appendChild($issuer_name);

		$issuer_serial = $this->doc->createElement($this->prefix."X509SerialNumber","207422209224813750547132");
		$cert_digest->appendChild($issuer_serial);

		// END SigningCertificate

		// SignaturePolicyIdentifier Secction

		$sign_poly = $this->doc->createElement($xades_prefix."SignaturePolicyIdentifier");
		$sign_sig_prop->appendChild($sign_poly);

		$sign_poly_id = $this->doc->createElement($xades_prefix."SignaturePolicyId");
		$sign_poly->appendChild($sign_poly_id);

		$sign_poly_identi = $this->doc->createElement($xades_prefix."SigPolicyId");
		$sign_poly_id->appendChild($sign_poly_identi);

		$identi = $this->doc->createElement($xades_prefix."Identifier","
https://tribunet.hacienda.go.cr/docs/esquemas/2016/v4.1/Resolucion_Comprobantes_Electronicos_DGT-R-48-
2016.pdf");
		$sign_poly_identi->appendChild($identi);

		$sign_poly_hash = $this->doc->createElement($xades_prefix."SigPolicyHash");
		$sign_poly_id->appendChild($sign_poly_hash);

		$digesmethod2 = $this->doc->createElement($this->prefix."DigestMethod");
		$digesmethod2->setAttribute("Algorithm","http://www.w3.org/2000/09/xmldsig#sha256");
		$sign_poly_hash->appendChild($digesmethod2);

		$digestvalue2 = $this->doc->createElement($this->prefix."DigestValue");
		$sign_poly_hash->appendChild($digestvalue2);

		// End SignaturePolicyIdentifier

		// SignedDataObjectProperties Section

		$sign_data = $this->doc->createElement($xades_prefix."SignedDataObjectProperties");
		$sign_prop->appendChild($sign_data);

		$sign_data_format = $this->doc->createElement($xades_prefix."DataObjectFormat");
		$sign_data->appendChild($sign_data_format);

		$sign_data_mime = $this->doc->createElement($xades_prefix."MimeType","application/octet-stream");
		$sign_data_format->appendChild($sign_data_mime);

		// END SignedDataObjectProperties
	}
}

 ?>