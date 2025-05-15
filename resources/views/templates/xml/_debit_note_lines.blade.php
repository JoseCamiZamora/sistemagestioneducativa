@foreach ($invoiceLines as  $invoiceLine)
    <cac:DebitNoteLine>
        <cbc:ID>{{($loop->index + 1)}}</cbc:ID>
        <cbc:DebitedQuantity unitCode="NIU">{{number_format($invoiceLine->cantidad, 2, '.', '')}}</cbc:DebitedQuantity>
        <cbc:LineExtensionAmount currencyID="COP">{{number_format($invoiceLine->valor_total, 2, '.', '')}}</cbc:LineExtensionAmount>



        <cac:TaxTotal>
        <cbc:TaxAmount currencyID="COP">{{number_format($invoiceLine->iva, 2, '.', '')}}</cbc:TaxAmount>
        <cac:TaxSubtotal>
          <cbc:TaxableAmount currencyID="COP">{{number_format($invoiceLine->valor_total, 2, '.', '')}}</cbc:TaxableAmount>
          <cbc:TaxAmount currencyID="COP">{{number_format($invoiceLine->iva, 2, '.', '')}}</cbc:TaxAmount>
          <cac:TaxCategory>
            <cbc:Percent>{{number_format($invoiceLine->porcentaje, 2, '.', '')}}</cbc:Percent>
            <cac:TaxScheme>
              <cbc:ID>01</cbc:ID>
              <cbc:Name>IVA</cbc:Name>
            </cac:TaxScheme>
          </cac:TaxCategory>
        </cac:TaxSubtotal>
        </cac:TaxTotal>


      
    <cac:Item>
      <cbc:Description>{{$invoiceLine->insumo ?? ""}}</cbc:Description>
      <cac:SellersItemIdentification>
        <cbc:ID>{{$invoiceLine->codigo}}</cbc:ID>
      </cac:SellersItemIdentification>
      <cac:StandardItemIdentification>
        <cbc:ID schemeID="999" schemeName="Estándar de adopción del contribuyente">{{$invoiceLine->codigo}}</cbc:ID>
      </cac:StandardItemIdentification>
    </cac:Item>



    <cac:Price>
      <cbc:PriceAmount currencyID="COP">{{number_format($invoiceLine->valor_unitario, 2, '.', '')}}</cbc:PriceAmount>
      <cbc:BaseQuantity unitCode="NIU">{{number_format($invoiceLine->cantidad, 2, '.', '')}}</cbc:BaseQuantity>
    </cac:Price>
    </cac:DebitNoteLine>
@endforeach

