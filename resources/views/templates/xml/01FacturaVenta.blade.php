<<?php ?>?xml version="1.0" encoding="UTF-8" standalone="no" ?>

<Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:sts="dian:gov:co:facturaelectronica:Structures-2-1" xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#" xmlns:fn="http://www.w3.org/2005/xpath-functions" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ds="http://www.w3.org/2000/09/xmldsig#">


    {{-- UBLExtensions --}}
    <ext:UBLExtensions>
        @include('templates.xml._ubl_extensionsPROVIDERS')
       @include('templates.xml._ubl_extensionsSIGNATURE')
    </ext:UBLExtensions>


    <cbc:UBLVersionID>UBL 2.1</cbc:UBLVersionID>
    <cbc:CustomizationID>{{$CustomizationID}}</cbc:CustomizationID>
    <cbc:ProfileID>DIAN 2.1: Factura Electrónica de Venta</cbc:ProfileID>
    <cbc:ProfileExecutionID>{{$ProfileExecutionID}}</cbc:ProfileExecutionID>
    <cbc:ID>{{$ID}}</cbc:ID>
    <cbc:UUID schemeID="{{$ProfileExecutionID}}" schemeName="CUFE-SHA384">{{$UUID}}</cbc:UUID>
    <cbc:IssueDate>{{$IssueDate ?? Carbon\Carbon::now()->format('Y-m-d')}}</cbc:IssueDate>
    <cbc:IssueTime>{{$IssueTime ?? Carbon\Carbon::now()->format('H:i:s')}}-05:00</cbc:IssueTime>
    <cbc:InvoiceTypeCode>{{$InvoiceTypeCode}}</cbc:InvoiceTypeCode>
    <cbc:Note>{{$Note}}</cbc:Note>
    <cbc:DocumentCurrencyCode>{{$DocumentCurrencyCode}}</cbc:DocumentCurrencyCode>
    <cbc:LineCountNumeric>{{$LineCountNumeric}}</cbc:LineCountNumeric>
    {{-- AccountingSupplierParty --}}
    @include('templates.xml._accountSuplerParty')
    {{-- AccountingCustomerParty --}}
    @include('templates.xml._accountCustomerParty')
    {{-- PaymentMeans --}}
    @include('templates.xml._payment_means')
    {{-- TaxTotals --}}
    @if($TXTaxableAmount>0)
        @include('templates.xml._tax_totals')
    @endif
    {{-- LegalMonetaryTotal --}}
    @include('templates.xml._legal_monetary_total')
    {{-- InvoiceLines --}}
    @include('templates.xml._invoice_lines')
</Invoice>
