<cac:BillingReference>
    <cac:InvoiceDocumentReference>
        <cbc:ID>{{$ID}}</cbc:ID>
        <cbc:UUID schemeName="{{$ProfileExecutionID}}">{{$UUID}}</cbc:UUID>
        <cbc:IssueDate>{{$IssueDate ?? Carbon\Carbon::now()->format('Y-m-d')}}</cbc:IssueDate>
    </cac:InvoiceDocumentReference>
</cac:BillingReference>
