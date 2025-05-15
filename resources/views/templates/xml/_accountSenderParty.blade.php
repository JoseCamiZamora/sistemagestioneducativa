<cac:SenderParty>
  <cac:PartyTaxScheme>
      <cbc:RegistrationName>{{$data->SPRegistrationName}}</cbc:RegistrationName>
      <cbc:CompanyID schemeID="{{$data->SPdv}}" schemeName="{{$data->SPcodeTypedoc}}" schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)">{{$SPCompanyID}}</cbc:CompanyID>
      <cbc:TaxLevelCode listName="49">{{$data->SPTaxLevelCode}}</cbc:TaxLevelCode>
        <cac:RegistrationAddress>
          <cbc:ID>{{$data->CSRegID}}</cbc:ID>
          <cbc:CityName>{{$data->CSRegCityName}}</cbc:CityName>
          <cbc:PostalZone>{{$data->CScodepostal}}</cbc:PostalZone>
          <cbc:CountrySubentity>{{$data->CSRegCountrySubentity}}</cbc:CountrySubentity>
          <cbc:CountrySubentityCode>{{$data->CSRegCountrySubentityCode}}</cbc:CountrySubentityCode>
          <cac:AddressLine>
            <cbc:Line>{{$data->CSRegAddress}}</cbc:Line>
          </cac:AddressLine>
          <cac:Country>
            <cbc:IdentificationCode languageID="es">{{ $data->CSIdentificationCode}}</cbc:IdentificationCode>
            <cbc:Name languageID="es">{{$data->CSIdentificationCode}}</cbc:Name>
          </cac:Country>
        </cac:RegistrationAddress>
      <cac:TaxScheme>
        <cbc:ID>{{$data->SPTaxID}}</cbc:ID>
        <cbc:Name>{{$data->SPTaxName}}</cbc:Name>
      </cac:TaxScheme>
  </cac:PartyTaxScheme>
</cac:SenderParty>