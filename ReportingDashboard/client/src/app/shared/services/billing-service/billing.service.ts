import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map } from 'rxjs/operators';
import { environment } from 'src/environments/environment';
import { Invoice } from '../../models/invoice';
import { InvoiceRequestDto } from '../../models/invoice-request-dto';

@Injectable({
  providedIn: 'root',
})
export class BillingService {
  constructor(private httpClient: HttpClient) {}

  getInvoices(invoiceRequestDto: InvoiceRequestDto) {
    return this.httpClient
      .post(environment.apiUrl + 'billing/get-invoices', invoiceRequestDto)
      .pipe(
        map((response: Invoice[]) => {
          return response;
        })
      );
  }

  getPastDueInvoices(invoiceRequestDto: InvoiceRequestDto) {
    return this.httpClient
      .post(
        environment.apiUrl + 'billing/get-past-due-invoices',
        invoiceRequestDto
      )
      .pipe(
        map((response: Invoice[]) => {
          return response;
        })
      );
  }

  getInvoice(invoiceRequestDto: InvoiceRequestDto) {
    return this.httpClient
      .post(environment.apiUrl + 'billing/get-invoice', invoiceRequestDto)
      .pipe(
        map((response: Invoice) => {
          return response;
        })
      );
  }

  payInvoice(invoice: Invoice) {
    return this.httpClient.post(
      environment.apiUrl + 'billing/pay-invoice',
      invoice,
      {
        responseType: 'text' as const,
      }
    );
  }
}
