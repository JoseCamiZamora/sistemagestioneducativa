<<?php ?>?xml version="1.0" encoding="UTF-8" standalone="no" ?>

<AttachedDocument xmlns="urn:oasis:names:specification:ubl:schema:xsd:AttachedDocument-2" 
	xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
	xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ccts="urn:un:unece:uncefact:data:specification:CoreComponentTypeSchemaModule:2" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#">

	{{-- UBLExtensions --}}
    <ext:UBLExtensions>
        @include('templates.xml._ubl_extensionsPROVIDERS')
        @include('templates.xml._ubl_extensionsSIGNATURE')
    </ext:UBLExtensions>
    <cbc:UBLVersionID>Factura Electrónica de Venta</cbc:UBLVersionID>
    <cbc:CustomizationID>{{$data->CustomizationID}}</cbc:CustomizationID>
    <cbc:ProfileID>DIAN 2.1</cbc:ProfileID>
    <cbc:ProfileExecutionID>{{$data->ProfileExecutionID}}</cbc:ProfileExecutionID>
    <cbc:ID>{{$data->ID}}</cbc:ID>
    <cbc:IssueDate>{{$data->IssueDate ?? Carbon\Carbon::now()->format('Y-m-d')}}</cbc:IssueDate>
    <cbc:IssueTime>{{$data->IssueTime ?? Carbon\Carbon::now()->format('H:i:s')}}-05:00</cbc:IssueTime>
    <cbc:DocumentType>Contenedor de Factura Electrónica</cbc:DocumentType>
    <cbc:ParentDocumentID>{{$data->ID}}</cbc:ParentDocumentID>
    {{-- SenderParty --}}
        @include('templates.xml._accountSenderParty')
    {{-- SenderParty --}}
    {{-- ReceiverParty --}}
        @include('templates.xml._accountReceiverParty')
    {{-- ReceiverParty --}}
    <cac:Attachment>
        <cac:ExternalReference>
            <cbc:MimeCode>text/xml</cbc:MimeCode>
            <cbc:EncodingCode>UTF-8</cbc:EncodingCode>
            <cbc:Description> <![CDATA[$data->pdfFirmado]]> </cbc:Description>
        </cac:ExternalReference>
    </cac:Attachment>
    <cac:ParentDocumentLineReference>
    <cbc:LineID>1</cbc:LineID>
    <cac:DocumentReference>
      <cbc:ID>{{$data->ID}}</cbc:ID>
       <cbc:UUID schemeName="CUFE-SHA384">{{$data->UUID}}</cbc:UUID>
      <cbc:IssueDate>2021-12-16</cbc:IssueDate>
      <cbc:DocumentType>ApplicationResponse</cbc:DocumentType>
      <cac:Attachment>
        <cac:ExternalReference>
          <cbc:MimeCode>text/xml</cbc:MimeCode>
          <cbc:EncodingCode>UTF-8</cbc:EncodingCode>
          <cbc:Description><![CDATA[$data->applicationResponse]]></cbc:Description>
        </cac:ExternalReference>
      </cac:Attachment>
      <cac:ResultOfVerification>
        <cbc:ValidatorID>Unidad Especial Dirección de Impuestos y Aduanas Nacionales</cbc:ValidatorID>
        <cbc:ValidationResultCode>02</cbc:ValidationResultCode>
        <cbc:ValidationDate>{{$data->IssueDate ?? Carbon\Carbon::now()->format('Y-m-d')}}</cbc:ValidationDate>
        <cbc:ValidationTime>{{$data->IssueTime ?? Carbon\Carbon::now()->format('H:i:s')}}-05:00</cbc:ValidationTime>
      </cac:ResultOfVerification>
    </cac:DocumentReference>
  </cac:ParentDocumentLineReference>
</AttachedDocument>