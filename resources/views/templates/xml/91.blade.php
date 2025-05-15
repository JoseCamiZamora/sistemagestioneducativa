<<?php ?>?xml version="1.0" encoding="UTF-8" standalone="no" ?>
<CreditNote
    xmlns="urn:oasis:names:specification:ubl:schema:xsd:CreditNote-2"
    xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
    xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
    xmlns:ds="http://www.w3.org/2000/09/xmldsig#"
    xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2"
    xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures"
    xmlns:xades="http://uri.etsi.org/01903/v1.3.2#"
    xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="urn:oasis:names:specification:ubl:schema:xsd:CreditNote-2     http://docs.oasis-open.org/ubl/os-UBL-2.1/xsd/maindoc/UBL-CreditNote-2.1.xsd">
    {{-- UBLExtensions --}}
     <ext:UBLExtensions>
        @include('templates.xml.credito._ubl_extensionsPROVIDERS')
       @include('templates.xml.credito._ubl_extensionsSIGNATURE')
    </ext:UBLExtensions>
    <cbc:UBLVersionID>UBL 2.1</cbc:UBLVersionID>
    <cbc:CustomizationID>{{$CustomizationID}}</cbc:CustomizationID>
    <cbc:ProfileID>DIAN 2.1: Nota Crédito de Factura Electrónica de Venta</cbc:ProfileID>
    <cbc:ProfileExecutionID>{{$ProfileExecutionID}}</cbc:ProfileExecutionID>
    <cbc:ID>{{$ID}}</cbc:ID>
    <cbc:UUID schemeID="{{$ProfileExecutionID}}" schemeName="CUDE-SHA384">{{$UUID}}</cbc:UUID>
    <cbc:IssueDate>{{$IssueDate ?? Carbon\Carbon::now()->format('Y-m-d')}}</cbc:IssueDate>
    <cbc:IssueTime>{{$IssueTime ?? Carbon\Carbon::now()->format('H:i:s')}}-05:00</cbc:IssueTime>
    <cbc:CreditNoteTypeCode>{{$InvoiceTypeCode}}</cbc:CreditNoteTypeCode>
    <cbc:DocumentCurrencyCode>{{$DocumentCurrencyCode}}</cbc:DocumentCurrencyCode>
    <cbc:LineCountNumeric>{{$LineCountNumeric}}</cbc:LineCountNumeric>
   {{-- BillingReference --}}
    @include('templates.xml.credito._billing_reference')
   
  {{-- AccountingSupplierParty --}}
    @include('templates.xml.credito._accountSuplerParty')
    {{-- AccountingCustomerParty --}}
    @include('templates.xml.credito._accountCustomerParty')
    {{-- PaymentMeans --}}
    @include('templates.xml.credito._payment_means')
    {{-- TaxTotals --}}
    @if($TXTaxableAmount>0)
         @include('templates.xml.credito._tax_totals')
    @endif
   
    {{-- LegalMonetaryTotal --}}
    @include('templates.xml.credito._legal_monetary_total')
    {{-- DebitNoteLine --}}
    @include('templates.xml.credito._credit_note_lines')
</CreditNote>



   

