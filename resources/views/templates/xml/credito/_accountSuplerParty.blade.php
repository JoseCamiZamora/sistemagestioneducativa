 <cac:AccountingSupplierParty>
    <cbc:AdditionalAccountID>{{$SPAdditionalAccountID}}</cbc:AdditionalAccountID>
    <cac:Party>
      <cbc:IndustryClassificationCode>{{$SPIndustryClassificationCode}}</cbc:IndustryClassificationCode>
      <cac:PartyName>
        <cbc:Name>{{$SPName}}</cbc:Name>
      </cac:PartyName>
      <cac:PhysicalLocation>
        <cac:Address>
          <cbc:ID>{{$SPRegID}}</cbc:ID>
          <cbc:CityName>{{$SPCityName}}</cbc:CityName>
          <cbc:PostalZone>{{$SPcodepostal}}</cbc:PostalZone>
          <cbc:CountrySubentity>{{$SPCountrySubentity}}</cbc:CountrySubentity>
          <cbc:CountrySubentityCode>{{$SPRegCountrySubentityCode}}</cbc:CountrySubentityCode>
          <cac:AddressLine>
            <cbc:Line>{{$SPAddress}}</cbc:Line>
          </cac:AddressLine>
          <cac:Country>
            <cbc:IdentificationCode languageID="es">{{$SPIdentificationCode}}</cbc:IdentificationCode>
            <cbc:Name languageID="es">{{$SPCountryName}}</cbc:Name>
          </cac:Country>
        </cac:Address>
      </cac:PhysicalLocation>
      <cac:PartyTaxScheme>
        <cbc:RegistrationName>{{$SPRegistrationName}}</cbc:RegistrationName>
        <cbc:CompanyID schemeID="{{$SPdv}}" schemeName="{{$SPcodeTypedoc}}" schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)">{{$SPCompanyID}}</cbc:CompanyID>
        <cbc:TaxLevelCode listName="49">{{$SPTaxLevelCode}}</cbc:TaxLevelCode>
        <cac:RegistrationAddress>

          <cbc:ID>{{$SPRegID}}</cbc:ID>

          <cbc:CityName>{{$SPRegCityName}}</cbc:CityName>
                 <cbc:PostalZone>{{$SPcodepostal}}</cbc:PostalZone>
          <cbc:CountrySubentity>{{$SPRegCountrySubentity}}</cbc:CountrySubentity>
          <cbc:CountrySubentityCode>{{$SPRegCountrySubentityCode}}</cbc:CountrySubentityCode>
          <cac:AddressLine>
            <cbc:Line>{{$SPRegAddress}}</cbc:Line>
          </cac:AddressLine>
          <cac:Country>
            <cbc:IdentificationCode languageID="es">{{$SPIdentificationCode}}</cbc:IdentificationCode>
            <cbc:Name languageID="es">{{$SPCountryName}}</cbc:Name>
          </cac:Country>
        </cac:RegistrationAddress>
        <cac:TaxScheme>
          <cbc:ID>{{$SPTaxID}}</cbc:ID>
          <cbc:Name>{{$SPTaxName}}</cbc:Name>
        </cac:TaxScheme>
      </cac:PartyTaxScheme>
      <cac:PartyLegalEntity>
        <cbc:RegistrationName>{{$SPLegalRegistrationName}}</cbc:RegistrationName>
        <cbc:CompanyID schemeID="{{$SPdv}}" schemeName="{{$SPcodeTypedoc}}" schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)">{{$SPLegalCompanyID}}</cbc:CompanyID>
        <cac:CorporateRegistrationScheme>
          <cbc:ID>{{$SPLegalID}}</cbc:ID>
        </cac:CorporateRegistrationScheme>
      </cac:PartyLegalEntity>
      <cac:Contact>
        <cbc:Name>{{$SPContactName}}</cbc:Name>
        <cbc:Telephone>{{$SPContactTelephone}}</cbc:Telephone>
        <cbc:ElectronicMail>{{$SPContactElectronicMail}}</cbc:ElectronicMail>
      </cac:Contact>
    </cac:Party>
  </cac:AccountingSupplierParty>