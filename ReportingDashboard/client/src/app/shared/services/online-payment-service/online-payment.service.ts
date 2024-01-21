import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { CreateOrderDto } from '../../models/create-order-dto';

@Injectable({
  providedIn: 'root',
})
export class OnlinePaymentService {
  constructor(private httpClient: HttpClient) {}

  getPaymentPage(createOrderDto: CreateOrderDto) {
    return this.httpClient.post(
      environment.apiUrl + 'onlinepayment/get-payment-page',
      createOrderDto,
      {
        responseType: 'text' as const,
      }
    );
  }
}
