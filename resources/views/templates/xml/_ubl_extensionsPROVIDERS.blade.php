<ext:UBLExtension>
        <ext:ExtensionContent>
            <sts:DianExtensions xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:sts="dian:gov:co:facturaelectronica:Structures-2-1">
               <sts:InvoiceControl>
                    <sts:InvoiceAuthorization>{{$InvoceAuthorization}}</sts:InvoiceAuthorization>
                    <sts:AuthorizationPeriod>
                        <cbc:StartDate>{{$StartDate}}</cbc:StartDate>
                        <cbc:EndDate>{{$EndDate}}</cbc:EndDate>
                    </sts:AuthorizationPeriod>
                    <sts:AuthorizedInvoices>
                        <sts:Prefix>{{$Prefix}}</sts:Prefix>
                        <sts:From>{{$From}}</sts:From>
                        <sts:To>{{$To}}</sts:To>
                    </sts:AuthorizedInvoices>
                </sts:InvoiceControl>

                <sts:InvoiceSource>
                    <cbc:IdentificationCode listAgencyID="6" listAgencyName="United Nations Economic Commission for Europe" listSchemeURI="urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.1">{{$Countrycode}}</cbc:IdentificationCode>
                </sts:InvoiceSource>
                <sts:SoftwareProvider>
                    <sts:ProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)"  schemeID="{{$ProviderDV}}" schemeName="31">{{$ProviderID}}</sts:ProviderID>
                    <sts:SoftwareID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)">{{$SoftwareID}}</sts:SoftwareID>
                </sts:SoftwareProvider>
                <sts:SoftwareSecurityCode schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)">{{$SoftwareSecurityCode}}</sts:SoftwareSecurityCode>
                <sts:AuthorizationProvider>
                    <sts:AuthorizationProviderID schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)" schemeID="4" schemeName="31">{{$AuthorizationProviderID}}</sts:AuthorizationProviderID>
                </sts:AuthorizationProvider>
                <sts:QRCode>{{$QRCode}}</sts:QRCode>
            </sts:DianExtensions>
        </ext:ExtensionContent>
</ext:UBLExtension>





