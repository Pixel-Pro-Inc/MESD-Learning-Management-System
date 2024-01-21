import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { BusyService } from '../busy-service/busy.service';
import { ToastrService } from 'ngx-toastr';

@Injectable({
  providedIn: 'root',
})
export class PaymentService {
  constructor(
    private httpClient: HttpClient,
    private busyService: BusyService,
    private toastService: ToastrService
  ) {}

  processPayment(model: any) {
    this.busyService.busy();

    this.httpClient
      .post(environment.apiUrl + 'onlinepayment/pay', model, {
        responseType: 'text' as const,
      })
      .subscribe(
        (response) => {
          this.busyService.idle();

          window.open(response, '_self');
        },
        (error) => {
          this.busyService.idle();
          this.toastService.error(error.error);
        }
      );
  }
}
