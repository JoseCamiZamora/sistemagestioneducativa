<cac:BillingReference>
    <cac:InvoiceDocumentReference>
        <cbc:ID>{{ $Prefix.$facturareferencia->consecutivo}}</cbc:ID>
        <cbc:UUID schemeName="CUFE-SHA384">{{$facturareferencia->cufe}}</cbc:UUID>
        <cbc:IssueDate>{{$facturareferencia->fecha_expedicion_fac ?? Carbon\Carbon::now()->format('Y-m-d')}}</cbc:IssueDate>
    </cac:InvoiceDocumentReference>
</cac:BillingReference>
