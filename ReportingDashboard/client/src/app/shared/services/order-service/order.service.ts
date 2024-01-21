import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map } from 'rxjs/operators';
import { environment } from 'src/environments/environment';
import { CreateOrderDto } from '../../models/create-order-dto';
import { OrderDto } from '../../models/order-dto';
import { BusyService } from '../busy-service/busy.service';

@Injectable({
  providedIn: 'root',
})
export class OrderService {
  constructor(
    private httpClient: HttpClient,
    private busyService: BusyService
  ) {}

  createOrder(createOrderDto: CreateOrderDto) {
    return this.httpClient
      .post(environment.apiUrl + 'order/create-order', createOrderDto)
      .pipe(
        map((response: OrderDto) => {
          return response;
        })
      );
  }

  getReceipt(createOrderDto: CreateOrderDto) {
    this.busyService.busy();

    this.httpClient
      .post(environment.apiUrl + 'order/create-receipt', createOrderDto, {
        responseType: 'blob' as 'json',
      })
      .subscribe(
        (response: any) => {
          this.busyService.idle();
          let dataType = response.type;
          let binaryData = [];
          binaryData.push(response);
          let downloadLink = document.createElement('a');
          downloadLink.href = window.URL.createObjectURL(
            new Blob(binaryData, { type: dataType })
          );
          downloadLink.setAttribute('download', 'receipt');
          document.body.appendChild(downloadLink);
          downloadLink.click();
        },
        (error) => {
          this.busyService.idle();
        }
      );
  }
}
