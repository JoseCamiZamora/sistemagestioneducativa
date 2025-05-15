<cac:AccountingCustomerParty>
    <cbc:AdditionalAccountID>{{$CSAdditionalAccountID}}</cbc:AdditionalAccountID>
    <cac:Party>
      @if ($CSAdditionalAccountID == 2)
      <cac:PartyIdentification>
        <cbc:ID schemeID="7" schemeName="31" schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)">{{$CScustomerID}}</cbc:ID>
      </cac:PartyIdentification>
      @endif

      <cac:PartyName>
        <cbc:Name>{{$CSName}}</cbc:Name>
      </cac:PartyName>
      <cac:PhysicalLocation>
        <cac:Address>
          <cbc:ID>{{$CSRegID}}</cbc:ID>
          <cbc:CityName>{{$CSCityName}}</cbc:CityName>
          <cbc:PostalZone>{{$CScodepostal}}</cbc:PostalZone>
          <cbc:CountrySubentity>{{$CSCountrySubentity}}</cbc:CountrySubentity>
          <cbc:CountrySubentityCode>{{$CSRegCountrySubentityCode}}</cbc:CountrySubentityCode>
          <cac:AddressLine>
            <cbc:Line>{{$CSRegAddress}}</cbc:Line>
          </cac:AddressLine>
          <cac:Country>
            <cbc:IdentificationCode languageID="es">{{$CSIdentificationCode}}</cbc:IdentificationCode>
            <cbc:Name languageID="es">{{$CSCountryName}}</cbc:Name>
          </cac:Country>
        </cac:Address>
      </cac:PhysicalLocation>
      <cac:PartyTaxScheme>
        <cbc:RegistrationName>{{$CSRegistrationName}}</cbc:RegistrationName>
        <cbc:CompanyID schemeID="{{$CSdv}}" schemeName="{{$CScodeTypedoc}}" schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)">{{$CSCompanyID}}</cbc:CompanyID>
        <cbc:TaxLevelCode listName="48">{{$CSTaxLevelCode}}</cbc:TaxLevelCode>
        <cac:RegistrationAddress>
          <cbc:ID>{{$CSRegID}}</cbc:ID>
          <cbc:CityName>{{$CSRegCityName}}</cbc:CityName>
          <cbc:PostalZone>{{$CScodepostal}}</cbc:PostalZone>
          <cbc:CountrySubentity>{{$CSRegCountrySubentity}}</cbc:CountrySubentity>
          <cbc:CountrySubentityCode>{{$CSRegCountrySubentityCode}}</cbc:CountrySubentityCode>
          <cac:AddressLine>
            <cbc:Line>{{$CSRegAddress}}</cbc:Line>
          </cac:AddressLine>
          <cac:Country>
            <cbc:IdentificationCode languageID="es">{{ $CSIdentificationCode}}</cbc:IdentificationCode>
            <cbc:Name languageID="es">{{$CSIdentificationCode}}</cbc:Name>
          </cac:Country>
        </cac:RegistrationAddress>
        <cac:TaxScheme>
          <cbc:ID>{{$CSTaxID}}</cbc:ID>
          <cbc:Name>{{$CSTaxName}}</cbc:Name>
        </cac:TaxScheme>
      </cac:PartyTaxScheme>
      <cac:PartyLegalEntity>
        <cbc:RegistrationName>{{$CSLegalRegistrationName}}</cbc:RegistrationName>
        <cbc:CompanyID schemeID="{{$CSdv}}" schemeName="{{$CScodeTypedoc}}" schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)">{{$CSLegalCompanyID}}</cbc:CompanyID>
      </cac:PartyLegalEntity>
      <cac:Contact>
        <cbc:Telephone>{{$CSContactTelephone}}</cbc:Telephone>
        <cbc:ElectronicMail>{{$CSContactElectronicMail}}</cbc:ElectronicMail>
      </cac:Contact>
    </cac:Party>
  </cac:AccountingCustomerParty>