<cac:TaxTotal>
    <cbc:TaxAmount currencyID="COP">{{number_format($TXTaxAmount, 2, '.', '')}}</cbc:TaxAmount>
    <cac:TaxSubtotal>
      <cbc:TaxableAmount currencyID="COP">{{number_format($TXTaxableAmount, 2, '.', '')}}</cbc:TaxableAmount>
      <cbc:TaxAmount currencyID="COP">{{number_format($TXTaxAmount, 2, '.', '')}}</cbc:TaxAmount>
      <cac:TaxCategory>
        <cbc:Percent>{{number_format($TXTPercent, 2, '.', '')}}</cbc:Percent>
        <cac:TaxScheme>
          <cbc:ID>{{$TXID}}</cbc:ID>
          <cbc:Name>{{$TXName}}</cbc:Name>
        </cac:TaxScheme>
      </cac:TaxCategory>
    </cac:TaxSubtotal>
</cac:TaxTotal>





