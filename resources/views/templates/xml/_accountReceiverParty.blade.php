<cac:ReceiverParty>
    <cac:PartyTaxScheme>
         <cbc:RegistrationName>{{$data->CSName}}</cbc:RegistrationName>
         <cbc:CompanyID schemeID="{{$data->CSdv}}" schemeName="{{$data->CScodeTypedoc}}" schemeAgencyID="195" schemeAgencyName="CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)">{{$data->CSCompanyID}}</cbc:CompanyID>
         <cbc:TaxLevelCode listName="48">{{$data->CSTaxLevelCode}}</cbc:TaxLevelCode>
         <cac:RegistrationAddress>
          <cbc:ID>{{$data->CSRegID}}</cbc:ID>
          <cbc:CityName>{{$data->CSCityName}}</cbc:CityName>
          <cbc:CountrySubentity>{{$data->CSCountrySubentity}}</cbc:CountrySubentity>
          <cbc:CountrySubentityCode>{{$data->CSRegCountrySubentityCode}}</cbc:CountrySubentityCode>
          <cac:AddressLine>
            <cbc:Line>{{$data->CSRegAddress}}</cbc:Line>
          </cac:AddressLine>
          <cac:Country>
            <cbc:IdentificationCode languageID="es">{{$data->CSIdentificationCode}}</cbc:IdentificationCode>
            <cbc:Name languageID="es">{{$data->CSCountryName}}</cbc:Name>
          </cac:Country>
        <cac:RegistrationAddress>
        <cac:TaxScheme>
            <cbc:ID>{{$data->SPTaxID}}</cbc:ID>
            <cbc:Name>{{$data->SPTaxName}}</cbc:Name>
        </cac:TaxScheme>
    </cac:PartyTaxScheme>
</cac:ReceiverParty>