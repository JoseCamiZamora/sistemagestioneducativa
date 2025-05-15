<cac:RequestedMonetaryTotal>
    <cbc:LineExtensionAmount currencyID="COP">{{number_format($LMLineExtensionAmount, 2, '.', '')}}</cbc:LineExtensionAmount>
    <cbc:TaxExclusiveAmount currencyID="COP">{{number_format($LMTaxExclusiveAmount, 2, '.', '')}}</cbc:TaxExclusiveAmount>
    <cbc:TaxInclusiveAmount currencyID="COP">{{number_format($LMTaxInclusiveAmount, 2, '.', '')}}</cbc:TaxInclusiveAmount>
    <cbc:PayableAmount currencyID="COP">{{number_format($PayableAmount, 2, '.', '')}}</cbc:PayableAmount>
</cac:RequestedMonetaryTotal>
