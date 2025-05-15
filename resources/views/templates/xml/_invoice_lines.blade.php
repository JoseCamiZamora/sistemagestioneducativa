@foreach ($invoiceLines as  $invoiceLine)

  <cac:InvoiceLine>
    <cbc:ID>{{($loop->index + 1)}}</cbc:ID>
    <cbc:Note/>
    <cbc:InvoicedQuantity unitCode="NIU">{{number_format($invoiceLine->cantidad, 2, '.', '')}}</cbc:InvoicedQuantity>
    <cbc:LineExtensionAmount currencyID="COP">{{number_format($invoiceLine->valor_total, 2, '.', '')}}</cbc:LineExtensionAmount>
    
   

 @if($TXTaxableAmount>0)

    @if($invoiceLine->iva>0 )
    <cac:TaxTotal>
        <cbc:TaxAmount currencyID="COP">{{number_format($invoiceLine->iva, 2, '.', '')}}</cbc:TaxAmount>
        <cac:TaxSubtotal>
          @if ($invoiceLine->porcentaje>0  )
          <cbc:TaxableAmount currencyID="COP">{{number_format($invoiceLine->valor_total, 2, '.', '')}}</cbc:TaxableAmount>
          @else
            <cbc:TaxableAmount currencyID="COP">{{number_format(0, 2, '.', '')}}</cbc:TaxableAmount>
          @endif
          
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

    @endif
  @endif




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
  </cac:InvoiceLine>
@endforeach